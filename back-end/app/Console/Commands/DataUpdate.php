<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DataUpdate extends Command
{
  // クラス変数
  private $url = 'https://qiita.com/api/v2/items/';
  private $page = 1;
  private $per_page = 100;
  private $method = 'GET';
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'data:update';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'ranking data update';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->token = config('token.qiita');
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {
    // 週間ランキング
    $new_week_rank_titles = $this->main(7, 'posts', 5);
    // 月間ランキング
    $this->main(30, 'month_posts', 15);
    // メール送信
    $now = Carbon::now();
    Mail::send('email.send', ['time' => $now, 'new_week_rank_titles' => $new_week_rank_titles], function($message) {
      $message->to('aleph0528@gmail.com')
      ->from('aleph0528@gmail.com', 'qiita-my-ranking')
      ->subject('Qiitaの週間ランキングのデータを更新しました');
    });
    return Command::SUCCESS;
  }

  // mainの関数 他の関数をまとめた関数
  /** 
   * @param int $days 何日以内のデータを取るか 
   * @param string $db_name 更新するDBのテーブルの名前
   * @param int $min_stock Qiitaの記事がストックされた数の最低数を決める
   * @return void Qiitaのデータを取得しDBのデータを更新
   */
  public function main($days, $db_name, $min_stock)
  {
    $client = new Client;
    $options = $this->create_request_data($days, $min_stock);
    $total_contents = $this->get_qiita_posts($client, $this->method, $options);
    // 並び替え
    $sort_contents = $this->sort_likes_count($total_contents);
    // DB用にデータの様式を変更する
    $db_datas = $this->create_db_datas($sort_contents);
    $new_rank_titles = $this->update_db($db_name, $db_datas);
    Log::info($db_name."のデータを更新しました");
    return $new_rank_titles;
  }

  // データ取得のリクエストデータを作成
  public function create_request_data($days, $min_stock)
  {
    $day = $this->generate_days($days);
    $data['per_page'] = $this->per_page;
    $data['page'] = $this->page;
    $query_params = '';
    $query_params = $this->query_params_set($query_params, "stocks:>${min_stock}");
    $query_params = $this->query_params_set($query_params, "created:>=${day}");

    if($query_params != '') {
      $data['query'] = $query_params;
    }

    $options = [
      'query' => $data,
      'verify' => false,
      'headers' => [
        'Authorization' => 'Bearer '.$this->token,
        'Content-Type' => 'application/json'
      ]
    ];

    return $options;
  }

  // データ取得処理
  public function get_qiita_posts($client, $method, $options)
  {
    $loop_flag = true;
    $total_contents = [];
    $count = 0;
    while($loop_flag) {
      $response = $client->request($method, $this->url, $options);
      $contents = $response->getBody()->getContents();
      $contents = json_decode($contents, true);
      // 追加
      $total_contents = array_merge($total_contents, $contents);
      $options['query']['page']++;
      // pageの配列が尽きたら
      if(count($contents) != $this->per_page) {
        $loop_flag = false;
        break;
      }
      if($count == 5) {
        break;
      }
      $count++;
    }
    return $total_contents;
  }

  // データベースの更新
  public function update_db($db_name, $db_datas)
  {
    $old_data = DB::table($db_name)->get();
    $new_rank_titles = $this->getNewRankIds($old_data, $db_datas);
    // is_new追加
    foreach ($db_datas as $index => $data) {
      if(in_array($data['title'], $new_rank_titles)) {
        $db_datas[$index]['is_new'] = true;
      }
    }
    // 古いDBデータ削除
    DB::table($db_name)->delete();
    // DBに保存
    DB::table($db_name)->insert($db_datas);
    return $new_rank_titles;
  }

  // LikeCount順に並べ替え
  public function sort_likes_count($contents)
  {
    // 並び替え
    $result = $this->sortByKey('likes_count', SORT_DESC, $contents);
    // 20位未満削除
    $result = array_slice($result, 0, 20);
    return $result;
  }

  // query set
  public function query_params_set($query_params, $value)
  {
    $query_params = $query_params.' '.$value;
    return $query_params;
  }

  // 日付求める処理
  public function generate_days($day) {
    $date = new Carbon("-${day} day");
    $date = $date->format("Y-m-d");
    return $date;
  }

  // 並び替え
  public function sortByKey($key_name, $sort_order, $array) {
    foreach ($array as $key => $value) {
      $standard_key_array[$key] = $value[$key_name];
    }
    array_multisort($standard_key_array, $sort_order, $array);
    return $array;
  }

  // データベース用のデータに変更
  public function create_db_datas($sort_contents)
  {
    $db_datas = [];
    foreach ($sort_contents as $content) {
      // DB用データ作成
      $data = [
        'post_id' => $content['id'],
        'post_url' => $content['url'],
        'title' => $content['title'],
        'user_image_url' => $content['user']['profile_image_url'],
        'user_name' => $content['user']['id'],
        'likes_count' => $content['likes_count'],
        'created_at' => $content['created_at'],
        'tags' => json_encode($content['tags'])
      ];
      // 配列に追加
      $db_datas[] = $data;
    }
    return $db_datas;
  }

  // 新規のランキングのIDを取得
  public function getNewRankIds($old_data, $db_datas)
  {
    $new_db_data = collect($db_datas);
    $new_data_ids = $new_db_data->pluck('post_id');
    $new_rank_titles = $old_data->whereNotIn('post_id', $new_data_ids)->pluck('title');
    // コレクションではemptyに引っかからないため
    return $new_rank_titles->toArray();
  }
}

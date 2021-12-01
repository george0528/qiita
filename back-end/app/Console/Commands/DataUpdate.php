<?php

namespace App\Console\Commands;

use App\Models\Post;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DataUpdate extends Command
{
  // クラス変数
  public $url = 'https://qiita.com/api/v2/items/';
  public $token = '5fbe77e0acd1cb34b2d2e0877b68fab6729ca251';
  public $page = 1;
  public $per_page = 20;
  public $data = [];
  public $query_params = '';
  public $loop_flag = true;
  public $contents = [];
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
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle(Post $post)
  {
    // qiita api
    $client = new Client();
    $method = 'GET';
    $day = $this->generate_days(7);
    $this->data['per_page'] = $this->per_page;
    $this->data['page'] = $this->page;
    $this->query_params_set('stocks:>7');
    $this->query_params_set("created:>=${day}");
    if($this->query_params) {
      $this->data['query'] = $this->query_params;
    }
    $options = [
      'query' => $this->data,
      'verify' => false,
      'headers' => [
        'Authorization' => 'Bearer '.$this->token,
        'Content-Type' => 'application/json'
      ]
    ];
    $response = $client->request($method, $this->url, ['verify' => false]);
    while($this->loop_flag) {
      $response = $client->request($method, $this->url, $options);
      $contents = $response->getBody()->getContents();
      $contents = json_decode($contents, true);
      // 追加
      $this->contents = array_merge($this->contents, $contents);
      $this->page++;
      $options['query']['page'] = $this->page;
      // pageの配列が尽きたら
      if(count($contents) != $this->per_page) {
        $this->loop_flag = false;
        // 並び替え
        $result = $this->sortByKey('likes_count', SORT_DESC, $this->contents);
        $result = array_slice($result, 0, 10);
        // 古いDBデータ削除
        DB::table('posts')->delete();
        $test_contents = [];
        foreach ($result as $content) {
          // DBデータ作成
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
          // DB追加
          $post->create($data);
          unset($content['rendered_body']);
          unset($content['body']);
          $test_contents[] = $content;
        }
        break;
      }
    }
    Log::alert("データを更新しました");
    return Command::SUCCESS;
  }
  // query set
  public function query_params_set($value)
  {
    $this->query_params = $this->query_params.' '.$value;
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
}

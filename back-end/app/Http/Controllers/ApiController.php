<?php

namespace App\Http\Controllers;

use App\Models\MonthPost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
  // 定数
  private const PERIOD_TYPE_WEEK = 1;
  private const PERIOD_TYPE_MONTH = 1;

  // 関数
  public function index(Request $request, Post $post, MonthPost $monthPost)
  {
    $val = Validator::make($request->all(), [
      'type' => ['required', 'integer', 'between:1,2'],
    ]);

    if($val->fails()) {
      return response()->json('バリデーションエラー', 400);
    }

    $data = $val->validated();
    switch ($data['type']) {
      case self::PERIOD_TYPE_WEEK:
        $res = $post->all();
        break;
      case self::PERIOD_TYPE_MONTH:
        $res = $monthPost->all();
        break;
      // デフォルトは週間(week)
      default:
        $res = $post->all();
        break;
    }

    // タグがシリアライズされているから解除する
    foreach ($res as $index => $content) {
      $res[$index]['tags'] = json_decode($content['tags']);
    }

    return response()->json($res);
  }
}

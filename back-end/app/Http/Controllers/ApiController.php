<?php

namespace App\Http\Controllers;

use App\Models\MonthPost;
use App\Models\Post;
use App\Models\ThreePost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
  // 定数
  const PERIOD_TYPE_WEEK = 1;
  const PERIOD_TYPE_MONTH = 2;
  const PERIOD_TYPE_THREE = 3;

  // 関数
  public function index(Request $request, Post $post, MonthPost $monthPost, ThreePost $threePost)
  {
    $val = Validator::make($request->all(), [
      'type' => ['required', 'integer', 'between:1,3'],
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
      case self::PERIOD_TYPE_THREE:
        $res = $threePost->all();
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

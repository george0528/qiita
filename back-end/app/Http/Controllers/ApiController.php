<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ApiController extends Controller
{
  public function index(Post $post)
  {
    $res = $post->all();
    foreach ($res as $index => $content) {
      $res[$index]['tags'] = json_decode($content['tags']);
    }
    return response()->json($res);
  }
}

<?php

namespace Tests\TestData;

use Faker\Factory as FakerFactory;
use Faker\Generator;

/** 
 * @property Generator $faker
 */
class TestFactory
{

  public function __construct() {
    $faker = FakerFactory::create('ja_JP');
    $this->faker = $faker;
  }
  
  /** 
   * 記事の一覧を取得する
   * ただし、likes_countが昇順の物である。
   * 
   * @param int $count
   * @return array $datas
   */
  public function getContents($count)
  {
    $datas = [];
    for ($i=0; $i < $count; $i++) {
      $currentMaxNum = $this->getCurrentMaxNum($datas);
      $datas[] = $this->getContent($currentMaxNum);
    }

    // 降順にする
    $descDatas = array_reverse($datas);
    return $descDatas;
  }

  private function getContent($currentMaxNum) {
    $likesCount = $currentMaxNum + $this->faker->numberBetween(1, 3);
    return [
      'title' => $this->faker->name,
      'likes_count' => $likesCount,
    ];
  }

  private function getCurrentMaxNum($array)
  {
    if(count($array) == 0) {
      return 0;
    }

    $lastKey = array_key_last($array);
    return $array[$lastKey]['likes_count'];
  }
}

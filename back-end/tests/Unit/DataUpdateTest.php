<?php

namespace Tests\Unit;

use App\Console\Commands\DataUpdate;
use App\Models\Post;
use Carbon\Carbon;
use Tests\TestCase;
use Tests\TestData\TestFactory;

/** 
 * @property TestFactory $factory
 * @property DataUpdate $class
 */
class DataUpdateTest extends TestCase
{
    // テストで使う DataUpdateクラスのprivateクラス変数
    private $url = 'https://qiita.com/api/v2/items/';
    private $page = 1;
    private $per_page = 100;
    private $method = 'GET';

    public function setUp(): void
    {
        parent::setUp();
        $this->factory = new TestFactory();
        $this->class = new DataUpdate();
    }
    
    public function test_generate_day()
    {
        $day = 3;
        $date = new Carbon("-${day} day");
        $expectation = $date->format("Y-m-d");

        $result = $this->class->generate_days($day);
        
        $this->assertEquals($result, $expectation);
    }

    public function test_query_params_set()
    {
        $result = $this->class->query_params_set('', 'test');
        
        $this->assertEquals($result, ' test');
    }

    public function test_create_request_data()
    {
        $day = 3;
        $minStock = 10;
        $minCreatedDate = $this->class->generate_days($day);

        $data['per_page'] = $this->per_page;
        $data['page'] = $this->page;
        $data['query'] = " stocks:>${minStock} created:>=${minCreatedDate}";

        $options = [
            'query' => $data,
            'verify' => false,
            'headers' => [
              'Authorization' => 'Bearer '.$this->class->token,
              'Content-Type' => 'application/json'
            ]
        ];

        $result = $this->class->create_request_data($day, $minStock);
        $this->assertEquals($options, $result);
    }

    public function test_sortByKey()
    {
        $key_name = 'likes_count';
        $sort_order = SORT_DESC;

        $expectation = $this->factory->getContents(30);

        $contents = $expectation;
        shuffle($contents);

        $this->assertNotEquals($contents, $expectation);

        $result = $this->class->sortByKey($key_name, $sort_order, $contents);
        
        $this->assertEquals($result, $expectation);
    }
}

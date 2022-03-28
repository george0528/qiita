<?php

namespace Tests\Feature;

use App\Http\Controllers\ApiController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiE2ETest extends TestCase
{
    // セットアップ
    public function setUp(): void
    {
        parent::setUp();
        $this->url = '/api';
    }

    // 週間ランキングの取得
    public function test_get_week_ranking()
    {
        $param = [
            'type' => ApiController::PERIOD_TYPE_WEEK
        ];
        $response = $this->getJson(route('ranking', $param));

        $response->assertStatus(200);
    }

    // 月間ランキングの取得
    public function test_get_month_ranking()
    {
        $param = [
            'type' => ApiController::PERIOD_TYPE_MONTH
        ];
        $response = $this->getJson(route('ranking', $param));

        $response->assertStatus(200);
    }

    // 3日間ランキングの取得
    public function test_get_three_ranking()
    {
        $param = [
            'type' => ApiController::PERIOD_TYPE_THREE
        ];
        $response = $this->getJson(route('ranking', $param));

        $response->assertStatus(200);
    }
}
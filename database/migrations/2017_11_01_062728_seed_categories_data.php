<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCategoriesData extends Migration
{
    public function up()
    {
        $categories = [
            [
                'name'        => '酒店住宿',
                'description' => '酒店住宿等',
            ],
            [
                'name'        => '特价影票',
                'description' => '特价影票等',
            ],
            [
                'name'        => '车票机票',
                'description' => '车票机票等',
            ],
            [
                'name'        => '打车出行',
                'description' => '打车出行等',
            ],
            [
                'name'        => '行业趋势',
                'description' => '行业趋势等',
            ],
            [
                'name'        => '市场机遇',
                'description' => '市场机遇等',
            ],
            [
                'name'        => '商友案例',
                'description' => '商友案等',
            ],
            [
                'name'        => '本地服务',
                'description' => '本地服务等',
            ],
            [
                'name'        => '精选banner',
                'description' => '本地服务等',
            ],
            [
                'name'        => '服务banner',
                'description' => '本地服务等',
            ],
            [
                'name'        => '资讯banner',
                'description' => '本地服务等',
            ],
        ];

        DB::table('categories')->insert($categories);
    }

    public function down()
    {
        DB::table('categories')->truncate();
    }
}
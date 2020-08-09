<?php

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('articles')->truncate();

        DB::table('articles')->insert([
            [
                'user_id' => 1,
                'title' => 'おはよう',
                'body' => '今日はいい天気ですね',
                'created_at' => '2020-08-08 07:44:40',
                'updated_at' => '2020-08-08 07:44:40'
            ],
            [
                'user_id' => 2,
                'title' => 'ピクニック',
                'body' => 'サンドイッチを作ったのでピクニックにでも行きませんか？',
                'created_at' => '2020-08-08 07:44:40',
                'updated_at' => '2020-08-08 07:44:40'
            ],
            [
                'user_id' => 3,
                'title' => '台風情報',
                'body' => '午後から台風で天気が悪くなるらしい',
                'created_at' => '2020-08-08 07:44:40',
                'updated_at' => '2020-08-08 07:44:40'
            ]
        ]);
    }
}

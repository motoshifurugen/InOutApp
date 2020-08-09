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
                'title' => 'title1',
                'body' => 'body1',
                'created_at' => '2020-08-08 07:44:40',
                'updated_at' => '2020-08-08 07:44:40'
            ],
            [
                'user_id' => 2,
                'title' => 'title2',
                'body' => 'body2',
                'created_at' => '2020-08-08 07:44:40',
                'updated_at' => '2020-08-08 07:44:40'
            ],
            [
                'user_id' => 3,
                'title' => 'title3',
                'body' => 'body3',
                'created_at' => '2020-08-08 07:44:40',
                'updated_at' => '2020-08-08 07:44:40'
            ]
        ]);
    }
}

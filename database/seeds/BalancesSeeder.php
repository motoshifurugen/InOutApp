<?php

use Illuminate\Database\Seeder;

class BalancesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('balances')->insert([
            ['user_id'=> 1, 'transaction_date' => now(), 'category_id' => '0', 'amount' => 10000, 'memo' => '入金' ],
            ['user_id'=> 2, 'transaction_date' => now(), 'category_id' => '1', 'amount' => -2000, 'memo' => '購入' ],
            ['user_id'=> 3, 'transaction_date' => now(), 'category_id' => '2', 'amount' => -1000, 'memo' => '購入' ],
            ['user_id'=> 4, 'transaction_date' => now(), 'category_id' => '2', 'amount' => -1000, 'memo' => '購入' ],
            ['user_id'=> 5, 'transaction_date' => now(), 'category_id' => '2', 'amount' => -1000, 'memo' => '購入' ],
            ['user_id'=> 6, 'transaction_date' => now(), 'category_id' => '2', 'amount' => -1000, 'memo' => '購入' ]
        ]);
    }
}

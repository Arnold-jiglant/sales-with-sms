<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SellMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sell_methods')->insert([
            [
                'method' => 'FIFO',
                'description' => 'First inventory added will be the first to be sold',
            ],
            [
                'method' => 'LIFO',
                'description' => 'Last inventory added will be the first to be sold',
            ],
        ]);
    }
}

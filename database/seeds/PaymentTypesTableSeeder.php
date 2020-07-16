<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_types')->insert([
            [
                'name'=>'Cash',
                'description'=>'Direct receiving cash',
            ],
            [
                'name'=>'Credit',
                'description'=>'Payment made electronically',
            ],
            [
                'name'=>'Debit',
                'description'=>'Payment will be made later',
            ]
        ]);
    }
}

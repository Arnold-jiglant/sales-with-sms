<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('expense_types')->insert([
            ['name'=>'Transport'],
            ['name'=>'Taxes'],
            ['name'=>'Rent'],
            ['name'=>'Other'],
        ]);
    }
}

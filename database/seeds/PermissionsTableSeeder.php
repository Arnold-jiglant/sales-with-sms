<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['code'=>'US1', 'name'=>'View Users'],
            ['code'=>'US2', 'name'=>'Add Users'],
            ['code'=>'US3', 'name'=>'Edit Users'],
            ['code'=>'US4', 'name'=>'Delete Users'],
            ['code'=>'CU1', 'name'=>'View Customers'],
            ['code'=>'CU2', 'name'=>'Add Customers'],
            ['code'=>'CU3', 'name'=>'Edit Customers'],
            ['code'=>'CU4', 'name'=>'Delete Customers'],
            ['code'=>'EX1', 'name'=>'View Expenses'],
            ['code'=>'EX2', 'name'=>'Add Expenses'],
            ['code'=>'EX3', 'name'=>'Edit Expenses'],
            ['code'=>'EX4', 'name'=>'Delete Expenses'],
            ['code'=>'IN1', 'name'=>'View Inventory'],
            ['code'=>'IN2', 'name'=>'Add Inventory'],
            ['code'=>'IN3', 'name'=>'Edit Inventory'],
            ['code'=>'IN4', 'name'=>'Delete Inventory'],
            ['code'=>'INC1', 'name'=>'View Incomes'],
            ['code'=>'INC2', 'name'=>'Add Income'],
            ['code'=>'INC3', 'name'=>'Edit Income'],
            ['code'=>'INC4', 'name'=>'Delete Income'],
            ['code'=>'SE1', 'name'=>'Sell Product'],
            ['code'=>'RE1', 'name'=>'View Report'],
        ]);
    }
}

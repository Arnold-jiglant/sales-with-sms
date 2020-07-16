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
            ['name'=>'View Users'],
            ['name'=>'Add Users'],
            ['name'=>'Edit Users'],
            ['name'=>'Delete Users'],
            ['name'=>'View Customers'],
            ['name'=>'Add Customers'],
            ['name'=>'Edit Customers'],
            ['name'=>'Delete Customers'],
            ['name'=>'View Expenses'],
            ['name'=>'Add Expenses'],
            ['name'=>'Edit Expenses'],
            ['name'=>'Delete Expenses'],
            ['name'=>'View Inventory'],
            ['name'=>'Add Inventory'],
            ['name'=>'Edit Inventory'],
            ['name'=>'Delete Inventory'],
            ['name'=>'Sell Product'],
            ['name'=>'View Report'],
        ]);
    }
}

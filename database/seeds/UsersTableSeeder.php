<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'fname'=>'Manager',
            'lname'=>'Manager',
            'email'=>'manager@manager.com',
            'password'=>Hash::make('manager'),
            'role_id'=>1,
            'active'=>true,
        ]);
    }
}

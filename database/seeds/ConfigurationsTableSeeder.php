<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configurations')->insert([
            'name'=>'sellMethod',
            'value'=>1,
            'description'=>'Algorithm used for selling products',
        ]);
    }
}

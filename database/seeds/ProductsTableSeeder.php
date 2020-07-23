<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            ['name'=>'Apple',  'hasSize'=>false,],
            ['name'=>'U-Fresh',  'hasSize'=>false,],
            ['name'=>'Unga wa Ngano 25Kg',  'hasSize'=>false,],
            ['name'=>'Mafuta ya Kupikia 10L',  'hasSize'=>false,],
            ['name'=>'Maharage',  'hasSize'=>true,],
            ['name'=>'Mchele',  'hasSize'=>true,],
            ['name'=>'Mafuta ya Taa',  'hasSize'=>true,],
        ]);
    }
}

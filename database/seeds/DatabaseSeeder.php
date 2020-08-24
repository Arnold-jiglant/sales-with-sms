<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ConfigurationsTableSeeder::class,
//            UsersTableSeeder::class,
            DiscountTypesTableSeeder::class,
            PaymentTypesTableSeeder::class,
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            SellMethodsTableSeeder::class,
//            ProductsTableSeeder::class,
//            ExpenseTypesTableSeeder::class,
        ]);
    }
}

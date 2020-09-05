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
            [
                'name' => 'sellMethod',
                'value' => 1,
                'description' => 'Algorithm used for selling products',
            ],
            [
                'name' => 'backup_email',
                'value' => 'jiglantdeveloper@gmail.com',
                'description' => 'Email for storing database backups',
            ],
            [
                'name' => 'backup_time',
                'value' => '00:00',
                'description' => 'Time for taking database backup',
            ],
            [
                'name' => 'backup_database',
                'value' => false,
                'description' => 'Whether yes or no to take database backup',
            ],
        ]);
    }
}

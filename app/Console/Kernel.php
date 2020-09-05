<?php

namespace App\Console;

use App\Configuration;
use App\Notifications\DatabaseBackup;
use App\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('backup:run --only-db')
            ->dailyAt(Configuration::whereName('backup_time')->first()->value)
            ->when(function () {
                return (bool)Configuration::whereName('backup_database')->first()->value;
            })
            ->onSuccess(function () {
                $path = storage_path('app/' . collect(\Illuminate\Support\Facades\Storage::files('Sales'))->reverse()->first());
                $user = new User([
                    'fname' => 'Manager',
                    'lname' => 'Manager',
                    'email' => Configuration::whereName('backup_email')->first()->value,
                ]);
                $user->notify(new DatabaseBackup($path));
            })->runInBackground();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}

<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('app:appointment-reminder')
        ->weekdays()
        ->dailyAt('7:00')
        ->emailOutputTo('gusta.acp@gmail.com');

        $schedule->command('app:treatment-reminder')
        ->weekdays()
        ->twiceDaily(6, 18)
        ->emailOutputTo('gusta.acp@gmail.com');

        $schedule->command('app:update-status-dairy')
        ->weekdays()
        ->dailyAt('17:00')
        ->emailOutputTo('gusta.acp@gmail.com');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

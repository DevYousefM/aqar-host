<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:expired-properties')->daily();
        $schedule->command('app:delete-slides')->daily();
        $schedule->command('app:expired-properties')->everyMinute();       
        $schedule->command('app:expired-properties')->everyMinute()->sendOutputTo(storage_path("logs/profit_output.txt"))->appendOutputTo(storage_path('logs/profit_output.txt'));

    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}

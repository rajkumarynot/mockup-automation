<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
   protected $commands = [
    Commands\ReadEmailCommand::class,
];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('read:emails')->everyFiveMinute();
        $schedule->command('read:replies')->everyFivMinutes();

    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
    
}
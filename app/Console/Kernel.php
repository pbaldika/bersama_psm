<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Investment;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $now = Carbon::now();
            $overdueInvestments = Investment::where('status', 'pending')
                ->where('payment_deadline', '<', $now)
                ->get();

            foreach ($overdueInvestments as $investment) {
                // Update the status of the investment to "rejected" or take any other necessary actions
                $investment->status = 'rejected';
                $investment->save();
            }
        })->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
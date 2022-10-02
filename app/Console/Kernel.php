<?php

namespace App\Console;

use App\Models\GlobalVariable;
use App\Models\RentStatus;
use App\Models\Reservation;
use App\Models\ReservationStatuses;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Carbon;
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        
        // Schedule for expired reservations
        $schedule->call(function () {
        $reservations = Reservation::where('request_date', '<', Carbon::now()->subDays(1))->pluck('id')->toArray();
        ReservationStatuses::whereIn('id', $reservations)->update(['status_reservations_id' => '5']);
        })->everyMinute();

        // Schedule for user delete
        $schedule->call(function () {
        $users = User::where('last_login_at', '<', Carbon::now()->subDays(365))->delete();
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

<?php

namespace App\Providers;

use App\Models\Rent;
use App\Models\ReservationStatuses;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Localization Carbon
        Carbon::setLocale('sr');

        // Notifications
        $rents_c = Rent::all();
        $reservations_c = ReservationStatuses::all();
        if (count($rents_c) > 0 && count($reservations_c) > 0) {
        $rents = Rent::whereDate('issue_date', today())->get();
        $reservation = ReservationStatuses::whereDate('created_at', today())->get();
        $notifications = $rents->count() + $reservation->count();
        } else {
            $notifications = 0;
        }
        JsonResource::withoutWrapping();
        view()->share('notifications', $notifications);

          /**
         * Paginate a standard Laravel Collection.
         *
         * @param int $perPage
         * @param int $total
         * @param int $page
         * @param string $pageName
         * @return array
         */
    }
}

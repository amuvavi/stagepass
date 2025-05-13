<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\TicketPurchaseServiceContract;
use App\Services\TicketPurchaseService;
use App\Contracts\SeatAvailabilityServiceContract;
use App\Services\SeatAvailabilityService;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
         $this->app->bind(TicketPurchaseServiceContract::class, TicketPurchaseService::class);
         $this->app->bind(SeatAvailabilityServiceContract::class, SeatAvailabilityService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

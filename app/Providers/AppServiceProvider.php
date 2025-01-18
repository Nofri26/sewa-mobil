<?php

namespace App\Providers;

use App\Repositories\CarRepository;
use App\Repositories\CarRepositoryInterface;
use App\Repositories\RentalRepository;
use App\Repositories\RentalRepositoryInterface;
use App\Services\CarService;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CarRepositoryInterface::class, CarRepository::class);
        $this->app->bind(RentalRepositoryInterface::class, RentalRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}

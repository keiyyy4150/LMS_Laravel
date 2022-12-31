<?php

namespace App\Providers;

use App\Repositories\ScheduleRepository;
use App\Repositories\ScheduleRepositoryInterface;
use App\Repositories\SettingRepository;
use App\Repositories\SettingRepositoryInterface;
use App\Services\ScheduleService;
use App\Services\ScheduleServiceInterface;
use App\Services\SettingService;
use App\Services\SettingServiceInterface;
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
        // repository
        $this->app->bind(
            ScheduleRepositoryInterface::class,
            ScheduleRepository::class
        );
        $this->app->bind(
            SettingRepositoryInterface::class,
            SettingRepository::class
        );

        // service
        $this->app->bind(
            ScheduleServiceInterface::class,
            ScheduleService::class
        );
        $this->app->bind(
            SettingServiceInterface::class,
            SettingService::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

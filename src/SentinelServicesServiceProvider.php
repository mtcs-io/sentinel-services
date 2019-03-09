<?php

namespace Sentinel\Services;

use Illuminate\Support\ServiceProvider;

class SentinelServicesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
    }

    public function boot()
    {

    }
}

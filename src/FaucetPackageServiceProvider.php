<?php

namespace Firdavs\Faucetpay;

use Illuminate\Support\ServiceProvider;

class FaucetPackageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'faucetpay');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('faucetpay.php'),
            ], 'config');
        }
    }
}

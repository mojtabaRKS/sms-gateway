<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Support\SmsGateway\Contracts\SmsGatewayInterface;

class SmsGatewayProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(SmsGatewayInterface::class, function ($app) {
            $driver = config('sms-gateway.default');
            return $this->resolveAdapter($driver);
        });
    }

    /**
     * @param string $driver
     * 
     * @return SmsGatewayInterface
     */
    private function resolveAdapter(string $driver): SmsGatewayInterface
    {
        $adapter = config("sms-gateway.drivers.$driver.adapter");
        return new $adapter;
    }
}

<?php

namespace App\Providers;

use App\Http\service\ChannelService;
use App\Http\service\InInterface\IChannelService;
use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IChannelService::class,ChannelService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

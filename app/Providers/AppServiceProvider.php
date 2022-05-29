<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
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
        Http::macro('openweather', function ($options) {

            $url = config('openweather.url');
            $apikey = config('openweather.appid');

            $options = array_merge($options, ['appid' => $apikey, 'lang' => 'es', 'units' => 'metric']);
            return Http::retry(3, 200)
                ->baseUrl($url)
                ->withOptions(['query' => $options])
                ->acceptJson();
        });
    }
}

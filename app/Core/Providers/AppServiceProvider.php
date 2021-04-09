<?php

namespace App\Core\Providers;

use App\Services\Payments\Gateways\Flutterwave;
use App\Services\Reminders\Reminder;
use App\Services\SmsGateways\Mnotify;
use App\Services\VoiceGateways\VoiceMnotify;
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
        $this->app->singleton(Reminder::class, function($app) {
            return new Reminder();
        });

        $this->app->singleton(Mnotify::class, function($app) {
            return new Mnotify();
        });

         $this->app->singleton(VoiceMnotify::class, function($app) {
            return new VoiceMnotify();
        });

        $this->app->singleton(flutterwave::class, function($app) {
            return new Flutterwave();
        });
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

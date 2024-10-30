<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        if (config('app.env') === 'local') {
            //URL::forceScheme('https');
            //URL::forceRootUrl('https://mitkov-systems.local');
        } else if (config('app.env') === 'staging') {
            URL::forceScheme('https');
            URL::forceRootUrl('https://next.mitkov-systems.de');
        } else {
            URL::forceScheme('https');
            URL::forceRootUrl('https://www.mitkov-systems.de');
        }

        \Carbon\CarbonInterval::setCascadeFactors([
            'minute' => [60, 'seconds'],
            'hour' => [60, 'minutes'],
            'day' => [24, 'hours'],
            'year' => [365, 'days'],
        ]);
    }
}

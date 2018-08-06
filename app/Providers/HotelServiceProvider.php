<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HotelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // bootstrap the file that contain custom validation rules
        $this->app->make('validator')->extend('is_pure_ascii', function ($attribute, $value, $parameters)
        {
            return !preg_match('/[^\x20-\x7f]/', $value);
        });

        $this->app->make('validator')->extend('phone', function ($attribute, $value, $parameters)
        {
            return preg_match('/^[0-9\-\(\)\/\+\s]*$/', $value);
        });

        // add routes
        require_once base_path('/hotels/routes/web.php');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('hotels', function ($app) {});
    }
}

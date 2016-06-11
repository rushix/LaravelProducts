<?php

namespace Rushix\LaravelProducts;

use Illuminate\Support\ServiceProvider;

class LaravelProductsServiceProvider extends ServiceProvider
{
    const UNIQUE_PACKAGE_IDENTIFIER = 'rushi-products';
    
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/config.php', self::UNIQUE_PACKAGE_IDENTIFIER . '-config'
        );

        $this->app->bind(self::UNIQUE_PACKAGE_IDENTIFIER, function() {
            return new LaravelProducts;
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/migrations' => $this->app->databasePath() . '/migrations'
        ], 'migrations');
        
        $this->publishes([
            __DIR__ . '/views' => base_path('resources/views/vendor/' . self::UNIQUE_PACKAGE_IDENTIFIER),
            __DIR__ . '/config' => config_path(self::UNIQUE_PACKAGE_IDENTIFIER),
        ]);
        
        require __DIR__ . '/Http/routes.php';

        $this->loadViewsFrom(__DIR__ . '/views', self::UNIQUE_PACKAGE_IDENTIFIER);

        $this->app['validator']->extend('checkrole', function ($attribute, $value, $parameters)
        {
            if ($parameters[0] !== 'admin' && $parameters[1] !== $value) {
                return false;
            }
            return true;
        });
    }
}

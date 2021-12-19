<?php

namespace Kaiyum2012\SocialiteAuth;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Kaiyum2012\SocialiteAuth\Contracts\Sociable;
use Throwable;

class SocialiteAuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     * @throws Throwable
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'socialite-auth');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'socialite-auth');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('socialite-auth.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/socialite-auth'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/socialite-auth'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/socialite-auth'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }

        throw_if(!app()->make(config('socialite-auth.user_model')) instanceof Sociable, new Exception('Provided User model should be type of Sociable'));
        throw_if(!app()->make(config('socialite-auth.user_model')) instanceof Model, new Exception('Provided User model should be type of eloquent'));

    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'socialite-auth');

        // Register the main class to use with the facade
        $this->app->singleton('socialite-auth', function () {
            return new SocialiteAuth;
        });
    }
}

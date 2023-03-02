<?php

namespace Brycedev\Peek;

use Inertia\Inertia;
use Brycedev\Peek\HallMonitor;
use Illuminate\Support\ServiceProvider;

class PeekServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->configureInertia();

        $this->registerMigrations();
        $this->registerPublications();

        if (! config('laravel-peek.enabled')) {
            return;
        }

        $this->registerRoutes();
        $this->registerViews();

        HallMonitor::start($this->app);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-peek.php', 'laravel-peek');
    }

    private function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    private function registerPublications()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/laravel-peek.php' => config_path('peek.php'),
            ], 'laravel-peek-config');
        }
    }

    private function registerRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }

    private function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel-peek');
    }

    private function configureInertia()
    {
        if (config('app.env') == 'testing') {
            return;
        }
        Inertia::version(function () {
            return md5_file(public_path('vendor/laravel-peek/mix-manifest.json'));
        });
        Inertia::setRootView('laravel-peek::app');
    }
}

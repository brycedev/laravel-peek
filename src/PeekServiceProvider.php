<?php

namespace Brycedev\Peek;

use Inertia\Inertia;
use Brycedev\Peek\HallMonitor;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class PeekServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->configureInertia();

        $this->registerCommands();
        $this->registerMigrations();
        $this->registerPublications();

        if (! config('peek.enabled')) {
            return;
        }

        $this->registerRoutes();
        $this->registerViews();

        HallMonitor::start($this->app);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/peek.php', 'peek');
    }

    private function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\CleanCommand::class,
                Console\PublishCommand::class,
                Console\ResetCommand::class
            ]);
        }
    }

    private function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    private function registerPublications()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'peek-migrations');

            $this->publishes([
                __DIR__ . '/../config/peek.php' => config_path('peek.php'),
            ], 'peek-config');

            $this->publishes([
                __DIR__.'/../public' => public_path('vendor/peek'),
            ], ['peek-assets', 'laravel-assets']);
        }
    }

    private function registerRoutes()
    {
        Route::group([
            'domain' => config('peek.domain', null),
            'middleware' => config('peek.middleware', ['web']),
            'namespace' => 'Brycedev\Peek\Http\Controllers',
            'prefix' => config('peek.path'),
            'name' => 'peek.',
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
        });
    }

    private function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'peek');
    }

    private function configureInertia()
    {
        if (config('app.env') == 'testing') {
            return;
        }
        Inertia::version(function () {
            return md5_file(public_path('vendor/peek/mix-manifest.json'));
        });
        Inertia::setRootView('peek::app');
    }
}

<?php

namespace Brycedev\Peek\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Routing\Router;
use Brycedev\Peek\Models\RequestRecord;
use Brycedev\Peek\PeekServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    protected function getPackageProviders($app)
    {
        return [PeekServiceProvider::class];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $config = $app->get('config');
        $config->set('database.default', 'testbench');
//        $config->set('logging.default', 'errorlog');

        $config->set('database.default', 'testbench');
        $config->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
        $config->set('laravel-peek.ignore_paths', [
            'ignored/*'
        ]);

        /** @var Router $router */
        $router = $app['router'];

        $this->addWebRoutes($router);
    }

    /**
     * @param Router $router
     */
    protected function addWebRoutes(Router $router)
    {
        $router->get('web/ping', function () {
            return 'PONG';
        });

        $router->get('web/query', function () {
            RequestRecord::count();
            RequestRecord::get();
            return '2 queries executed';
        });

        $router->get('web/error', function () {
            throw new \RuntimeException('Whoops');
        });
    }
}
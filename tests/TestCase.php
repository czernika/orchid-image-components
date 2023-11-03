<?php

namespace Tests;

use Czernika\OrchidImages\OrchidImagesServiceProvider;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Orchid\Platform\Providers\FoundationServiceProvider as OrchidServiceProvider;
use Orchid\Screen\Field;
use Plannr\Laravel\FastRefreshDatabase\Traits\FastRefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    use WithWorkbench, InteractsWithViews, FastRefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            OrchidServiceProvider::class,
            OrchidImagesServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app)
    {
        tap($app['config'], function (Repository $config) {
            $config->set('database.default', 'testing');
            $config->set('database.connections.testing', [
                'driver'   => 'sqlite',
                'database' => ':memory:',
                'prefix'   => '',
            ]);
        });
    }

    protected function defineDatabaseMigrations()
    {
        $this->loadLaravelMigrations();
        $this->artisan('orchid:install');
    }

    public function renderComponent(Field $component): string
    {
        return $component->render()->render();
    }
}

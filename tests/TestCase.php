<?php

namespace Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Czernika\OrchidImages\OrchidImagesServiceProvider;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Orchid\Attachment\Models\Attachment as OrchidAttachment;
use Orchid\Platform\Dashboard;
use Orchid\Platform\Providers\FoundationServiceProvider as OrchidServiceProvider;
use Orchid\Screen\Field;
use Orchid\Screen\LayoutFactory;
use Orchid\Screen\Repository as ScreenRepository;
use Plannr\Laravel\FastRefreshDatabase\Traits\FastRefreshDatabase;
use Tests\Models\Attachment;

abstract class TestCase extends BaseTestCase
{
    use WithWorkbench, InteractsWithViews, FastRefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(function ($factory) {
            $factoryBasename = class_basename($factory);

            return "Database\Factories\\$factoryBasename".'Factory';
        });

        Dashboard::useModel(OrchidAttachment::class, Attachment::class);
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
        $this->loadMigrationsFrom(dirname(__DIR__, 1) . '/database/migrations');
        $this->artisan('orchid:install');
    }

    public function renderComponent(Field $component, ?array $data = []): string
    {
        $repository = new ScreenRepository($data);

        $layout = LayoutFactory::rows([$component]);

        return $layout->build($repository)->withErrors([])->render();
    }
}

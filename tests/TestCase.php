<?php

namespace Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Orchid\Attachment\Models\Attachment as OrchidAttachment;
use Orchid\Platform\Dashboard;
use Orchid\Screen\Field;
use Orchid\Screen\LayoutFactory;
use Orchid\Screen\Repository as ScreenRepository;
use Tests\Models\Attachment;
use Orchid\Support\Facades\Alert;
use Tabuna\Breadcrumbs\Breadcrumbs;
use Watson\Active\Active;

abstract class TestCase extends BaseTestCase
{
    use WithWorkbench, InteractsWithViews, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(function ($factory) {
            $factoryBasename = class_basename($factory);

            return "Database\Factories\\$factoryBasename".'Factory';
        });

        // Use our test mockup model instead
        Dashboard::useModel(OrchidAttachment::class, Attachment::class);
    }

    /**
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getPackageAliases($app): array
    {
        return [
            'Alert' => Alert::class,
            'Active' => Active::class,
            'Breadcrumbs' => Breadcrumbs::class,
            'Dashboard' => Dashboard::class,
        ];
    }

    protected function defineDatabaseMigrations()
    {
        $this->loadLaravelMigrations();
        $this->loadMigrationsFrom(dirname(__DIR__, 1) . '/database/migrations');
    }

    public function renderComponent(Field $component, ?array $data = []): string
    {
        $repository = new ScreenRepository($data);

        $layout = LayoutFactory::rows([$component]);

        return $layout->build($repository)->withErrors([])->render();
    }
}

<?php

declare(strict_types=1);

namespace Czernika\OrchidImages;

use Illuminate\Support\ServiceProvider;

class OrchidImagesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom($this->resolvePath('/resources/views'), 'orchid-images');

        $this->publishes([
            $this->resolvePath('/dist') => public_path('vendor/orchid-images'),
        ], 'laravel-assets');
    }

    public function register()
    {
        // ...
    }

    protected function resolvePath(string $path): string
    {
        return dirname(__DIR__, 1) . $path;
    }
}

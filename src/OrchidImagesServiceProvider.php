<?php

declare(strict_types=1);

namespace Czernika\OrchidImages;

use Illuminate\Support\ServiceProvider;

class OrchidImagesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(dirname(__DIR__, 1) . '/resources/views', 'orchid-images');
    }

    public function register()
    {
        // ...
    }
}

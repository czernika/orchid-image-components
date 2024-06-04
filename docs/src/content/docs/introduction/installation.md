---
title: Installation
description: Package installation and configuration
sidebar:
    order: 1
---

## Requirements

| Version | PHP          | Laravel | Orchid   |
|---------|--------------|---------|----------|
| 2.x     | 8.1/8.2/8.3  | 10.x    | 14.x     |
| 2.x     | 8.2/8.3      | 11.x    | ^14.21   |

## Installation

Install the package with Composer

```sh
composer require czernika/orchid-image-components
```

### Publish assets

```sh
php artisan vendor:publish --provider="Czernika\OrchidImages\OrchidImagesServiceProvider"
```

This will copy the compiled JavaScript and CSS file into the `public/vendor/orchid-images` directory. You need to register them in Orchid's `platform.php` configuration file.

```php
'resource' => [
    'stylesheets' => [
        '/vendor/orchid-images/css/image.css',

        // If you're using the lightbox component
        '/vendor/orchid-images/css/lightbox.css',
    ],

    'scripts'     => [
        // If you're using the lightbox component
        '/vendor/orchid-images/js/lightbox.js',

        // If you need a carousel 
        '/vendor/orchid-images/js/carousel.js',
    ],
],
```

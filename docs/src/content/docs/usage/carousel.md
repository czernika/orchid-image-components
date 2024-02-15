---
title: Carousel Component
description: Documentation for the Carousel component
sidebar:
    order: 5
---

## Usage

The Carousel component is based on [the Bootstrap carousel](https://getbootstrap.com/docs/5.0/components/carousel/) and looks alike. 

Identical to [Gallery](/usage/gallery#usage) you need to register relations or pass elements manually via the `elements()` method.

```php
use Czernika\OrchidImages\Screen\Components\Carousel;

Carousel::make('post.gallery'),
```

:::caution
You need to register `carousel.js` file in order to work.

```php
// config/platform.php

'resource' => [
    'stylesheets' => [
        '/vendor/orchid-images/css/image.css',
    ],

    'scripts' => [
        '/vendor/orchid-images/js/carousel.js', // here
    ],
],
```
:::

## Options

The options differ from Gallery; it does not accept layout parameters such as `columns` - there is only one slide per view but it accepts some options from the Bootstrap Carousel API.

### Control elements

You may use control buttons (prev-next slide) or indicators (bullets) with next methods.

```php
Carousel::make('post.gallery')
    ->withControls()
    ->withIndicators(),
```

### Fit property

See [fit property for Gallery](/usage/gallery#fit-property).

### Empty value

See [empty value for Gallery](/usage/gallery#empty-value).

### Elements

See [element for Gallery](/usage/gallery#elements).

### Size

You can specify the height of the gallery. By default, it stretches as much as the highest image in the carousel.

```php
Carousel::make('post.gallery')
    ->height(400), // carousel and every slide within will have 400px height
```

Accepts any valid CSS units as a `string` parameter.

```php
Carousel::make('post.gallery')
    ->height('50vh'),
```

### Combine with Lightbox

By default, you cannot zoom image in a carousel. But if you wish, you may combine it with lightbox.

```php
Carousel::make('post.gallery')
    ->withLightbox(),
```

This will allow you to convert simple Carousel into a Carousel with Lightbox, where every image can be opened in gallery mode.

### Interval

Specify the interval between slide changes in milliseconds.

```php
Carousel::make('post.gallery')
    ->delay(10000) // 10 seconds
```

**Default** is 5000ms (5 seconds).

### Layout max width

:::caution
In development
:::

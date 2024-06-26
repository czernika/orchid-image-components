---
title: Lightbox Component
description: Documentation for the Lightbox component
sidebar:
    order: 4
---

The Lightbox component represents interactive gallery and is based on [Gallery](/orchid-image-components/usage/gallery) with identical API.

:::caution
Both JavaScript and CSS files for lightbox needs to be registered within your admin panel.

```php
// config/platform.php

'resource' => [
    'stylesheets' => [
        '/vendor/orchid-images/css/image.css',
        '/vendor/orchid-images/css/lightbox.css', // here
    ],

    'scripts' => [
        '/vendor/orchid-images/js/lightbox.js', // here
    ],
],
```
:::

The front of this component is based on [glightbox](https://github.com/biati-digital/glightbox).

## Usage

Identical to [Gallery](/orchid-image-components/usage/gallery#usage) you need to register relations or pass elements manually via `elements()` method.

```php
use Czernika\OrchidImages\Screen\Components\Lightbox;

Lightbox::make('post.gallery'),
```

## Options

:::note
Most of them are the same as for [Gallery](/orchid-image-components/usage/gallery#options).
:::

### Columns

See [columns for Gallery](/orchid-image-components/usage/gallery#columns).

### Aspect ratio

See [aspect ratio for Gallery](/orchid-image-components/usage/gallery#aspect-ratio).

### Fit property

See [fit property for Gallery](/orchid-image-components/usage/gallery#fit-property).

### Empty value

See [empty value for Gallery](/orchid-image-components/usage/gallery#empty-value).

### Elements

See [element for Gallery](/orchid-image-components/usage/gallery#elements).

### Glightbox options

There are 2 extra options, that are related to the glightbox dependency; `zoomable()` to enable or disable zoom for images, and `draggable` to allow drag or not. Both accept `boolean` as a value and default is `false`.

```php
Lightbox::make('post.gallery')
    ->zoomable()
    ->draggable(false), // disable drag
```

### Layout max width

See [max width for Gallery](/orchid-image-components/usage/gallery#layout-max-width).

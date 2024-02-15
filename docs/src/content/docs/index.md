---
title: Introduction
description: Package that adds new image-based components to your Orchid app
---

[Orchid](https://orchid.software/) is a package that provides several new image-related components, including simple images, galleries, and carousels.

:::danger
Version 1.x is no longer maintained, and this documentation does not cover its options.
:::

Orchid does an excellent job at adding or updating images and their relationships; there are fields such as Cropper, Picture, Upload and regular Input with `file`. However, in many cases, we only need to **show** the image within the Orchid admin panel (for example, if you want to show a post thumbnail or a product gallery). Yes, we can return plain HTML, `view()` with the blade template, or the view component, but wouldn't it be nicer to use the ready component?

Here is an [example from Orchid](https://github.com/orchidsoftware/platform/blob/master/stubs/app/Orchid/Screens/Examples/ExampleScreen.php)

```php
TD::make()
    ->render(fn (Repository $model) =>
    "<img src='https://loremflickr.com/500/300?random={$model->get('id')}'
                alt='sample'
                class='mw-100 d-block img-fluid rounded-1 w-100'>"),
```

Using this package, this code will be replaced with

```php
TD::make()
    ->render(fn (Attachment $attachment) =>
        Image::make()->src($attachment->url())
    )
```

Or even using relations

```php
Image::make('post.thumb'), // Show post thumb

Gallery::make('post.attachment'), // Show every post attachment
```

You can find more in the [Usage](/usage) section of this documentation.

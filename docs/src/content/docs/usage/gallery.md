---
title: Gallery Component
description: Documentation for the Gallery component
sidebar:
    order: 3
---

The Gallery component represents a grid of non-interactive images - you cannot click on them in order to zoom (that is where [Lightbox](/usage/lightbox) used).

![Four images in a row in a six columns grid](../../../assets/gallery-default.webp)

## Usage

### From the Model

Can be defined in a same way as every Orchid field assuming you have a relation specified.

```php
// app/Models/Post.php

class Post extends Model
{
    use Attachable;

    public function thumb(): HasOne
    {
        return $this->hasOne(Attachment::class, 'id', 'thumb_id');
    }

    public function gallery(): MorphToMany
    {
        return $this->attachment(
            'post_gallery_group' // attachment group
        );
    }
}
```

```php
use Czernika\OrchidImages\Screen\Components\Gallery;

Gallery::make('post.gallery'),
```

It can be created even with a singular instance (despite it has no sense - use [Image](/usage/image) instead).

```php
Gallery::make('post.thumb'),
```

### From an array of links

You can pass gallery items manually; more details [in elements section](#elements)

## Options

### Columns

Set the number of columns to show.

```php
Gallery::make()
    ->columns(4),
```

**Default** is 6 columns. The number of columns will not be changed on the mobile layout. If you wish to change such behavior, use `autoFit()` method instead. This one is based on the CSS Grid `auto-fit` value for `grid-template-columns` property.

```php
Gallery::make()
    ->autoFit(200), // 200px
```

This will be the equivalent for `grid-template-columns: repeat(auto-fit, minmax(200px, 1fr))`

![Four images in a row](../../../assets/gallery-default.webp)

It looks exactly the same if you set 4 columns, but if there is no room for 4th image to be displayed (remember it has to be at least 200px wide) it will jump to another row. If there are less than two images, `auto-fit` will be converted into `auto-fill` in order to prevent image to stretch.

### Fit property

Applied for every image in the gallery. See [fit for Image](/usage/image#fit-property).

### Empty value

If there is no gallery, you can specify the value to show instead.

```php
Gallery::make()
    ->empty('No gallery'),
```

This method may accept plain HTML.

```php
Gallery::make()
    ->empty('<b>No gallery</b>'),
```

### Elements

You can pass an array of links manually in a various ways.

- as a single model

```php
Gallery::make()
    ->elements($attachment),
```

- as an array or collection of models
    
```php
Gallery::make()
    ->elements([$attachment1, $attachment2, ...]),
```

- from relation

```php
Gallery::make()
    ->elements($post->gallery),
```

- from the query result

```php
Gallery::make()
    ->elements(Attachment::where(...)->get()),
```

- passing an array of links

```php
Gallery::make()
    ->elements(['https://some.external/img.jpg', asset('/img/local-img.jpg')]),
```

This way, `alt` and `title` attributes will be left empty. If you need to use it collect data as associative array, containing `url`, `alt` and `title` keywords.

:::caution
Only **url** keyword is required.
::: 

```php
Gallery::make()
    ->elements([
        ['url' => 'https://some.path.to/img.jpg', 'alt' => 'Some alt', 'title' => 'Some title'],
        ['url' => asset('/img/local-img.jpg'), 'alt' => 'Some alt 2', 'title' => 'Some title 2'],
        ...
    ]),
```

### Layout max width

:::caution
In development
:::

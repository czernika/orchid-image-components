# Orchid Image Components

Adds new image components to preview uploaded (or not) images for Laravel [Orchid](https://orchid.software/) admin panel. Mostly used for "show" screens

## Installation

...

### Register published assets

...

## Components

### Image

Image represents simple singular, well, image which has no interaction with. To register use it like in your layout

```php
use Czernika\OrchidImages\Screen\Components\Image;

Image::make('image')
    ->src('https://example.com/img/image.jpg')
    ->alt('Alt text')
    ->objectFit('cover') // `object-fit: cover`
    ->height(400), // px
```

`src()` is not required - it resolved based on name value (passed into `make()` method). But it can be overwritten

```php
Image::make('post.thumb_id'),
```

It will find `$post->thumb_id` value and if Attachment with this id exists it will retrieve its url and pass into src attribute. If you store image url in database as it is, just pass column value, e.g.

```php
Image::make('post.thumb_url'),
```

`height()` accepts numeric value in pixels or any valid CSS value. Default is `30rem`

```php
Image::make('image')
    ->src($src)
    ->height('24rem'),
```

`objectFit()` accepts one of five values according to Bootstap - `cover`, `contain`, `fill`, `scale` or `none`. Default is `cover`.

### Gallery

...

### Lightbox

...

### Carousel

...

## Contributing

...

## License

Open-source under [MIT license](LICENSE)

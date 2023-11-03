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

# Orchid Image Components

Adds new image components to preview uploaded (or not) images for Laravel [Orchid](https://orchid.software/) admin panel. Mostly used for "show" screens

## Installation

...

### Register published assets

...

## Components

### Image

Image represents simple singular, well, image component which has no any interaction with user - it just shows the image

For example, you have avatar field for User model. It may be stored as string (URL) like `avatar_url` or One-to-One relation to Attachment model (`avatar_id`). Let say we store it as ID. Your Edit-Layout should look like

```php
Cropper::make('user.avatar_id'),
```

And in a Show-Layout just pass

```php
use Czernika\OrchidImages\Screen\Components\Image;

Image::make('user.avatar_id'),
```

This basically resolved as `$user->avatar_id`, and if Attachment with this ID exists, component will resolve its url. If you're storing avatar as url - same method is valid

```php
Image::make('user.avatar_url'),
```

If you need to pass custom URL use `src()` method (pass anything you want into `make()` method)

```php
Image::make('image')
    ->src('/images/my-cool-image.jpg'),
```

You may change alt attribute by using `alt()` method

```php
Image::make('image')
    ->alt('Alt text'),
```

By default image has `30rem` height. If you need to change it pass either integer value in pixels or any valid CSS value as a string, for example

```php
Image::make('image')
    ->height(400), // 400px

// or
Image::make('image')
    ->height('5vh'), // 5vh
```

This component also accepts CSS object fit property but in Bootstrap way - there are 5 available values according to [Bootstrap](https://getbootstrap.com/docs/5.3/utilities/object-fit/#how-it-works) - `cover`, `contain`, `fill`, `scale` and `none`

```php
use Czernika\OrchidImages\Enums\ImageObjectFit;

Image::make('image')
    ->objectFit('contain')

// or same result using ImageObjectFit enum helper
Image::make('image')
    ->objectFit(ImageObjectFit::CONTAIN)
```

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

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

#### Placeholder (default image)

Some relations are optional meaning user can upload avatar or not. If you wish to show placeholder for an image that has not been uploaded use `placeholder()` method

```php
Image::make('user.avatar_id')
    ->placeholder('/img/placeholder.webp'),
```

Placeholder will be shown when file does not exists physically if passed (unless you overwrite `url()` method for Attachment)

#### Alt attribute

You may change alt attribute by using `alt()` method

```php
Image::make('image')
    ->alt('Alt text'),
```

If relation was set as image source alt value could be resolved from Attachment model

#### Width and height

By default image has `100%` width. If you need to change it pass either integer value in pixels or any valid CSS value as a string, for example

```php
Image::make('image')
    ->width(400), // 400px

// or
Image::make('image')
    ->width('15vw'), // 15vw
```

Same applied for height but default value is `auto`

```php
Image::make('image')
    ->height(400), // 400px

// or
Image::make('image')
    ->height('5vh'), // 5vh
```

#### Object fit

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

Gallery is basically set of non-interactive images. You need to pass a collection of attachments as source for it

```php
// Screen
public function query(Post $post)
{
    return ['gallery' => $post->attachment];
}

// Layout
use Czernika\OrchidImages\Screen\Components\Image;

Gallery::make('gallery'),
```

#### Columns

To set amount of columns just pass a number

```php
Gallery::make('gallery')
    ->columns(4),
```

Now you gallery will have 4 columns. However this 4 columns will be kept no matter space gallery has. Therefore if you need images to be wrapped use `autoFit()` method instead. It accepts number in pixels (or string as valid CSS value) and ignores amount of columns. Let say we set it to 200px. On layouts with 700px width you will see 3 columns, on 500px - 2, etc. However it will leave empty space to the right

```php
Gallery::make('gallery')
    ->autoFit(200), // 1 column will be 200px wide
```

#### Empty value

If there is no gallery you can define empty value - just pass a string

```php
Gallery::make('gallery')
    ->empty(__('No gallery'))
```

> We are not using image placeholder for gallery - as it is has no sense when it coles to relations and if file is broken it is better to see it is actually broken in a gallery

### Lightbox

...

### Carousel

...

## Contributing

...

## License

Open-source under [MIT license](LICENSE)

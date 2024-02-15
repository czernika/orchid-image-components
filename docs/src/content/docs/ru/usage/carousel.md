---
title: Компонент Carousel
description: Документация для компонента Carousel
sidebar:
    order: 5
---

## Использование

Компонент Carousel основан на [Bootstrap компоненте](https://getbootstrap.com/docs/5.0/components/carousel/) и выглядит так же. 

Идентично [Gallery](/orchid-image-components/usage/gallery#usage), нужно определить отношения или передать картинки в метод `elements()`.

```php
use Czernika\OrchidImages\Screen\Components\Carousel;

Carousel::make('post.gallery'),
```

:::caution
Нужно зарегистрировать файл `carousel.js` для корректной работы.

```php
// config/platform.php

'resource' => [
    'stylesheets' => [
        '/vendor/orchid-images/css/image.css',
    ],

    'scripts' => [
        '/vendor/orchid-images/js/carousel.js', // здесь
    ],
],
```
:::

## Опции

Опции отличаются от галереи - слайдер не принимает такие методы, как  `columns` - показывается только один слайд, однако дополнительно используется пара методов, связанных с Bootstrap Carousel API.

### Элементы управления

Вы можете использовать кнопки управления (пред-след слайд) или индикаторы (буллеты) со следующими методами:

```php
Carousel::make('post.gallery')
    ->withControls()
    ->withIndicators(),
```

### Вписываемость

Смотри [fit property для Gallery](/orchid-image-components/usage/gallery#fit-property).

### Пустое значение

Смотри [empty value для Gallery](/orchid-image-components/usage/gallery#empty-value).

### Элементы

Смотри [element для Gallery](/orchid-image-components/usage/gallery#elements).

### Размер

Можно указать размер галереи. По-умолчанию, она имеет высоту картинки внутри.

```php
Carousel::make('post.gallery')
    ->height(400), // теперь карусель и все слайды внутри имеют высоту 400px
```

Методы принимает любые валидные значения CSS в качестве параметра.

```php
Carousel::make('post.gallery')
    ->height('50vh'),
```

### Анимация

Если нужно применить анимацию появления, используйте метод `fade()`

```php
Carousel::make('post.gallery')
    ->fade(),
```

### Использование вместе с Lightbox

По-умолчанию, вы не можете увеличить изображения внутри карусели. Если такое поведение требуется, вы можете скомбинировать ее с лайтбоксом.

```php
Carousel::make('post.gallery')
    ->withLightbox(),
```

This will allow you to convert simple Carousel into a Carousel with Lightbox, where every image can be opened in gallery mode.

### Интервал анимации

Укажите интервал между сменами слайдов в миллисекундах.

```php
Carousel::make('post.gallery')
    ->delay(10000) // 10 секунд
```

**По-умолчанию** 5000мс (5 секунд).

### Максимальная ширина карусели

:::caution
In development
:::

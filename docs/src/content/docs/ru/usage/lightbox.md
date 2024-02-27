---
title: Компонент Lightbox
description: Документация для компонента Lightbox
sidebar:
    order: 4
---

Lightbox представляет из себя интерактивный компонент [Gallery](/orchid-image-components/usage/gallery) с идентичным API.

:::caution
Для корректной работы нужно зарегистрировать JavaScript и CSS файлы для лайтбокса.

```php
// config/platform.php

'resource' => [
    'stylesheets' => [
        '/vendor/orchid-images/css/image.css',
        '/vendor/orchid-images/css/lightbox.css', // здесь
    ],

    'scripts' => [
        '/vendor/orchid-images/js/lightbox.js', // здесь
    ],
],
```
:::

Фронт компонента основан на зависимости [glightbox](https://github.com/biati-digital/glightbox).

## Использование

Идентично компоненту [Gallery](/orchid-image-components/usage/gallery#usage) можно передать картинки через ключ или передать в метод `elements()`.

```php
use Czernika\OrchidImages\Screen\Components\Lightbox;

Lightbox::make('post.gallery'),
```

## Опции

:::note
Большинство опций такие же, как и для [Gallery](/orchid-image-components/usage/gallery#options).
:::

### Колонки

Смотрите [columns для Gallery](/orchid-image-components/usage/gallery#columns).

### Вписываемость

Смотрите [fit property для Gallery](/orchid-image-components/usage/gallery#fit-property).

### Пустое значение

Смотрите [empty value для Gallery](/orchid-image-components/usage/gallery#empty-value).

### Элементы

Смотрите [element для Gallery](/orchid-image-components/usage/gallery#elements).

### Опции Glightbox

Пакет представляет 2 опции, которые относятся к зависимости glightbox - `zoomable()`, чтобы включить/отключить зум для крупных изображений, и `draggable`, чтобы позволить их тянуть. Оба метода принимают `boolean` как значение, и по-умолчанию оба стоят на `false`.

```php
Lightbox::make('post.gallery')
    ->zoomable()
    ->draggable(false), // отключить drag
```

### Максимальная ширина галереи

Смотрите [max width для Gallery](/orchid-image-components/usage/gallery#layout-max-width).

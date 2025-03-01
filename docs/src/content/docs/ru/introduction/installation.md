---
title: Установка
description: Установка зависимости и её настройка
sidebar:
    order: 1
---

## Минимальные требования

| Версия | PHP             | Laravel   | Orchid |
| ------ | --------------- | --------- | ------ |
| 2.x    | 8.1/8.2/8.3/8.4 | 10.x      | 14.x   |
| 2.x    | 8.2/8.3/8.4     | 11.x/12.x | ^14.21 |

## Установка

Установите зависимость при помощи пакетного менеджера Composer.

```sh
composer require czernika/orchid-image-components
```

### CSS и JS файлы

Запустите в терминале

```sh
php artisan vendor:publish --provider="Czernika\OrchidImages\OrchidImagesServiceProvider"
```

Данная команда скопирует скомпилированные JavaScript и CSS файлы, необходимые для корректного отображения компонентов, в папку `public/vendor/orchid-images`. Вам необходимо будет зарегистрировать их в файле конфигурации `platform.php`.

```php
'resource' => [
    'stylesheets' => [
        '/vendor/orchid-images/css/image.css',

        // Если вы используете Lightbox
        '/vendor/orchid-images/css/lightbox.css',
    ],

    'scripts'     => [
        // Если вы используете Lightbox
        '/vendor/orchid-images/js/lightbox.js',

        // Если вы используете Carousel
        '/vendor/orchid-images/js/carousel.js',
    ],
],
```

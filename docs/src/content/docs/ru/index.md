---
title: Введение
description: Зависимость, которая добавляет новые компоненты для отображения картинок в Ваше приложение Orchid
---

Orchid Images это зависимость для [Orchid](https://orchid.software/), которая добавляет новые компоненты для отображения картинок, такие как простое изображение, аватар, галереи и карусель.

:::danger
Версия 1.x более не поддерживается и эта документация не покрывает опции компонентов для устаревшей версии.
:::

Orchid проделывает великолепную работу при работе с изображениями - здесь есть такие компоненты, как Cropper, Picture, Upload и обычный Input с типом `file`. Однако во многих случаях нам нужно только **отобразить** изображение внутри админ-панели (например, если вы хотите показать превью поста или галерею продукта в админке). Да, можно вернуть сырой HTML, `view()` с шаблоном blade или использовать компонент Laravel, но не лучше ли использовать компонент, уже адаптированный под использование с Orchid?

Вот [пример Orchid](https://github.com/orchidsoftware/platform/blob/master/stubs/app/Orchid/Screens/Examples/ExampleScreen.php) того, как можно отобразить изображение в таблице:

```php
TD::make()
    ->render(fn (Repository $model) =>
    "<img src='https://loremflickr.com/500/300?random={$model->get('id')}'
                alt='sample'
                class='mw-100 d-block img-fluid rounded-1 w-100'>"),
```

Используя данный пакет, запись выше может быть заменена на

```php
TD::make()
    ->render(fn (Attachment $attachment) =>
        Image::make()->src($attachment->url())
    )
```

Или даже используя отношения

```php
Image::make('post.thumb'), // показать превью поста

Gallery::make('post.attachment'), // показать все картинки, которые прикреплены к посту
```

Больше примеров в секции [Использование](/orchid-image-components/usage) данной документации.
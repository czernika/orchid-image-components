---
title: Компонент Avatar
description: Документация для компонента Avatar
sidebar:
    order: 2
---

## Использование

Avatar очень похож на [Image](/orchid-image-components/usage/image). Он представляет из себя круглое изображение и полностью игнорирует метод `fit()` - остальные же методы остаются валидными.

```php
use Czernika\OrchidImages\Screen\Components\Avatar;

Avatar::make('user.avatar')
    ->size(200)
    ->placeholder(asset('/img/no-avatar.jpg')),
```

**Дефолтный** размер аватара 3rem.

## Опции

:::note
Большинство опций такие же, как и для [Image](/orchid-image-components/orchid-image-components/usage/image#options).
:::

### Alt

Смотрите [alt для Image](/orchid-image-components/usage/image#alt).

### Размер

Смотрите [size для Image](/orchid-image-components/usage/image#sizes).

### Плейсхолдер

Смотрите [placeholder для Image](/orchid-image-components/usage/image#placeholder).

### Источник

Смотрите [src для Image](/orchid-image-components/usage/image#src).

### Значок

Avatar может отображать значок - маленькая иконка в верхнем углу. Он меняет свои размеры вместе с размерами аватара.

![Three images with different sizes, one after another](../../../assets/avatar-sizes.webp)

Чтобы передать значение, используйте метод `badge()`.

```php
Avatar::make('user.avatar')
    ->badge(15),
```

Также можно передать функцию, однако использование такого метода спорно.

```php
Avatar::make('user.avatar')
    ->badge(fn () => 15),

Avatar::make('user.avatar')
    ->badge(fn ($repository) => 15),
```

В качестве параметра функция принимает или модель Attachment, или строковое значение, или вовсе `null` в зависимости от того, что вы передали (или нет) в компонент.

Если нужно скрыть значок для некоторых значений (например, 0), передайте `false` в качестве значения.

```php
Avatar::make('user.avatar')
    ->badge(fn () => $user->hasNotifications() ? $user->notifications_count : false),
```

### Цвет значка

Можно сменить цвет значка согласно цветовой схеме Orchid, используя помощник `Orchid\Support\Color` - просто передайте его в метод `badgeType()`.

```php
Avatar::make('user.avatar')
    ->badge(3)
    ->badgeType(Color::DANGER),
```

![Avatars with different badge background colors](../../../assets/avatar-types.webp)

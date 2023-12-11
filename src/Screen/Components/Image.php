<?php

declare(strict_types=1);

namespace Czernika\OrchidImages\Screen\Components;

use Czernika\OrchidImages\Support\Traits\ObjectFitable;

/**
 * @method self src(string $src)
 * @method self alt(string $alt)
 * @method self height(string|int $height)
 * @method self width(string|int $width)
 * @method self placeholder(string $placeholder)
 * @method self objectFit(string|\Czernika\OrchidImages\Enums\ImageObjectFit $fit)
 */
class Image extends Avatar
{
    use ObjectFitable;

    protected $view = 'orchid-images::components.image';

    protected $attributes = [
        'fit' => 'object-fit-cover', // 'cover', 'contain', 'fill', 'scale', 'none'
        'height' => 'auto',
        'width' => '100%',
        'src' => null,
        'alt' => '',
        'placeholder' => null,
    ];

    public function height(string|int $height): static
    {
        $this->set('height', is_int($height) ? "{$height}px" : $height);

        return $this;
    }

    public function width(string|int $width): static
    {
        $this->set('width', is_int($width) ? "{$width}px" : $width);

        return $this;
    }
}

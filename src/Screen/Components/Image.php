<?php

declare(strict_types=1);

namespace Czernika\OrchidImages\Screen\Components;

use Czernika\OrchidImages\Enums\ImageObjectFit;

/**
 * Class Field.
 *
 * @method self src(string $src)
 * @method self alt(string $alt)
 */
class Image extends Avatar
{
    protected $view = 'orchid-images::components.image';

    protected $attributes = [
        'fit' => 'object-fit-cover', // 'cover', 'contain', 'fill', 'scale', 'none'
        'height' => 'auto',
        'width' => '100%',
        'src' => null,
        'alt' => '',
        'placeholder' => null,
    ];

    public function objectFit(string|ImageObjectFit $fit)
    {
        if (is_a($fit, ImageObjectFit::class)) {
            $fit = $fit->value;
        }

        $this->set('fit', sprintf('object-fit-%s', $fit));

        return $this;
    }

    public function height(string|int $height)
    {
        $this->set('height', is_int($height) ? "{$height}px" : $height);

        return $this;
    }

    public function width(string|int $width)
    {
        $this->set('width', is_int($width) ? "{$width}px" : $width);

        return $this;
    }
}

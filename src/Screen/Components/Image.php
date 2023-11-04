<?php

declare(strict_types=1);

namespace Czernika\OrchidImages\Screen\Components;

use Czernika\OrchidImages\Enums\ImageObjectFit;
use Orchid\Attachment\Models\Attachment;
use Orchid\Platform\Dashboard;
use Orchid\Screen\Field;

/**
 * Class Field.
 *
 * @method self src(string $src)
 * @method self alt(string $alt)
 */
class Image extends Field
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

    public function __construct()
    {
        $this->addBeforeRender(function () {
            $value = $this->get('value');

            if (is_numeric($value)) {
                $value = Dashboard::model(Attachment::class)::find($value);
            }

            if (is_null($this->get('src'))) {
                $placeholder = $this->get('placeholder');

                $this->set('src', $this->valueIsAttachment($value) ?
                    $value->url($placeholder) :
                    (is_null($value) ? $placeholder : $value));
            }

            if ('' === $this->get('alt')) {
                $this->set('alt', $this->valueIsAttachment($value) ? $value->alt : '');
            }
        });
    }

    protected function valueIsAttachment($value)
    {
        return is_a($value, Dashboard::model(Attachment::class));
    }

    public function src(string $src)
    {
        $this->set('src', $src);

        return $this;
    }

    public function placeholder(string $placeholder)
    {
        $this->set('placeholder', $placeholder);

        return $this;
    }

    public function alt(string $alt)
    {
        $this->set('alt', $alt);

        return $this;
    }

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

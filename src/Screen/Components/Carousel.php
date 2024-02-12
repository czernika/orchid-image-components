<?php

declare(strict_types=1);

namespace Czernika\OrchidImages\Screen\Components;

use Czernika\OrchidImages\Support\Helper;
use Czernika\OrchidImages\Support\Traits\ObjectFitable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Platform\Dashboard;
use Orchid\Screen\Field;

class Carousel extends Field
{
    use ObjectFitable;

    protected $view = 'orchid-images::components.carousel';

    protected $attributes = [
        'elements' => [],
        'controls' => false,
        'indicators' => false,
        'fade' => false,
        'height' => 'auto',
        'width' => '100%',
        'empty' => '',
        'fit' => 'object-fit-cover', // 'cover', 'contain', 'fill', 'scale', 'none'
    ];

    public function __construct()
    {
        $this->addBeforeRender(function () {
            if (!empty($this->get('elements'))) {
                return;
            }

            $value = $this->get('value');

            $this->elements($value);
        });
    }

    public function elements($elements)
    {
        if (is_numeric($elements)) {
            $elements = Dashboard::model(Attachment::class)::find($elements);
        }

        $this->set('elements', Helper::isAttachment($elements) ? [$elements] : collect($elements));

        return $this;
    }

    public function withControls(bool $controls = true): static
    {
        $this->set('controls', $controls);

        return $this;
    }

    public function withIndicators(bool $indicators = true): static
    {
        $this->set('indicators', $indicators);

        return $this;
    }

    public function fade(bool $fade = true): static
    {
        $this->set('fade', $fade);

        return $this;
    }

    public function height($height): static
    {
        $this->set('height', is_int($height) ? "{$height}px" : $height);

        return $this;
    }

    public function width($width): static
    {
        $this->set('width', is_int($width) ? "{$width}px" : $width);

        return $this;
    }

    public function empty(string $empty): static
    {
        $this->set('empty', $empty);

        return $this;
    }
}

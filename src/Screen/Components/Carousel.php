<?php

declare(strict_types=1);

namespace Czernika\OrchidImages\Screen\Components;

use Czernika\OrchidImages\Screen\Components\Traits\CanBeEmpty;
use Czernika\OrchidImages\Screen\Components\Traits\HasElements;
use Czernika\OrchidImages\Screen\Components\Traits\HasSizes;
use Czernika\OrchidImages\Screen\Components\Traits\ObjectFitable;
use Orchid\Screen\Field;

/**
 * @method self elements($elements)
 * @method self empty(string $value)
 * @method self withControls(bool $value = true)
 * @method self withIndicator(bool $value = true)
 * @method self withLightbox(bool $value = true)
 * @method self fade(bool $value = true)
 * @method self objectFit(string|\Czernika\OrchidImages\Enums\ObjectFit $fit)
 * @method self height(string|int $height)
 * @method self delay(int $delay)
 */
class Carousel extends Field
{
    use HasElements, ObjectFitable, CanBeEmpty, HasSizes;

    protected $view = 'orchid-images::components.carousel';

    protected $attributes = [
        'elements' => [],
        'empty' => '',
        'placeholder' => '',
        'controls' => false,
        'indicators' => false,
        'lightbox' => false,
        'fade' => false,
        'height' => false,
        'delay' => 5000,
        'fit' => 'object-fit-cover', // 'cover', 'contain', 'fill', 'scale', 'none'
    ];

    public function __construct()
    {
        $this->addBeforeRender(function () {
            $this->setElements();
        });
    }

    /**
     * Set carousel control buttons
     *
     * @param boolean $controls
     * @return static
     */
    public function withControls(bool $controls = true): static
    {
        return $this->set('controls', $controls);
    }

    /**
     * Set carousel bullets
     *
     * @param boolean $indicators
     * @return static
     */
    public function withIndicators(bool $indicators = true): static
    {
        return $this->set('indicators', $indicators);
    }

    /**
     * Allow to use lightbox in carousel
     *
     * @param boolean $lightbox
     * @return static
     */
    public function withLightbox(bool $lightbox = true): static
    {
        return $this->set('lightbox', $lightbox);
    }

    /**
     * Set fade animation
     *
     * @param boolean $fade
     * @return static
     */
    public function fade(bool $fade = true): static
    {
        return $this->set('fade', $fade);
    }

    /**
     * Set delay between slides animation
     *
     * @param integer $delay
     * @return static
     */
    public function delay(int $delay): static
    {
        return $this->set('delay', $delay);
    }

    /**
     * Set carousel height
     *
     * @param string|integer $height
     * @return static
     */
    public function height(string|int $height): static
    {
        return $this->setSize('height', $height);
    }
}

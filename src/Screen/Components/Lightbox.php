<?php

declare(strict_types=1);

namespace Czernika\OrchidImages\Screen\Components;

class Lightbox extends Gallery
{
    protected $view = 'orchid-images::components.lightbox';

    protected $attributes = [
        'elements' => [],
        'empty' => '',
        'templateColumns' => 'repeat(6, 1fr)',
        'aspectRatio' => '4 / 3',
        'fit' => 'object-fit-cover', // 'cover', 'contain', 'fill', 'scale', 'none'

        // @see https://github.com/biati-digital/glightbox
        'data-type' => 'image',
        'data-effect' => 'fade',
        'data-height' => '100%',
        'data-zoomable' => 'true',
        'data-draggable' => 'true',
    ];

    /**
     * Set zoomable image
     *
     * @param boolean $zoom
     * @return static
     */
    public function zoomable(bool $zoom = true): static
    {
        return $this->set('data-zoomable', (string) $zoom);
    }

    /**
     * Set draggable image
     *
     * @param boolean $drag
     * @return static
     */
    public function draggable(bool $drag = true): static
    {
        return $this->set('data-draggable', (string) $drag);
    }
}

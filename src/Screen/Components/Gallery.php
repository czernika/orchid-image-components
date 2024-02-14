<?php

declare(strict_types=1);

namespace Czernika\OrchidImages\Screen\Components;

use Czernika\OrchidImages\Screen\Components\Traits\CanBeEmpty;
use Czernika\OrchidImages\Screen\Components\Traits\HasElements;
use Czernika\OrchidImages\Screen\Components\Traits\ObjectFitable;
use Orchid\Screen\Field;

/**
 * @method self autoFit(string|int $fit)
 * @method self objectFit(string|\Czernika\OrchidImages\Enums\ObjectFit $fit)
 * @method self empty(string $empty)
 * @method self aspectRatio(string $ratio)
 * @method self elements($elements)
 */
class Gallery extends Field
{
    use HasElements, ObjectFitable, CanBeEmpty;

    protected $view = 'orchid-images::components.gallery';

    protected $attributes = [
        'elements' => [],
        'empty' => '',
        'templateColumns' => 'repeat(6, 1fr)',
        'aspectRatio' => '4 / 3',
        'fit' => 'object-fit-cover', // 'cover', 'contain', 'fill', 'scale', 'none'
    ];

    public function __construct()
    {
        $this->addBeforeRender(function () {
            $this->setElements();
        });

        // Set grid columns layout
        $this->addBeforeRender(function () {
            $autoFit = $this->get('autoFit', false);
            $this->set('templateColumns', false !== $autoFit ?
                sprintf('repeat(%s, minmax(%s, 1fr))', count($this->get('elements')) > 1 ? 'auto-fit' : 'auto-fill', $autoFit) :
                sprintf('repeat(%s, 1fr)', $this->get('columns', 6))
            );
        });
    }

    /**
     * CSS Grid template column property - should be gallery fitted or not
     *
     * @param string|integer $fit
     * @return static
     */
    public function autoFit(string|int $fit): static
    {
        return $this->set('autoFit', is_numeric($fit) ? "{$fit}px" : $fit);
    }

    /**
     * Set number of columns in one row
     *
     * @param integer $columns
     * @return static
     */
    public function columns(int $columns): static
    {
        return $this->set('columns', $columns);
    }

    /**
     * Set aspect-ration CSS property on gallery image
     *
     * @param string $ratio
     * @return static
     */
    public function aspectRatio(string $ratio): static
    {
        return $this->set('aspectRatio', $ratio);
    }
}

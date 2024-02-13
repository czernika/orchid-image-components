<?php

declare(strict_types=1);

namespace Czernika\OrchidImages\Screen\Components;

use Czernika\OrchidImages\Support\Helper;
use Czernika\OrchidImages\Support\Traits\ObjectFitable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Platform\Dashboard;
use Orchid\Screen\Field;

/**
 * @method self columns(int $columns)
 * @method self autoFit(string|int $fit)
 * @method self objectFit(string|\Czernika\OrchidImages\Enums\ObjectFit $fit)
 * @method self empty(string $empty)
 * @method self elements($elements)
 * @method self height(int|string $height)
 */
class Gallery extends Field
{
    use ObjectFitable;

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
            if (!empty($this->get('elements'))) {
                return;
            }

            // Set grid columns layout
            $autoFit = $this->get('autoFit', false);
            $this->set('templateColumns', false !== $autoFit ?
                sprintf('repeat(auto-fit, minmax(%s, 1fr))', $autoFit) :
                sprintf('repeat(%s, 1fr)', $this->get('columns', 6))
            );

            $this->elements($this->get('value'));
        });
    }

    /**
     * Set gallery elements to display
     *
     * @param mixed $elements
     * @return static
     */
    public function elements($elements): static
    {
        if (is_numeric($elements)) {
            $elements = Dashboard::model(Attachment::class)::find($elements);
        }

        return $this->set('elements',
            Helper::isAttachment($elements) ? [$elements] : collect($elements));
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

    /**
     * Value to display when there are no images
     * Accepts raw HTML
     *
     * @param string $empty
     * @return static
     */
    public function empty(string $empty): static
    {
        return $this->set('empty', $empty);
    }
}

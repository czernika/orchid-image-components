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
 * @method self objectFit(string|\Czernika\OrchidImages\Enums\ImageObjectFit $fit)
 * @method self empty(string $empty)
 */
class Gallery extends Field
{
    use ObjectFitable;

    protected $view = 'orchid-images::components.gallery';

    protected $attributes = [
        'elements' => [],
        'empty' => '',
        'columns' => 6,
        'autoFit' => false,
        'fit' => 'object-fit-cover', // 'cover', 'contain', 'fill', 'scale', 'none'
    ];

    public function __construct()
    {
        $this->addBeforeRender(function () {
            $value = $this->get('value');

            if (is_numeric($value)) {
                $value = Dashboard::model(Attachment::class)::find($value);
            }

            $this->set('elements', Helper::isAttachment($value) ? [$value] : collect($value));
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
        $this->set('autoFit', is_int($fit) ? sprintf('%spx', $fit) : $fit);

        return $this;
    }

    /**
     * Number of columns
     *
     * @param integer $columns
     * @return static
     */
    public function columns(int $columns): static
    {
        $this->set('columns', $columns);

        return $this;
    }

    /**
     * Text to display when there are no images
     *
     * @param string $empty
     * @return static
     */
    public function empty(string $empty): static
    {
        $this->set('empty', $empty);

        return $this;
    }
}

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

    public function autoFit(string|int $fit): static
    {
        $this->set('autoFit', is_int($fit) ? sprintf('%spx', $fit) : $fit);

        return $this;
    }

    public function columns(int $columns): static
    {
        $this->set('columns', $columns);

        return $this;
    }

    public function empty($empty): static
    {
        $this->set('empty', $empty);

        return $this;
    }
}

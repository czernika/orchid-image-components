<?php

declare(strict_types=1);

namespace Czernika\OrchidImages\Screen\Components;

use Czernika\OrchidImages\Enums\ImageObjectFit;
use Czernika\OrchidImages\Support\Helper;
use Orchid\Attachment\Models\Attachment;
use Orchid\Platform\Dashboard;
use Orchid\Screen\Field;

class Gallery extends Field
{
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

    public function autoFit(string|int $fit)
    {
        $this->set('autoFit', is_int($fit) ? sprintf('%spx', $fit) : $fit);

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

    public function columns(int $columns)
    {
        $this->set('columns', $columns);

        return $this;
    }

    public function empty($empty)
    {
        $this->set('empty', $empty);

        return $this;
    }
}

<?php

declare(strict_types=1);

namespace Czernika\OrchidImages\Screen\Components;

use Orchid\Screen\Field;

class Gallery extends Field
{
    protected $view = 'orchid-images::components.gallery';

    protected $attributes = [
        'elements' => [],
        'empty' => '',
        'columns' => 6,
        'autoFit' => false,
    ];

    public function __construct()
    {
        $this->addBeforeRender(function () {
            $value = $this->get('value');
            $this->set('elements', is_null($value) ? [] : $value);
        });
    }

    public function autoFit(string|int $fit)
    {
        $this->set('autoFit', is_int($fit) ? sprintf('%spx', $fit) : $fit);

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

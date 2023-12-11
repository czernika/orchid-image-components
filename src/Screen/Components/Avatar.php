<?php

declare(strict_types=1);

namespace Czernika\OrchidImages\Screen\Components;

use Czernika\OrchidImages\Support\Helper;
use Orchid\Attachment\Models\Attachment;
use Orchid\Platform\Dashboard;
use Orchid\Screen\Field;

/**
 * Class Field.
 *
 * @method self src(string $src)
 * @method self alt(string $alt)
 * @method self size(string|int $size)
 */
class Avatar extends Field
{
    protected $view = 'orchid-images::components.avatar';

    protected $attributes = [
        'src' => null,
        'alt' => '',
        'size' => '48px',
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

                $this->set('src', Helper::isAttachment($value) ?
                    $value->url($placeholder) :
                    (is_null($value) ? $placeholder : $value));
            }

            if ('' === $this->get('alt')) {
                $this->set('alt', Helper::isAttachment($value) ? $value->alt : '');
            }
        });
    }

    public function src(string $src)
    {
        $this->set('src', $src);

        return $this;
    }

    public function size($size)
    {
        $this->set('size', is_int($size) ? "{$size}px" : $size);

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
}

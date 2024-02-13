<?php

declare(strict_types=1);

namespace Czernika\OrchidImages\Screen\Components;

use Orchid\Support\Color;

/**
 * @method self src(string|Attachment $src)
 * @method self alt(string $alt)
 * @method self size(string|int $size)
 * @method self placeholder(string $placeholder)
 */
class Avatar extends Image
{
    protected $view = 'orchid-images::components.avatar';

    protected $attributes = [
        'height' => '3rem',
        'width' => '3rem',
        'src' => null,
        'alt' => '',
        'placeholder' => null,
        'badge' => false,
        'badgeType' => 'primary',
    ];

    public function __construct()
    {
        parent::__construct();

        $this->addBeforeRender(function () {
            $badge = $this->get('badge');

            if (is_callable($badge)) {
                $this->set('badge', value($badge, $this->get('value')));
            }
        });
    }

    public function badge($badge)
    {
        return $this->set('badge', $badge);
    }

    public function badgeType(Color $type)
    {
        return $this->set('badgeType', $type->name());
    }
}

<?php

declare(strict_types=1);

namespace Czernika\OrchidImages\Screen\Components;

use Orchid\Support\Color;

/**
 * @method self src(string|Attachment $src)
 * @method self alt(string $alt)
 * @method self size(string|int $size)
 * @method self placeholder(string $placeholder)
 * @method self badge($badge)
 * @method self badgeType(\Orchid\Support\Color $type)
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

    /**
     * Set avatar badge value
     *
     * @param mixed $badge
     * @return static
     */
    public function badge($badge): static
    {
        return $this->set('badge', $badge);
    }

    /**
     * Set avatar badge color type
     *
     * @param Color $type
     * @return static
     */
    public function badgeType(Color $type): static
    {
        return $this->set('badgeType', $type->name());
    }
}

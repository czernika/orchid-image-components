<?php

declare(strict_types=1);

namespace Czernika\OrchidImages\Screen\Components;

use Czernika\OrchidImages\Support\Traits\ObjectFitable;
use Czernika\OrchidImages\Support\Helper;
use Orchid\Attachment\Models\Attachment;
use Orchid\Platform\Dashboard;
use Orchid\Screen\Field;

/**
 * @method self src(string|Attachment $src)
 * @method self alt(string $alt)
 * @method self height(string|int $height)
 * @method self width(string|int $width)
 * @method self size(string|int $size)
 * @method self placeholder(string $placeholder)
 * @method self objectFit(string|\Czernika\OrchidImages\Enums\ObjectFit $fit)
 */
class Image extends Field
{
    use ObjectFitable;

    protected $view = 'orchid-images::components.image';

    protected $attributes = [
        'fit' => 'object-fit-cover', // 'cover', 'contain', 'fill', 'scale', 'none'
        'height' => 'auto',
        'width' => '100%',
        'src' => null,
        'alt' => '',
        'placeholder' => null,
    ];

    public function __construct()
    {
        $this->addBeforeRender(function () {
            $value = $this->get('value');

            if (is_numeric($value)) {
                $value = Dashboard::model(Attachment::class)::find($value);
            }

            $valueIsAttachmentModel = Helper::isAttachment($value);

            if (is_null($this->get('src'))) {
                $placeholder = $this->get('placeholder');

                $this->set('src', $valueIsAttachmentModel ?
                    $value->url($placeholder) :
                    (is_null($value) ? $placeholder : $value));
            }

            if ('' === $this->get('alt')) {
                $this->set('alt', $valueIsAttachmentModel ? $value->alt : '');
            }
        });
    }

    /**
     * Set image src attribute
     *
     * @param string|Attachment $src
     * @return static
     */
    public function src(string|Attachment $src): static
    {
        if (Helper::isAttachment($src)) {
            /** @var Attachment $src */
            return $this->set('src', $src->url());
        }

        return $this->set('src', $src);
    }

    /**
     * Set placeholder URL if there are no image passed
     *
     * @param string $placeholder
     * @return static
     */
    public function placeholder(string $placeholder): static
    {
        return $this->set('placeholder', $placeholder);
    }

    /**
     * Set image height
     *
     * @param string|integer $height
     * @return static
     */
    public function height(string|int $height): static
    {
        return $this->set('height', is_numeric($height) ? "{$height}px" : $height);
    }

    /**
     * Set image width
     *
     * @param string|integer $width
     * @return static
     */
    public function width(string|int $width): static
    {
        return $this->set('width', is_numeric($width) ? "{$width}px" : $width);
    }

    /**
     * Set both image width and height
     *
     * @param string|int $size
     * @return static
     */
    public function size(string|int $size): static
    {
        return $this
            ->width($size)
            ->height($size);
    }

    /**
     * Set image alt attribute
     *
     * @param string $alt
     * @return static
     */
    public function alt(string $alt): static
    {
        return $this->set('alt', $alt);
    }
}

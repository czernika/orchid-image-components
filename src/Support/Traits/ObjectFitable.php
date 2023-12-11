<?php

declare(strict_types=1);

namespace Czernika\OrchidImages\Support\Traits;

use Czernika\OrchidImages\Enums\ImageObjectFit;

trait ObjectFitable
{
    public function objectFit(string|ImageObjectFit $fit): static
    {
        if (is_a($fit, ImageObjectFit::class)) {
            $fit = $fit->value;
        }

        $this->set('fit', sprintf('object-fit-%s', $fit));

        return $this;
    }
}

<?php

declare(strict_types=1);

namespace Czernika\OrchidImages\Support\Traits;

use Czernika\OrchidImages\Enums\ObjectFit;

trait ObjectFitable
{
    public function objectFit(string|ObjectFit $fit): static
    {
        if (is_a($fit, ObjectFit::class)) {
            $fit = $fit->value;
        }

        // It needs to be compatible with Bootstrap class
        return $this->set('fit', sprintf('object-fit-%s', $fit));
    }
}

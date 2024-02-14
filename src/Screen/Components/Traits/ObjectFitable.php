<?php

declare(strict_types=1);

namespace Czernika\OrchidImages\Screen\Components\Traits;

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

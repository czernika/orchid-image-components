<?php

declare(strict_types=1);

namespace Czernika\OrchidImages\Screen\Components\Traits;

trait HasSizes
{
    public function setSize(string $param, string|int $value): static
    {
        return $this->set($param, is_numeric($value) ? "{$value}px" : $value);
    }
}

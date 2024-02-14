<?php

declare(strict_types=1);

namespace Czernika\OrchidImages\Screen\Components\Traits;

trait CanBeEmpty
{
    /**
     * Value to display when there are no images
     * Accepts raw HTML
     *
     * @param string $empty
     * @return static
     */
    public function empty(string $empty): static
    {
        return $this->set('empty', $empty);
    }
}

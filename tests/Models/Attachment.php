<?php

declare(strict_types=1);

namespace Tests\Models;

use Orchid\Attachment\Models\Attachment as OrchidAttachment;
use Illuminate\Support\Facades\Storage;

class Attachment extends OrchidAttachment
{
    /**
     * Don't want to check if file exist when it is not really a file (no need)
     */
    public function url(string $default = null): ?string
    {
        /** @var Filesystem|Cloud $disk */
        $disk = Storage::disk($this->getAttribute('disk'));
        $path = $this->physicalPath();

        return $disk->url($path);
    }
}

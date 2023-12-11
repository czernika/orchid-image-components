<?php

declare(strict_types=1);

namespace Czernika\OrchidImages\Support;

use Orchid\Attachment\Models\Attachment;
use Orchid\Platform\Dashboard;

class Helper
{
    public static function isAttachment($value): bool
    {
        return is_a($value, Dashboard::model(Attachment::class));
    }
}

<?php

declare(strict_types=1);

namespace Tests\Models;

use Orchid\Attachment\Models\Attachment as OrchidAttachment;

class AttachmentWithPlaceholder extends OrchidAttachment
{
    protected $table = 'attachments';
}

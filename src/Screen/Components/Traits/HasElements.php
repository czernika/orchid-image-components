<?php

declare(strict_types=1);

namespace Czernika\OrchidImages\Screen\Components\Traits;

use Czernika\OrchidImages\DTO\URLToAttachmentMapper;
use Czernika\OrchidImages\Support\Helper;
use Orchid\Attachment\Models\Attachment;
use Orchid\Platform\Dashboard;

trait HasElements
{
    protected function setElements(): void
    {
        if (!empty($this->get('elements'))) {
            return;
        }

        $this->elements($this->get('value'));
    }

    /**
     * Set gallery elements to display
     *
     * @param mixed $elements
     * @return static
     */
    public function elements($elements): static
    {
        // it can be attachment ID
        if (is_numeric($elements)) {
            $attachment = Dashboard::model(Attachment::class)::find($elements);

            return $this->set('elements', [$attachment]);
        }

        // it can be singular attachment instance
        if ($elements instanceof Attachment) {
            return $this->set('elements', $elements?->exists ? [$elements] : []);
        }

        if (is_array($elements) && !empty($elements)) {
            // it can be just an array of attachments
            if (Helper::isAttachment($elements[0])) {
                return $this->set('elements', $elements);
            }

            // it can be an array of string values
            // in this way we should convert it in order to be compatible with blade template
            $elements = collect($elements)->mapInto(URLToAttachmentMapper::class);
        }

        if (is_null($elements)) {
            return $this->set('elements', []);
        }

        return $this->set('elements', $elements);
    }
}

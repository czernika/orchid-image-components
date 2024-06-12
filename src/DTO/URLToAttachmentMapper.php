<?php

declare(strict_types=1);

namespace Czernika\OrchidImages\DTO;

class URLToAttachmentMapper
{
    public string $alt = '';

    public string $title = '';

    public string $url;

    public function __construct(protected $data)
    {
        $this->defineData();
    }

    public function url($placeholder = ''): string
    {
        return $this->url === '' ? $placeholder : $this->url;
    }

    protected function defineData(): void
    {
        // In most cases it will be url
        // unless it is an associative array with null value for url
        $potentialUrl = isset($this->data['url']) ? $this->data['url'] : $this->data;
        $this->url = is_array($potentialUrl) && is_null($potentialUrl['url']) ? '' : $potentialUrl;

        if (isset($this->data['alt'])) {
            $this->alt = $this->data['alt'];
        }

        if (isset($this->data['title'])) {
            $this->title = $this->data['title'];
        }
    }
}

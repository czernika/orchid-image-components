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

    public function url(): string
    {
        return $this->url;
    }

    protected function defineData(): void
    {
        $this->url = isset($this->data['url']) ? $this->data['url'] : $this->data;

        if (isset($this->data['alt'])) {
            $this->alt = $this->data['alt'];
        }

        if (isset($this->data['title'])) {
            $this->title = $this->data['title'];
        }
    }
}

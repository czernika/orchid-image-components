<?php

use Czernika\OrchidImages\Enums\ObjectFit;
use Czernika\OrchidImages\Screen\Components\Carousel;
use Orchid\Platform\Dashboard;
use Tests\Models\Attachment;
use Tests\Models\Post;

uses()->group('carousel');

describe('elements', function () {
    it('renders carousel if collection exists', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('post.attachment'), compact('post'));

        expect($rendered)->toContain(sprintf('src="%s"', $attachment->url()));
    });

    it('renders carousel even on singular instance', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create([
            'thumb_id' => $attachment->id,
        ]);

        $rendered = $this->renderComponent(Carousel::make('post.thumb'),
                        compact('post'));

        expect($rendered)->toContain(sprintf('src="%s"', $attachment->url()));
    });

    it('renders carousel if data was passed manually', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('carousel')
                        ->elements($post->attachment));

        expect($rendered)->toContain(sprintf('src="%s"', $attachment->url()));
    });

    it('renders carousel if data was passed as array of links', function () {
        $rendered = $this->renderComponent(Carousel::make('carousel')
                        ->elements(['https://some.url']));

        expect($rendered)->toContain('src="https://some.url"');
    });

    it('renders carousel if data was passed as array of attachments', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $rendered = $this->renderComponent(Carousel::make('carousel')
                        ->elements([$attachment]));

        expect($rendered)->toContain(sprintf('src="%s"', $attachment->url()));
    });

    it('renders carousel if data was passed from query', function () {
        Dashboard::model(Attachment::class)::factory(2)->create();
        $rendered = $this->renderComponent(Carousel::make('carousel')
                        ->elements(Dashboard::model(Attachment::class)::query()->get()));

        expect($rendered)->toContain(sprintf('src="%s"', Dashboard::model(Attachment::class)::first()->url()));
    });

    it('renders carousel if data was passed as associative array of links', function () {
        $rendered = $this->renderComponent(Carousel::make('carousel')
                        ->elements([
                            [
                                'url' => 'https://some.url',
                                'alt' => 'Some alt',
                                'title' => 'Some title',
                            ],
                        ]));

        expect($rendered)
            ->toContain('alt="Some alt"')
            ->toContain('title="Some title"')
            ->toContain('src="https://some.url"');
    });
})->group('carousel.elements');

describe('empty', function () {
    it('shows empty value if passed and no collection exists', function () {
        $post = Post::create();

        $rendered = $this->renderComponent(Carousel::make('post.attachment')
                        ->empty('No elements'), compact('post'));

        expect($rendered)->toContain('No elements');
    });
})->group('carousel.empty');

describe('fit', function () {
    it('renders correct object fit class', function (string $fit) {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('post.attachment')
                        ->objectFit($fit), compact('post'));

        expect($rendered)->toContain(sprintf('object-fit-%s', $fit));
    })->with([
        'contain',
        'cover',
        'fill',
        'scale',
        'none',
    ]);

    it('expects default value for object image type to be cover', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('post.attachment'), compact('post'));

        expect($rendered)->toContain('object-fit-cover');
    });

    it('renders object fit class when passed enum', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('post.attachment')
                        ->objectFit(ObjectFit::COVER), compact('post'));

        expect($rendered)->toContain('object-fit-cover');
    });
})->group('carousel.fit');

describe('size', function () {
    it('renders correct height value', function ($height) {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('post.attachment')
                        ->height($height), compact('post'));

        expect($rendered)->toContain('style="height: 600px;"');
    })->with([
        'numeric value' => 600,
        'string value with no CSS units' => '600',
        'string value' => '600px',
    ]);

    it('expects no height to be default value', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('post.attachment'), compact('post'));

        expect($rendered)->not->toContain('style="height:');
    });
})->group('carousel.size');

describe('animation', function () {
    it('creates fade carousel if fade was passed', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('post.attachment')
                    ->fade(), compact('post'));

        expect($rendered)->toContain('carousel-fade');
    });

    it('does not create fade carousel if fade was not passed', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('post.attachment'), compact('post'));

        expect($rendered)->not->toContain('carousel-fade');
    });

    it('can change delay value', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('post.attachment')
                    ->delay(10000), compact('post'));

        expect($rendered)->toContain('data-bs-delay="10000"');
    });

    it('set 5 seconds as default delay', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('post.attachment'), compact('post'));

        expect($rendered)->toContain('data-bs-delay="5000"');
    });
})->group('carousel.animation');

describe('controls', function () {
    it('renders indicators', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('post.attachment')
                        ->withIndicators(), compact('post'));

        expect($rendered)->toContain('data-bs-slide-to');
    });

    it('does not render indicators by default', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('post.attachment'), compact('post'));

        expect($rendered)->not->toContain('data-bs-slide-to');
    });

    it('renders controls', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('post.attachment')
                        ->withControls(), compact('post'));

        expect($rendered)->toContain('carousel-control-prev');
    });

    it('does not render controls by default', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('post.attachment'), compact('post'));

        expect($rendered)->not->toContain('carousel-control-prev');
    });

    it('renders lightbox', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('post.attachment')
                        ->withLightbox(), compact('post'));

        expect($rendered)->toContain('data-controller="lightbox"');
    });

    it('does not render lightbox by default', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('post.attachment'), compact('post'));

        expect($rendered)->not->toContain('data-controller="lightbox"');
    });
})->group('carousel.controls');

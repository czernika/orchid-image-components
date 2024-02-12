<?php

use Czernika\OrchidImages\Screen\Components\Carousel;
use Orchid\Platform\Dashboard;
use Tests\Models\Attachment;
use Tests\Models\Post;

uses()->group('carousel');

describe('carousel image component', function () {
    it('shows empty value if passed and no collection exists', function () {
        $post = Post::create();

        $rendered = $this->renderComponent(Carousel::make('slides')
                                ->empty('No elements'), ['slides' => $post->attachment()->get()]);

        expect($rendered)->toContain('No elements');
    });

    it('shows image on singular instance', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create([
            'thumb_id' => $attachment->id,
        ]);

        $rendered = $this->renderComponent(Carousel::make('post.thumb_id'),
                        compact('post'));

        expect($rendered)->toContain(sprintf('src="%s"', $attachment->url()));
    });

    it('shows image if collection exists', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('slides'),
                        ['slides' => $post->attachment]);

        expect($rendered)->toContain(sprintf('src="%s"', $attachment->url()));
    });

    it('renders correct height value', function ($height) {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('slides')->height($height),
                        ['slides' => $post->attachment]);

        expect($rendered)->toContain("style=\"height: 600px; max-width: 100%;\"");
    })->with([
        'numeric value' => 600,
        'string value' => '600px',
    ]);

    it('expects default value for height to be auto', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('slides'),
                        ['slides' => $post->attachment]);

        expect($rendered)->toContain("style=\"height: auto; max-width: 100%;\"");
    });

    it('renders correct width value', function ($width) {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('slides')->width($width),
                        ['slides' => $post->attachment]);

        expect($rendered)->toContain("style=\"height: auto; max-width: 600px;\"");
    })->with([
        'numeric value' => 600,
        'string value' => '600px',
    ]);

    it('expects default value for width to be 100%', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('slides'),
                        ['slides' => $post->attachment]);

        expect($rendered)->toContain("style=\"height: auto; max-width: 100%;\"");
    });

    it('renders correct object fit class', function (string $fit) {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('slides')->objectFit($fit),
                        ['slides' => $post->attachment]);

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

        $rendered = $this->renderComponent(Carousel::make('slides'),
                        ['slides' => $post->attachment]);

        expect($rendered)->toContain('object-fit-cover');
    });

    it('creates fade carousel if fade was passed', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('slides')->fade(),
                        ['slides' => $post->attachment]);

        expect($rendered)->toContain('carousel-fade');
    });

    it('does not create fade carousel if fade was not passed', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('slides'),
                        ['slides' => $post->attachment]);

        expect($rendered)->not->toContain('carousel-fade');
    });

    it('renders indicators', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('slides')->withIndicators(),
                        ['slides' => $post->attachment]);

        expect($rendered)->toContain('data-bs-slide-to');
    });

    it('does not render indicators by default', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('slides'),
                        ['slides' => $post->attachment]);

        expect($rendered)->not->toContain('data-bs-slide-to');
    });

    it('renders controls', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('slides')->withControls(),
                        ['slides' => $post->attachment]);

        expect($rendered)->toContain('carousel-control-prev');
    });

    it('does not render controls by default', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Carousel::make('slides'),
                        ['slides' => $post->attachment]);

        expect($rendered)->not->toContain('carousel-control-prev');
    });
});

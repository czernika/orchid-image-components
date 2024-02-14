<?php

use Czernika\OrchidImages\Enums\ObjectFit;
use Czernika\OrchidImages\Screen\Components\Gallery;
use Orchid\Platform\Dashboard;
use Tests\Models\Attachment;
use Tests\Models\Post;

uses()->group('gallery');

describe('elements', function () {
    it('renders grid if collection exists', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Gallery::make('post.attachment'), compact('post'));

        expect($rendered)->toContain(sprintf('src="%s"', $attachment->url()));
    });

    it('renders grid even on singular instance', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create([
            'thumb_id' => $attachment->id,
        ]);

        $rendered = $this->renderComponent(Gallery::make('post.thumb'),
                        compact('post'));

        expect($rendered)->toContain(sprintf('src="%s"', $attachment->url()));
    });

    it('renders grid if data was passed manually', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Gallery::make('gallery')
                        ->elements($post->attachment));

        expect($rendered)->toContain(sprintf('src="%s"', $attachment->url()));
    });

    it('renders grid if data was passed as array of links', function () {
        $rendered = $this->renderComponent(Gallery::make('gallery')
                        ->elements(['https://some.url']));

        expect($rendered)->toContain('src="https://some.url"');
    });

    it('renders grid if data was passed as array of attachments', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $rendered = $this->renderComponent(Gallery::make('gallery')
                        ->elements([$attachment]));

        expect($rendered)->toContain(sprintf('src="%s"', $attachment->url()));
    });

    it('renders grid if data was passed from query', function () {
        Dashboard::model(Attachment::class)::factory(2)->create();
        $rendered = $this->renderComponent(Gallery::make('gallery')
                        ->elements(Dashboard::model(Attachment::class)::query()->get()));

        expect($rendered)->toContain(sprintf('src="%s"', Dashboard::model(Attachment::class)::first()->url()));
    });

    it('renders grid if data was passed as associative array of links', function () {
        $rendered = $this->renderComponent(Gallery::make('gallery')
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
})->group('gallery.elements');

describe('empty', function () {
    it('shows empty value if passed and no collection exists', function () {
        $post = Post::create();

        $rendered = $this->renderComponent(Gallery::make('post.attachment')
                        ->empty('No elements'), compact('post'));

        expect($rendered)->toContain('No elements');
    });
})->group('gallery.empty');

describe('layout', function () {
    it('shows 6 columns by default', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Gallery::make('post.attachment'), compact('post'));

        expect($rendered)->toContain('style="grid-template-columns: repeat(6, 1fr);"');
    });

    it('can change number of columns', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Gallery::make('post.attachment')
                            ->columns(3), compact('post'));

        expect($rendered)->toContain('style="grid-template-columns: repeat(3, 1fr);"');
    });

    it('set auto-fit and ignores columns that way', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Gallery::make('post.attachment')
                        ->columns(3)
                        ->autoFit(250), compact('post'));

        expect($rendered)->toContain('style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));"');
    });
})->group('gallery.layout');

describe('aspect ratio', function () {
    it('has 4 / 3 default ratio', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Gallery::make('post.attachment'), compact('post'));

        expect($rendered)->toContain('style="--oi-gallery-aspect-ratio: 4 / 3;"');
    });

    it('can change gallery image ratio', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Gallery::make('post.attachment')
                            ->aspectRatio('16 / 9'), compact('post'));

        expect($rendered)->toContain('style="--oi-gallery-aspect-ratio: 16 / 9;"');
    });
})->group('gallery.ratio');

describe('fit', function () {
    it('renders correct object fit class', function (string $fit) {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Gallery::make('post.attachment')
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

        $rendered = $this->renderComponent(Gallery::make('post.attachment'), compact('post'));

        expect($rendered)->toContain('object-fit-cover');
    });

    it('renders object fit class when passed enum', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Gallery::make('post.attachment')
                        ->objectFit(ObjectFit::COVER), compact('post'));

        expect($rendered)->toContain('object-fit-cover');
    });
})->group('gallery.fit');

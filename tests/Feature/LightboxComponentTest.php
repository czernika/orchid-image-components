<?php

use Czernika\OrchidImages\Enums\ObjectFit;
use Czernika\OrchidImages\Screen\Components\Lightbox;
use Orchid\Platform\Dashboard;
use Tests\Models\Attachment;
use Tests\Models\Post;

uses()->group('lightbox');

describe('elements', function () {
    it('renders grid if collection exists', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Lightbox::make('post.attachment'), compact('post'));

        expect($rendered)->toContain(sprintf('src="%s"', $attachment->url()));
    });

    it('renders grid even on singular instance', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create([
            'thumb_id' => $attachment->id,
        ]);

        $rendered = $this->renderComponent(Lightbox::make('post.thumb_id'),
                        compact('post'));

        expect($rendered)->toContain(sprintf('src="%s"', $attachment->url()));
    });

    it('renders grid if data was passed manually', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Lightbox::make('gallery')
                        ->elements($post->attachment));

        expect($rendered)->toContain(sprintf('src="%s"', $attachment->url()));
    });
})->group('lightbox.elements');

describe('empty', function () {
    it('shows empty value if passed and no collection exists', function () {
        $post = Post::create();

        $rendered = $this->renderComponent(Lightbox::make('post.attachment')
                        ->empty('No elements'), compact('post'));

        expect($rendered)->toContain('No elements');
    });
})->group('lightbox.empty');

describe('layout', function () {
    it('shows 6 columns by default', function () {
        $rendered = $this->renderComponent(Lightbox::make('gallery'));

        expect($rendered)->toContain('style="grid-template-columns: repeat(6, 1fr);"');
    });

    it('can change number of columns', function () {
        $rendered = $this->renderComponent(Lightbox::make('gallery')
                            ->columns(3));

        expect($rendered)->toContain('style="grid-template-columns: repeat(3, 1fr);"');
    });

    it('set auto-fit and ignores columns that way', function () {
        $rendered = $this->renderComponent(Lightbox::make('gallery')
                        ->columns(3)
                        ->autoFit(250));

        expect($rendered)->toContain('style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));"');
    });
})->group('lightbox.layout');

describe('aspect ratio', function () {
    it('has 4 / 3 default ratio', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Lightbox::make('post.attachment'), compact('post'));

        expect($rendered)->toContain('style="--oi-gallery-aspect-ratio: 4 / 3;"');
    });

    it('can change gallery image ratio', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Lightbox::make('post.attachment')
                            ->aspectRatio('16 / 9'), compact('post'));

        expect($rendered)->toContain('style="--oi-gallery-aspect-ratio: 16 / 9;"');
    });
})->group('lightbox.ratio');

describe('fit', function () {
    it('renders correct object fit class', function (string $fit) {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Lightbox::make('post.attachment')
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

        $rendered = $this->renderComponent(Lightbox::make('post.attachment'), compact('post'));

        expect($rendered)->toContain('object-fit-cover');
    });

    it('renders object fit class when passed enum', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Lightbox::make('post.attachment')
                        ->objectFit(ObjectFit::COVER), compact('post'));

        expect($rendered)->toContain('object-fit-cover');
    });
})->group('lightbox.fit');

describe('images', function () {
    it('has default zoomable effect', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Lightbox::make('post.attachment'), compact('post'));

        expect($rendered)->toContain('data-zoomable="true"');
    });

    it('zoomable effect can be changed', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Lightbox::make('post.attachment')
                    ->zoomable(false), compact('post'));

        expect($rendered)->toContain('data-zoomable="false"');
    });

    it('has default draggable effect', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Lightbox::make('post.attachment'), compact('post'));

        expect($rendered)->toContain('data-draggable="true"');
    });

    it('draggable effect can be changed', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Lightbox::make('post.attachment')
                    ->draggable(false), compact('post'));

        expect($rendered)->toContain('data-draggable="false"');
    });
})->group('lightbox.images');

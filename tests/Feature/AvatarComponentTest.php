<?php

use Czernika\OrchidImages\Enums\ImageObjectFit;
use Czernika\OrchidImages\Screen\Components\Avatar;
use Orchid\Attachment\Models\Attachment;
use Orchid\Platform\Dashboard;
use Tests\Models\AttachmentWithPlaceholder;
use Tests\Models\Post;

describe('avatar component', function () {
    it('renders passed src attribute', function () {
        $rendered = $this->renderComponent(Avatar::make('image')
                        ->src($url = fake()->imageUrl()));

        expect($rendered)->toContain("src=\"$url\"");
    });

    it('can resolve src from database column when targeting url value', function () {
        $thumb = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create([
            'thumb_url' => $thumb->url(),
        ]);

        $rendered = $this->renderComponent(Avatar::make('post.thumb_url'), compact('post'));

        expect($rendered)->toContain(sprintf('src="%s"', $thumb->url()));
    });

    it('can resolve src from database column when targeting id value', function () {
        $thumb = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create([
            'thumb_id' => $thumb->id,
        ]);

        $rendered = $this->renderComponent(Avatar::make('post.thumb_id'), compact('post'));

        expect($rendered)->toContain(sprintf('src="%s"', $thumb->url()));
    });

    it('renders passed alt attribute', function () {
        $rendered = $this->renderComponent(Avatar::make('image')
                        ->alt($alt = fake()->text));

        expect($rendered)->toContain("alt=\"$alt\"");
    });

    it('can show placeholder if file does not exists', function () {
        Dashboard::useModel(Attachment::class, AttachmentWithPlaceholder::class);

        $thumb = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create([
            'thumb_id' => $thumb->id,
        ]);

        Dashboard::useModel(Attachment::class, Attachment::class);

        $rendered = $this->renderComponent(Avatar::make('post.thumb_id')
            ->placeholder('/img/placeholder.webp'), compact('post'));

        expect($rendered)->toContain('src="/img/placeholder.webp"');
    });

    it('can show placeholder if relation does not exists', function () {
        $post = Post::create([
            'thumb_id' => null,
        ]);

        $rendered = $this->renderComponent(Avatar::make('post.thumb_id')
            ->placeholder('/img/placeholder.webp'), compact('post'));

        expect($rendered)->toContain('src="/img/placeholder.webp"');
    })->group('now');

    it('can resolve alt from attachment database column when targeting id value', function () {
        $thumb = Dashboard::model(Attachment::class)::factory()->create([
            'alt' => 'Alt text',
        ]);
        $post = Post::create([
            'thumb_id' => $thumb->id,
        ]);

        $rendered = $this->renderComponent(Avatar::make('post.thumb_id'), compact('post'));

        expect($rendered)->toContain(sprintf('alt="%s"', $thumb->alt));
    });

    it('renders correct size value', function ($size) {
        $rendered = $this->renderComponent(Avatar::make('image')
                        ->size($size));

        expect($rendered)->toContain("style=\"height: 120px; width: 120px;\"");
    })->with([
        'numeric value' => 120,
        'string value' => '120px',
    ]);

    it('expects default value for size to be 48px', function () {
        $rendered = $this->renderComponent(Avatar::make('image'));

        expect($rendered)->toContain("style=\"height: 48px; width: 48px;\"");
    });
});

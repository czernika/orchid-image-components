<?php

use Czernika\OrchidImages\Enums\ImageObjectFit;
use Czernika\OrchidImages\Screen\Components\Image;
use Orchid\Attachment\Models\Attachment;
use Orchid\Platform\Dashboard;
use Tests\Models\AttachmentWithPlaceholder;
use Tests\Models\Post;

uses()->group('image');

describe('image component', function () {
    it('renders passed src attribute', function () {
        $rendered = $this->renderComponent(Image::make('image')
                        ->src($url = fake()->imageUrl()));

        expect($rendered)->toContain("src=\"$url\"");
    });

    it('can resolve src from database column when targeting url value', function () {
        $thumb = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create([
            'thumb_url' => $thumb->url(),
        ]);

        $rendered = $this->renderComponent(Image::make('post.thumb_url'), compact('post'));

        expect($rendered)->toContain(sprintf('src="%s"', $thumb->url()));
    });

    it('can resolve src from database column when targeting id value', function () {
        $thumb = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create([
            'thumb_id' => $thumb->id,
        ]);

        $rendered = $this->renderComponent(Image::make('post.thumb_id'), compact('post'));

        expect($rendered)->toContain(sprintf('src="%s"', $thumb->url()));
    });

    it('renders passed alt attribute', function () {
        $rendered = $this->renderComponent(Image::make('image')
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

        $rendered = $this->renderComponent(Image::make('post.thumb_id')
            ->placeholder('/img/placeholder.webp'), compact('post'));

        expect($rendered)->toContain('src="/img/placeholder.webp"');
    });

    it('can show placeholder if relation does not exists', function () {
        $post = Post::create([
            'thumb_id' => null,
        ]);

        $rendered = $this->renderComponent(Image::make('post.thumb_id')
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

        $rendered = $this->renderComponent(Image::make('post.thumb_id'), compact('post'));

        expect($rendered)->toContain(sprintf('alt="%s"', $thumb->alt));
    });

    it('renders correct object fit class', function (string $fit) {
        $rendered = $this->renderComponent(Image::make('image')
                        ->objectFit($fit));

        expect($rendered)->toContain(sprintf('object-fit-%s', $fit));
    })->with([
        'contain',
        'cover',
        'fill',
        'scale',
        'none',
    ]);

    it('expects default value for object image type to be cover', function () {
        $rendered = $this->renderComponent(Image::make('image'));

        expect($rendered)->toContain('object-fit-cover');
    });

    it('renders object fit class when passed enum', function () {
        $rendered = $this->renderComponent(Image::make('image')
                        ->objectFit(ImageObjectFit::COVER));

        expect($rendered)->toContain('object-fit-cover');
    });

    it('renders correct height value', function ($height) {
        $rendered = $this->renderComponent(Image::make('image')
                        ->height($height));

        expect($rendered)->toContain("style=\"height: 600px; width: 100%;\"");
    })->with([
        'numeric value' => 600,
        'string value' => '600px',
    ]);

    it('expects default value for height to be auto', function () {
        $rendered = $this->renderComponent(Image::make('image'));

        expect($rendered)->toContain("style=\"height: auto; width: 100%;\"");
    });

    it('renders correct width value', function ($width) {
        $rendered = $this->renderComponent(Image::make('image')
                        ->width($width));

        expect($rendered)->toContain("style=\"height: auto; width: 600px;\"");
    })->with([
        'numeric value' => 600,
        'string value' => '600px',
    ]);

    it('expects default value for width to be 100%', function () {
        $rendered = $this->renderComponent(Image::make('image'));

        expect($rendered)->toContain("style=\"height: auto; width: 100%;\"");
    });
});

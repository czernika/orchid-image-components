<?php

use Czernika\OrchidImages\Enums\ObjectFit;
use Czernika\OrchidImages\Screen\Components\Image;
use Orchid\Attachment\Models\Attachment;
use Orchid\Platform\Dashboard;
use Tests\Models\Attachment as TestAttachment;
use Tests\Models\AttachmentWithPlaceholder;
use Tests\Models\Post;

uses()->group('image');

describe('src', function () {
    it('can be resolved from database column when targeting url value', function () {
        $thumb = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create([
            'thumb_url' => $url = $thumb->url(),
        ]);

        $rendered = $this->renderComponent(Image::make('post.thumb_url'), compact('post'));

        expect($rendered)->toContain(sprintf('src="%s"', $url));
    });

    it('can be resolved from database column when targeting id value', function () {
        $thumb = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create([
            'thumb_id' => $thumb->id,
        ]);

        $rendered = $this->renderComponent(Image::make('post.thumb_id'), compact('post'));

        expect($rendered)->toContain(sprintf('src="%s"', $thumb->url()));
    });

    it('can be changed with string value', function () {
        $rendered = $this->renderComponent(Image::make('image')
                        ->src($url = fake()->imageUrl()));

        expect($rendered)->toContain("src=\"$url\"");
    });

    it('can be changed with attachment value', function () {
        $thumb = Dashboard::model(Attachment::class)::factory()->create();
        $rendered = $this->renderComponent(Image::make('image')
                        ->src($thumb));

        expect($rendered)->toContain(sprintf('src="%s"', $thumb->url()));
    });

    it('can be changed with relation value', function () {
        $thumb = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create([
            'thumb_id' => $thumb->id,
        ]);

        $rendered = $this->renderComponent(Image::make('image')
            ->src($post->thumb), compact('post'));

        expect($rendered)->toContain(sprintf('src="%s"', $thumb->url()));
    });
})->group('image.src');

describe('placeholder', function () {
    it('can show placeholder if file does not exists', function () {
        Dashboard::useModel(Attachment::class, AttachmentWithPlaceholder::class);

        $thumb = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create([
            'thumb_id' => $thumb->id,
        ]);

        $rendered = $this->renderComponent(Image::make('post.thumb_id')
            ->placeholder('/img/placeholder.webp'), compact('post'));

        Dashboard::useModel(Attachment::class, TestAttachment::class);

        expect($rendered)->toContain('src="/img/placeholder.webp"');
    });

    it('can show placeholder if relation does not exists', function () {
        $post = Post::create([
            'thumb_id' => null,
        ]);

        $rendered = $this->renderComponent(Image::make('post.thumb_id')
            ->placeholder('/img/placeholder.webp'), compact('post'));

        expect($rendered)->toContain('src="/img/placeholder.webp"');
    });
})->group('image.placeholder');

describe('size', function () {
    it('renders correct height value', function ($height) {
        $rendered = $this->renderComponent(Image::make('image')
                        ->height($height));

        expect($rendered)->toContain("style=\"--oi-image-height: 600px; --oi-image-width: 100%;\"");
    })->with([
        'numeric value' => 600,
        'string value with no CSS units' => '600',
        'string value' => '600px',
    ]);

    it('expects default value for height to be auto', function () {
        $rendered = $this->renderComponent(Image::make('image'));

        expect($rendered)->toContain("style=\"--oi-image-height: auto; --oi-image-width: 100%;\"");
    });

    it('renders correct width value', function ($width) {
        $rendered = $this->renderComponent(Image::make('image')
                        ->width($width));

        expect($rendered)->toContain("style=\"--oi-image-height: auto; --oi-image-width: 600px;\"");
    })->with([
        'numeric value' => 600,
        'string value with no CSS units' => '600',
        'string value' => '600px',
    ]);

    it('expects default value for width to be 100%', function () {
        $rendered = $this->renderComponent(Image::make('image'));

        expect($rendered)->toContain("style=\"--oi-image-height: auto; --oi-image-width: 100%;\"");
    });

    it('renders correct both width and height value when passed as size', function ($size) {
        $rendered = $this->renderComponent(Image::make('image')
                        ->size($size));

        expect($rendered)->toContain("style=\"--oi-image-height: 600px; --oi-image-width: 600px;\"");
    })->with([
        'numeric value' => 600,
        'string value with no CSS units' => '600',
        'string value' => '600px',
    ]);
})->group('image.size');

describe('alt', function () {
    it('can be rendered', function () {
        $rendered = $this->renderComponent(Image::make('image')
                        ->alt($alt = fake()->text));

        expect($rendered)->toContain("alt=\"$alt\"");
    });

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

    it('can override alt from attachment database column when passed manually', function () {
        $thumb = Dashboard::model(Attachment::class)::factory()->create([
            'alt' => 'Alt from database',
        ]);
        $post = Post::create([
            'thumb_id' => $thumb->id,
        ]);

        $rendered = $this->renderComponent(Image::make('post.thumb_id')
                        ->alt('Alt was passed'), compact('post'));

        expect($rendered)
            ->toContain('alt="Alt was passed"')
            ->not->toContain('alt="Alt from database"');
    });
})->group('image.alt');

describe('fit', function () {
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
                        ->objectFit(ObjectFit::COVER));

        expect($rendered)->toContain('object-fit-cover');
    });
})->group('image.fit');

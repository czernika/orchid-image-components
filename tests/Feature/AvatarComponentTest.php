<?php

use Czernika\OrchidImages\Screen\Components\Avatar;
use Orchid\Attachment\Models\Attachment;
use Orchid\Platform\Dashboard;
use Orchid\Support\Color;
use Tests\Models\Attachment as TestAttachment;
use Tests\Models\AttachmentWithPlaceholder;
use Tests\Models\Post;
use Tests\Models\PostWithDefault;

uses()->group('avatar');

describe('src', function () {
    it('can be resolved from database column when targeting url value', function () {
        $thumb = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create([
            'thumb_url' => $url = $thumb->url(),
        ]);

        $rendered = $this->renderComponent(Avatar::make('post.thumb_url'), compact('post'));

        expect($rendered)->toContain(sprintf('src="%s"', $url));
    });

    it('can be resolved from database column when targeting id value', function () {
        $thumb = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create([
            'thumb_id' => $thumb->id,
        ]);

        $rendered = $this->renderComponent(Avatar::make('post.thumb_id'), compact('post'));

        expect($rendered)->toContain(sprintf('src="%s"', $thumb->url()));
    });

    it('can be changed with string value', function () {
        $rendered = $this->renderComponent(Avatar::make('avatar')
                        ->src($url = fake()->imageUrl()));

        expect($rendered)->toContain(sprintf('src="%s"', $url));
    });

    it('can be changed with attachment value', function () {
        $thumb = Dashboard::model(Attachment::class)::factory()->create();
        $rendered = $this->renderComponent(Avatar::make('avatar')
                        ->src($thumb));

        expect($rendered)->toContain(sprintf('src="%s"', $thumb->url()));
    });

    it('can be changed with relation value', function () {
        $thumb = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create([
            'thumb_id' => $thumb->id,
        ]);

        $rendered = $this->renderComponent(Avatar::make('avatar')
            ->src($post->thumb), compact('post'));

        expect($rendered)->toContain(sprintf('src="%s"', $thumb->url()));
    });
})->group('avatar.src');

describe('placeholder', function () {
    it('can show placeholder if file does not exists', function () {
        Dashboard::useModel(Attachment::class, AttachmentWithPlaceholder::class);

        $thumb = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create([
            'thumb_id' => $thumb->id,
        ]);

        $rendered = $this->renderComponent(Avatar::make('post.thumb_id')
            ->placeholder('/img/placeholder.webp'), compact('post'));

        Dashboard::useModel(Attachment::class, TestAttachment::class);
    
        expect($rendered)->toContain('src="/img/placeholder.webp"');
    });

    it('can show placeholder if relation does not exists', function () {
        $post = Post::create([
            'thumb_id' => null,
        ]);

        $rendered = $this->renderComponent(Avatar::make('post.thumb_id')
            ->placeholder('/img/placeholder.webp'), compact('post'));

        expect($rendered)->toContain('src="/img/placeholder.webp"');
    });

    it('can show placeholder for relations with default models', function () {
        $post = PostWithDefault::create([
            'thumb_id' => null,
        ]);

        $rendered = $this->renderComponent(Avatar::make('post.thumb')
            ->placeholder('/img/placeholder.webp'), compact('post'));

        expect($rendered)->toContain('src="/img/placeholder.webp"');
    });

    test('empty method is an alias for placeholder', function () {
        $post = Post::create([
            'thumb_id' => null,
        ]);

        $rendered = $this->renderComponent(Avatar::make('post.thumb_id')
            ->empty('/img/placeholder.webp'), compact('post'));

        expect($rendered)->toContain('src="/img/placeholder.webp"');
    });
})->group('avatar.placeholder');

describe('size', function () {
    it('renders correct both height and width value', function ($size) {
        $rendered = $this->renderComponent(Avatar::make('avatar')
                        ->size($size));

        expect($rendered)->toContain("style=\"--oi-avatar-height: 600px; --oi-avatar-width: 600px;\"");
    })->with([
        'numeric value' => 600,
        'string value with no CSS units' => '600',
        'string value' => '600px',
    ]);

    it('expects default value for height and width to be 3rem', function () {
        $rendered = $this->renderComponent(Avatar::make('avatar'));

        expect($rendered)->toContain("style=\"--oi-avatar-height: 3rem; --oi-avatar-width: 3rem;\"");
    });
})->group('avatar.size');

describe('alt', function () {
    it('can be rendered', function () {
        $rendered = $this->renderComponent(Avatar::make('avatar')
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

        $rendered = $this->renderComponent(Avatar::make('post.thumb_id'), compact('post'));

        expect($rendered)->toContain(sprintf('alt="%s"', $thumb->alt));
    });

    it('can override alt from attachment database column when passed manually', function () {
        $thumb = Dashboard::model(Attachment::class)::factory()->create([
            'alt' => 'Alt from database',
        ]);
        $post = Post::create([
            'thumb_id' => $thumb->id,
        ]);

        $rendered = $this->renderComponent(Avatar::make('post.thumb_id')
                        ->alt('Alt was passed'), compact('post'));

        expect($rendered)
            ->toContain('alt="Alt was passed"')
            ->not->toContain('alt="Alt from database"');
    });
})->group('avatar.alt');

describe('badge', function () {
    it('does not render badge by default', function () {
        $rendered = $this->renderComponent(Avatar::make('avatar'));

        expect($rendered)
            ->not->toContain('oi-avatar__badge');
    });

    it('renders badge value', function ($value) {
        $thumb = Dashboard::model(Attachment::class)::factory()->create([
            'alt' => 'Alt from database',
            'sort' => 15,
        ]);
        $post = Post::create([
            'thumb_id' => $thumb->id,
        ]);

        $rendered = $this->renderComponent(Avatar::make('post.thumb')
                        ->badge($value), compact('post'));

        expect($rendered)
            ->toContain('oi-avatar__badge')
            ->toContain(15);
    })->with([
        'simple value' => 15,
        'callback' => fn () => fn () => 15,
        'callback with attachment' => fn () => fn (Attachment $attachment) => $attachment->sort,
    ]);

    it('has default badge type', function () {
        $rendered = $this->renderComponent(Avatar::make('avatar')
                    ->badge(5));

        expect($rendered)
            ->toContain('bg-primary');
    });

    it('can change badge type', function () {
        $rendered = $this->renderComponent(Avatar::make('avatar')
            ->badge(5)
            ->badgeType(Color::WARNING));

        expect($rendered)
            ->toContain('bg-warning');
    });
})->group('avatar.badge');

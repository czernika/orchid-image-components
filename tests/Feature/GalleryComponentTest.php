<?php

use Czernika\OrchidImages\Screen\Components\Gallery;
use Orchid\Platform\Dashboard;
use Tests\Models\Attachment;
use Tests\Models\Post;

describe('gallery image component', function () {
    it('shows empty value if passed and no collection exists', function () {
        $post = Post::create();

        $rendered = $this->renderComponent(Gallery::make('gallery')
                                ->empty('No elements'), ['gallery' => $post->attachment()->get()]);

        expect($rendered)->toContain('No elements');
    });

    it('shows image if collection exists', function () {
        $attachment = Dashboard::model(Attachment::class)::factory()->create();
        $post = Post::create();
        $post->attachment()->syncWithoutDetaching($attachment);

        $rendered = $this->renderComponent(Gallery::make('gallery'),
                        ['gallery' => $post->attachment]);

        expect($rendered)->toContain(sprintf('src="%s"', $attachment->url()));
    });

    it('set number of columns', function () {
        $rendered = $this->renderComponent(Gallery::make('gallery')
                            ->columns(3));

        expect($rendered)->toContain('style="grid-template-columns: repeat(3, 1fr);"');
    });

    it('set 6 columns gallery if no value was set', function () {
        $rendered = $this->renderComponent(Gallery::make('gallery'));

        expect($rendered)->toContain('style="grid-template-columns: repeat(6, 1fr);"');
    });

    it('set auto-fit and ignores columns then', function () {
        $rendered = $this->renderComponent(Gallery::make('gallery')
                        ->columns(3)
                        ->autoFit(250));

        expect($rendered)->toContain('style="grid-template-columns: repeat(auto-fit, 250px);"');
    });
});

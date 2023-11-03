<?php

use Czernika\OrchidImages\Enums\ImageObjectFit;
use Czernika\OrchidImages\Screen\Components\Image;

describe('image component', function () {
    it('renders passed src attribute', function () {
        $rendered = $this->renderComponent(Image::make('image')
                        ->src($url = fake()->imageUrl()));

        expect($rendered)->toContain("src=\"$url\"");
    });

    it('renders passed alt attribute', function () {
        $rendered = $this->renderComponent(Image::make('image')
                        ->alt($alt = fake()->text));

        expect($rendered)->toContain("alt=\"$alt\"");
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

        expect($rendered)->toContain("style=\"height: 600px;\"");
    })->with([
        'numeric value' => 600,
        'string value' => '600px',
    ]);

    it('expects default value for height to be 30rem', function () {
        $rendered = $this->renderComponent(Image::make('image'));

        expect($rendered)->toContain("style=\"height: 30rem;\"");
    });
});

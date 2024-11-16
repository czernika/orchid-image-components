@component($typeForm, get_defined_vars())
<div data-controller="carousel">
    @if (count($elements) !== 0)
        <div
            id="oi-carousel-{{ $id }}"
            @class([
                'carousel oi-carousel slide',
                'carousel-fade' => $fade,
            ])
            data-bs-ride="carousel"
            data-bs-delay="{{ $delay }}"
            @if ($height !== false)
                style="height: {{ $height }};"
            @endif
        >

            @if ($indicators)
                <div class="carousel-indicators">
                    @foreach ($elements as $item)
                        <button
                            type="button"
                            data-bs-target="#oi-carousel-{{ $id }}"
                            data-bs-slide-to="{{ $loop->index }}"
                            @class([
                                'active' => $loop->index === 0,
                            ])
                            @if ($loop->index === 0)
                                aria-current="true"
                            @endif
                            aria-label="{{ __('Slide :number', ['number' => $loop->iteration]) }}"
                        ></button>
                    @endforeach
                </div>
            @endif

            @if ($controls)
                <button class="carousel-control-prev" type="button" data-bs-target="#oi-carousel-{{ $id }}" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">{{ __('Previous') }}</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#oi-carousel-{{ $id }}" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">{{ __('Next') }}</span>
                </button>
            @endif

            @if ($lightbox)
                <div data-controller="lightbox" class="h-100">
            @endif
                <ul class="carousel-inner list-unstyled h-100">
                    @foreach ($elements as $item)
                        @if ($lightbox)
                            @include('orchid-images::partials.carousel.lightbox-image', ['index' => $loop->index, 'aspectRatio' => 'initial'])
                        @else
                            @include('orchid-images::partials.carousel.carousel-image', ['index' => $loop->index])
                        @endif
                    @endforeach
                </ul>
            @if ($lightbox)
                </div>
            @endif
        </div>
    @else
        @include('orchid-images::partials.carousel.empty')
    @endif
</div>
@endcomponent

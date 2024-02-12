@component($typeForm, get_defined_vars())
    <div data-controller="carousel">
        <div id="carousel-{{ $id }}" @class([
            'carousel oi-carousel slide',
            'carousel-fade' => $fade,
        ]) data-bs-ride="carousel" style="height: {{ $height }}; max-width: {{ $width }};">

            @if ($indicators)
                <div class="carousel-indicators">
                    @foreach ($elements as $item)
                        <button type="button" data-bs-target="#carousel-{{ $id }}" data-bs-slide-to="{{ $loop->index }}" class="active"></button>
                    @endforeach
                </div>
            @endif

            @if ($controls)
                <button class="carousel-control-prev" style="z-index: 2;" type="button" data-bs-target="#carousel-{{ $id }}" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">{{ __('Previous') }}</span>
                </button>
                <button class="carousel-control-next" style="z-index: 2;" type="button" data-bs-target="#carousel-{{ $id }}" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">{{ __('Next') }}</span>
                </button>
            @endif

            <div class="carousel-inner">
                @forelse ($elements as $item)
                    <div @class([
                        'carousel-item oi-image',
                        'active' => $loop->index === 0,
                    ]) style="height: {{ $height }};">
                        <img
                            @class([
                                'border d-block rounded w-100',
                                $fit,
                            ])
                            src="{{ $item->url() }}"
                            alt="{{ $item->alt }}"
                            title="{{ $item->title }}"
                        />
                    </div>
                @empty
                    <div class="">{{ $empty }}</div>
                @endforelse
            </div>
        </div>
    </div>
@endcomponent

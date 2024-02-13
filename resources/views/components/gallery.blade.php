@component($typeForm, get_defined_vars())
    <ul
        class="list-unstyled oi-gallery"
        style="grid-template-columns: {{ $templateColumns }};"
    >
        @forelse ($elements as $item)
            <li class="oi-image" style="--oi-gallery-aspect-ratio: {{ $aspectRatio }};">
                <img
                    @class([
                        'border d-block rounded w-100 h-100',
                        $fit,
                    ])
                    src="{{ $item->url() }}"
                    alt="{{ $item->alt }}"
                    title="{{ $item->title }}"
                />
            </li>
        @empty
            <li class="oi-gallery__empty">{!! $empty !!}</li>
        @endforelse
    </ul>
@endcomponent

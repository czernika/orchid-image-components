@component($typeForm, get_defined_vars())
<div data-controller="lightbox">
    <ul
        class="list-unstyled oi-gallery oi-lightbox" style="grid-template-columns: {{ $templateColumns }};"
    >
        @forelse ($elements as $item)
            <li>
                <a
                    href="{{ $item->url() }}"
                    class="glightbox oi-image d-block"
                    style="--oi-gallery-aspect-ratio: {{ $aspectRatio }};"
                    data-gallery="oi-gallery-{{ $id }}"

                    {{ $dataAttributes }}
                >
                    <img
                        @class([
                            'border d-block rounded w-100 h-100',
                            $fit,
                        ])
                        src="{{ $item->url() }}"
                        alt="{{ $item->alt }}"
                        title="{{ $item->title }}"
                    />
                </a>
            </li>
        @empty
            <li class="oi-gallery__empty">{!! $empty !!}</li>
        @endforelse
    </ul>

</div>
@endcomponent

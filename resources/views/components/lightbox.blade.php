@component($typeForm, get_defined_vars())
<div data-controller="lightbox">

    <ul class="list-unstyled oi-gallery oi-lightbox" style="grid-template-columns: repeat({{ $autoFit === false ? $columns : 'auto-fit' }}, {{ $autoFit === false ? '1fr' : $autoFit }});">
        @forelse ($elements as $item)
            <li class="">
                <a
                    href="{{ $item->url() }}"
                    class="glightbox oi-image d-block"
                    style="height: {{ $height }};"
                    data-gallery="{{ $id }}"
                    data-type="image"
                    data-effect="zoom"
                    data-zoomable="true"
                    data-draggable="true"
                    data-height="100%"
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
            <li>{{ $empty }}</li>
        @endforelse
    </ul>

</div>
@endcomponent

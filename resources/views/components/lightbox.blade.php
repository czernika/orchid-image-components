@component($typeForm, get_defined_vars())
<div data-controller="lightbox">

    <ul class="list-unstyled oi-gallery oi-lightbox" style="grid-template-columns: repeat({{ $columns }}, 1fr)">
        @foreach ($elements as $item)
            <li class="">
                <a
                    href="{{ $item->url() }}"
                    class="glightbox oi-image"
                    data-gallery="{{ $id }}"
                    data-type="image"
                    data-effect="zoom"
                    data-zoomable="true"
                    data-draggable="true"
                    data-height="100%"
                >
                    <img class="border d-block rounded" src="{{ $item->url() }}" alt="{{ $item->alt }}" title="{{ $item->title }}" />
                </a>
            </li>
        @endforeach
    </ul>

</div>
@endcomponent

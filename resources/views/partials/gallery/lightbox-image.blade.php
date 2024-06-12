<li>
    <a
        href="{{ $item->url($placeholder) }}"
        class="glightbox oi-image d-block"
        style="--oi-gallery-aspect-ratio: {{ $aspectRatio }};"
        data-gallery="oi-gallery-{{ $id }}"
        {{ $dataAttributes }}
    >
        @include('orchid-images::partials.image', ['src' => $item->url($placeholder), 'alt' => $item->alt, 'title' => $item->title])
    </a>
</li>

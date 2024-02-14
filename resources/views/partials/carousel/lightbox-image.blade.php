<li @class([
    'carousel-item h-100',
    'active' => $index === 0,
])>
    <a
        href="{{ $item->url() }}"
        class="glightbox oi-image d-block h-100"
        style="--oi-gallery-aspect-ratio: {{ $aspectRatio }};"
        data-gallery="oi-gallery-{{ $id }}"
        {{ $dataAttributes }}
    >
        @include('orchid-images::partials.image', ['src' => $item->url(), 'alt' => $item->alt, 'title' => $item->title])
    </a>
</li>

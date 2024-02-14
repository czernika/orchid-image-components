<li @class([
    'carousel-item oi-image h-100',
    'active' => $index === 0,
])>
    @include('orchid-images::partials.image', ['src' => $item->url(), 'alt' => $item->alt, 'title' => $item->title])
</li>

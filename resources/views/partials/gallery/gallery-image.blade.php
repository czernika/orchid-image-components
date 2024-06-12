<li
    class="oi-image"
    style="--oi-gallery-aspect-ratio: {{ $aspectRatio }};"
>
    @include('orchid-images::partials.image', ['src' => $item->url($placeholder), 'alt' => $item->alt, 'title' => $item->title])
</li>

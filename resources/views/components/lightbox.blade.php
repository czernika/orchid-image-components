@component($typeForm, get_defined_vars())
<div data-controller="lightbox">
    <ul
        class="list-unstyled oi-gallery oi-lightbox"
        style="grid-template-columns: {{ $templateColumns }};"
    >
        @forelse ($elements as $item)
            @include('orchid-images::partials.gallery.lightbox-image')
        @empty
            @include('orchid-images::partials.gallery.empty')
        @endforelse
    </ul>
</div>
@endcomponent

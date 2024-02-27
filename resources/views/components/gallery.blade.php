@component($typeForm, get_defined_vars())
    <ul
        class="list-unstyled oi-gallery"
        style="grid-template-columns: {{ $templateColumns }}; max-width: {{ $width }};"
    >
        @forelse ($elements as $item)
            @include('orchid-images::partials.gallery.gallery-image')
        @empty
            @include('orchid-images::partials.gallery.empty')
        @endforelse
    </ul>
@endcomponent

@component($typeForm, get_defined_vars())
    <div style="--oi-image-height: {{ $height }}; width: {{ $width }};">
        <figure class="d-block oi-image">
            @include('orchid-images::partials.image')
        </figure>
    
        @if ($caption)
            <figcaption class="text-muted fst-italic text-center">{{ $caption }}</figcaption>
        @endif
    </div>
@endcomponent

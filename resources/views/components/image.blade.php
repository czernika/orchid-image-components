@component($typeForm, get_defined_vars())
    <div style="--oi-image-height: {{ $height }}; --oi-image-width: {{ $width }};">
        <figure class="d-block oi-image">
            @include('orchid-images::partials.image')
    
            @if ($caption)
                <figcaption class="text-center text-muted fst-italic">{{ $caption }}</figcaption>
            @endif
        </figure>
    </div>
@endcomponent

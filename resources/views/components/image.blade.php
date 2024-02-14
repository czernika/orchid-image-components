@component($typeForm, get_defined_vars())
    <div
        class="oi-image"
        style="--oi-image-height: {{ $height }}; --oi-image-width: {{ $width }};"
    >
        @include('orchid-images::partials.image')
    </div>
@endcomponent

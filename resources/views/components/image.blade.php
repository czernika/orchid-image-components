@component($typeForm, get_defined_vars())
    <div class="oi-image" style="--oi-image-height: {{ $height }}; --oi-image-width: {{ $width }};">
        <img
            @class([
                'border rounded w-100 h-100',
                $fit,
            ])
            src="{{ $src }}"
            alt="{{ $alt }}"
        />
    </div>
@endcomponent

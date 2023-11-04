@component($typeForm, get_defined_vars())
    <div class="oi-image" style="height: {{ $height }}; width: {{ $width }};">
        <img
            @class([
                'border rounded',
                $fit,
            ])
            src="{{ $src }}"
            alt="{{ $alt }}"
        />
    </div>
@endcomponent

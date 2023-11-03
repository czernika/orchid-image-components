@component($typeForm, get_defined_vars())
    <div class="oi-image" style="height: {{ $height }};">
        <img
            src="{{ $src }}"
            @class([
                'border rounded',
                $fit,
            ])
            {{ $attributes }}
        />
    </div>
@endcomponent

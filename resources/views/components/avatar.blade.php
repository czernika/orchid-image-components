@component($typeForm, get_defined_vars())
    <div class="avatar" style="height: {{ $size }}; width: {{ $size }};">
        <img
            class="object-fit-cover w-100 h-100"
            src="{{ $src }}"
            alt="{{ $alt }}"
        />
    </div>
@endcomponent

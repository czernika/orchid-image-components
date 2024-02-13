@component($typeForm, get_defined_vars())
    <div class="avatar oi-avatar" style="--oi-avatar-height: {{ $height }}; --oi-avatar-width: {{ $width }};">
        <img
            class="border object-fit-cover w-100 h-100"
            src="{{ $src }}"
            alt="{{ $alt }}"
        />

        @if ($badge !== false)
            <b class="oi-avatar__badge rounded-pill bg-{{ $badgeType }}">
                {{ $badge }}
            </b>
        @endif
    </div>
@endcomponent

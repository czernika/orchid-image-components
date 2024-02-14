@component($typeForm, get_defined_vars())
    <div
        class="avatar oi-avatar"
        style="--oi-avatar-height: {{ $height }}; --oi-avatar-width: {{ $width }};"
    >
        @include('orchid-images::partials.image', ['fit' => 'object-fit-cover'])

        @if ($badge !== false)
            <b class="oi-avatar__badge rounded-pill bg-{{ $badgeType }}">
                {{ $badge }}
            </b>
        @endif
    </div>
@endcomponent

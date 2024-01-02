@component($typeForm, get_defined_vars())
    <ul
        class="list-unstyled oi-gallery"
        style="grid-template-columns: repeat({{ $autoFit === false ? $columns : 'auto-fit' }}, {{ $autoFit === false ? '1fr' : $autoFit }});">
        @forelse ($elements as $item)
            <li class="oi-image" style="height: {{ $height }};">
                <img
                    @class([
                        'border d-block rounded w-100 h-100',
                        $fit,
                    ])
                    src="{{ $item->url() }}"
                    alt="{{ $item->alt }}"
                    title="{{ $item->title }}"
                />
            </li>
        @empty
            <li>{{ $empty }}</li>
        @endforelse
    </ul>
@endcomponent

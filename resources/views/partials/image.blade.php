<img
    @class([
        'd-block w-100 h-100',
        $fit,
    ])
    src="{{ $src }}"
    alt="{{ $alt }}"
    @isset($title)
        title="{{ $title }}"
    @endisset
/>

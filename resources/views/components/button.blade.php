@props([
    'type' => 'button',
    'variant' => 'primary'
])

<button
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' => "nx-btn nx-btn-$variant"
    ]) }}
>
    {{ $slot }}
</button>
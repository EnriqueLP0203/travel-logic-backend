@props(['delay' => 0, 'variant' => 'default'])

@php
$variantClass = $variant === 'subtle' ? 'animate-in-element--subtle' : 'animate-in-element';
@endphp

<div
    data-animate-in
    @if ($delay) data-animate-delay="{{ $delay }}" @endif
    {{ $attributes->merge([
        'class' => $variantClass,
    ]) }}
>
    {{ $slot }}
</div>

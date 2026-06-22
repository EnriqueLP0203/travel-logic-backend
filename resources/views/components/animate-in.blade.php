@props(['delay' => 0])

<div
    data-animate-in
    @if ($delay) data-animate-delay="{{ $delay }}" @endif
    {{ $attributes->merge([
        'class' => 'animate-in-element',
    ]) }}
>
    {{ $slot }}
</div>

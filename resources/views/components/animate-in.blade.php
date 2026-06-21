@props(['delay' => 0])

<div
    data-animate-in
    @if ($delay) data-animate-delay="{{ $delay }}" @endif
    {{ $attributes->merge([
        'class' => 'transition-all duration-700 ease-out motion-reduce:translate-y-0 motion-reduce:opacity-100 motion-reduce:transition-none opacity-0 translate-y-8',
    ]) }}
>
    {{ $slot }}
</div>

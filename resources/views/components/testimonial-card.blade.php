@props([
    'name',
    'quote',
    'rating' => 5,
])

@php
    $isLong = mb_strlen($quote) > 180;
@endphp

<article
    {{ $attributes->merge(['class' => 'flex h-full w-80 shrink-0 snap-start flex-col gap-6 rounded-3xl border border-green-300 p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg sm:w-96 sm:gap-10 sm:p-10']) }}
>
    <header class="flex items-center gap-4">
        <div class="flex size-24 shrink-0 items-center justify-center rounded-full bg-green-300" aria-hidden="true">
            <x-lucide-user class="h-10 w-10 text-white" />
        </div>
        <div>
            <p class="text-xl font-bold font-inter text-blue-400">{{ $name }}</p>
            <div class="mt-1 flex items-center gap-0.5" role="img" aria-label="{{ $rating }} de 5 estrellas">
                @for ($i = 1; $i <= 5; $i++)
                    <x-lucide-star @class([
                        'h-4 w-4',
                        'fill-amber-400 text-amber-400' => $i <= $rating,
                        'text-gray-300' => $i > $rating,
                    ]) />
                @endfor
            </div>
        </div>
    </header>
    <blockquote class="line-clamp-6 text-xl font-light font-inter text-slate-500">{{ $quote }}</blockquote>
    @if ($isLong)
        <button
            type="button"
            x-on:click="openModal({{ \Illuminate\Support\Js::from(['name' => $name, 'quote' => $quote, 'rating' => (int) $rating]) }})"
            class="mt-auto self-start text-sm font-semibold font-inter text-green-300 transition-colors hover:text-green-400"
        >
            Leer más
        </button>
    @endif
</article>

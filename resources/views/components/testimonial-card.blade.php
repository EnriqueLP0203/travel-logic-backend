@props([
    'name',
    'quote',
    'rating' => 5,
])

<article {{ $attributes->merge(['class' => 'flex w-sm flex-col gap-10 rounded-3xl border border-green-300 p-10']) }}>
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
    <blockquote class="text-xl font-light font-inter text-slate-500">{{ $quote }}</blockquote>
</article>

@props([
    'hotel',
])

@php
    $image = $hotel->principalImage;
    $reviewCount = $hotel->approvedReviews()->count();
    $stars = (int) $hotel->star_category;
@endphp

<div class="flex h-[460px] w-96 flex-col overflow-hidden rounded-3xl bg-white shadow-xl transition-all duration-200 hover:scale-[1.02] hover:shadow-2xl">
    {{-- Imagen principal --}}
    <div class="h-72 w-full shrink-0 overflow-hidden bg-gray-200">
        @if ($image && $image->url)
            <img
                src="{{ $image->url }}"
                alt="{{ $hotel->name }}"
                class="h-full w-full object-cover transition-transform duration-300 hover:scale-105"
            />
        @else
            <div class="flex h-full w-full items-center justify-center bg-gray-300">
                <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 9.75L12 3l9 6.75V21a.75.75 0 01-.75.75H3.75A.75.75 0 013 21V9.75z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 21V12h6v9" />
                </svg>
            </div>
        @endif
    </div>

    {{-- Contenido --}}
    <div class="flex flex-1 flex-col px-4 py-5">
        {{-- Nombre --}}
        <p class="line-clamp-2 text-2xl font-bold font-inter leading-snug text-indigo-950">{{ $hotel->name }}</p>

        {{-- Destino --}}
        @if ($hotel->destination)
            <p class="mt-0.5 flex items-center gap-1 text-xs font-medium text-black">
                <x-lucide-map-pin class="size-3.5 shrink-0 text-zinc-500" />
                {{ $hotel->destination->city }}
            </p>
        @endif

        {{-- boton de ver mas --}}
        <div class="mt-auto pt-3 flex justify-end">
            <a
                href="{{ route('hotel.show', $hotel->slug) }}"
                class="inline-flex items-center gap-2 rounded-lg bg-green-300 px-4 py-2 text-base font-bold font-inter text-white"
            >
                Ver más
            </a>
        </div>
    </div>
</div>

@props([
    'hotel',
])

@php
    $image = $hotel->principalImage;
    $reviewCount = $hotel->approvedReviews()->count();
    $stars = (int) $hotel->star_category;
@endphp

<div class="w-full overflow-hidden rounded-2xl bg-white shadow-xl transition-all duration-200 hover:scale-[1.02] hover:shadow-2xl">
    {{-- Imagen principal --}}
    <div class="h-48 w-full overflow-hidden bg-gray-200">
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
    <div class="px-4 py-5">
        {{-- Estrellas --}}
        @if ($stars > 0)
            <div class="mb-1 flex gap-0.5">
                @for ($i = 1; $i <= 5; $i++)
                    <svg
                        class="h-4 w-4 {{ $i <= $stars ? 'text-amber-400' : 'text-gray-300' }}"
                        fill="currentColor" viewBox="0 0 20 20"
                    >
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                @endfor
            </div>
        @endif

        {{-- Nombre --}}
        <p class="text-base font-bold leading-snug text-indigo-950">{{ $hotel->name }}</p>

        {{-- Destino --}}
        @if ($hotel->destination)
            <p class="mt-0.5 text-xs font-medium text-indigo-400">
                {{ $hotel->destination->name ?? '' }}
            </p>
        @endif

        {{-- Reseñas --}}
        <p class="mt-1 text-sm font-normal text-gray-500">
            {{ $reviewCount }} {{ $reviewCount === 1 ? 'reseña' : 'reseñas' }}
        </p>
    </div>
</div>

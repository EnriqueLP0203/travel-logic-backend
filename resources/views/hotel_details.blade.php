@extends('layouts.app')

@section('title', $hotel->name . ' - Travel Logic')

@section('content')
@php
$translation = $hotel->translations->first();
$stars = (int) $hotel->star_category;
$reviews = $hotel->approvedReviews;
$reviewCount = $reviews->count();
$avgRating = $reviewCount > 0 ? round((float) $reviews->avg('rating_overall'), 1) : 0;

$principalImage = $hotel->principalImage;
$mosaicImages = $hotel->gallery
->filter(fn ($img) => ! $img->is_principal)
->values();
$mosaicTotal = $mosaicImages->count();
$hasMorePhotos = $mosaicTotal > 4;
$mosaicSlots = $hasMorePhotos ? $mosaicImages->take(3) : $mosaicImages->take(4);
$remainingPhotos = $hasMorePhotos ? $mosaicTotal - 3 : 0;

$amenities = [];
if ($translation && filled($translation->amenities)) {
$decoded = json_decode($translation->amenities, true);
if (is_array($decoded)) {
$amenities = array_values(array_filter($decoded, fn ($item) => filled($item)));
} else {
$amenities = array_values(array_filter(
array_map('trim', preg_split('/[\n,;]+/', $translation->amenities)),
fn ($item) => filled($item)
));
}
}

@endphp

<div class="mx-auto w-full max-w-[1600px] px-2 pb-10 sm:px-3 md:px-4 lg:px-6 lg:pb-16 mt-24">
    {{-- Encabezado --}}
    <header class="mb-8">
        <h1 class="text-3xl font-bold text-indigo-950 sm:text-4xl">{{ $hotel->name }}</h1>

        <div class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-gray-600">
            @if ($stars > 0)
            <div class="flex items-center gap-1">
                @for ($i = 1; $i <= 5; $i++)
                    <svg
                    class="h-4 w-4 {{ $i <= $stars ? 'text-amber-400' : 'text-gray-300' }}"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    @endfor
            </div>
            @endif

            <span class="text-gray-500">
                {{ number_format($avgRating, 1) }} · {{ $reviewCount }} {{ $reviewCount === 1 ? 'reseña' : 'reseñas' }}
            </span>

            @if ($hotel->destination)
            <span class="flex items-center gap-1 text-indigo-400">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.6423. R 4.5 10.5a7.5 7.5 0 1115 0z" />
                </svg>
                {{ collect([$hotel->destination->city, $hotel->destination->state, $hotel->destination->country])->filter()->implode(', ') }}
            </span>
            @endif
        </div>
    </header>

    {{-- Galería: imagen principal + mosaico 2x2 --}}
    <section class="mb-10 grid grid-cols-1 gap-3 lg:grid-cols-2 lg:gap-4">
        {{-- Imagen principal --}}
        <div class="h-64 overflow-hidden rounded-2xl bg-gray-200 sm:h-80 lg:h-[420px]">
            @if ($principalImage && $principalImage->url)
            <img
                src="{{ $principalImage->url }}"
                alt="{{ $hotel->name }}"
                class="h-full w-full object-cover" />
            @else
            <div class="flex h-full w-full items-center justify-center bg-gray-300">
                <svg class="h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 9.75L12 3l9 6.75V21a.75.75 0 01-.75.75H3.75A.75.75 0 013 21V9.75z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 21V12h6v9" />
                </svg>
            </div>
            @endif
        </div>

        {{-- Mosaico 2x2 --}}
        <div class="grid h-64 grid-cols-2 grid-rows-2 gap-3 sm:h-80 lg:h-[420px]">
            @for ($slot = 0; $slot < 4; $slot++)
                @php
                $isSeeMoreSlot=$hasMorePhotos && $slot===3;
                $image=$isSeeMoreSlot ? null : $mosaicSlots->get($slot);
                @endphp

                <div class="relative overflow-hidden rounded-2xl bg-gray-200">
                    @if ($isSeeMoreSlot)
                    <div class="flex h-full w-full items-center justify-center bg-gray-800/80">
                        <span class="text-lg font-semibold text-white">
                            Ver más @if ($remainingPhotos > 0)(+{{ $remainingPhotos }})@endif
                        </span>
                    </div>
                    @elseif ($image && $image->url)
                    <img
                        src="{{ $image->url }}"
                        alt="{{ $hotel->name }} - imagen {{ $slot + 1 }}"
                        class="h-full w-full object-cover" />
                    @else
                    <div class="flex h-full w-full items-center justify-center bg-gray-300">
                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z" />
                        </svg>
                    </div>
                    @endif
                </div>
                @endfor
        </div>
    </section>

    {{-- Grid de 3 columnas --}}
    <section class="mb-10 grid grid-cols-1 gap-6 lg:grid-cols-3">
        {{-- Col 1: Detalles y Servicios --}}
        <div class="rounded-2xl bg-white p-6 shadow-xl">
            <h2 class="mb-4 text-xl font-bold text-indigo-950">Detalles</h2>
            @if ($translation && filled($translation->description))
            <div class="mb-6 space-y-3 text-sm leading-relaxed text-gray-600 [&_b]:font-semibold [&_b]:text-indigo-950 [&_strong]:font-semibold [&_ul]:list-disc [&_ul]:pl-5">
                {!! $translation->description !!}
            </div>
            @elseif ($translation && filled($translation->short_description))
            <div class="mb-6 space-y-3 text-sm leading-relaxed text-gray-600 [&_b]:font-semibold [&_b]:text-indigo-950 [&_strong]:font-semibold [&_ul]:list-disc [&_ul]:pl-5">
                {!! $translation->short_description !!}
            </div>
            @else
            <p class="mb-6 text-sm italic text-gray-400">Sin descripción disponible.</p>
            @endif

            <h3 class="mb-3 text-lg font-semibold text-indigo-950">Servicios</h3>
            @if (count($amenities) > 0)
            <ul class="space-y-2">
                @foreach ($amenities as $amenity)
                <li class="flex items-start gap-2 text-sm text-gray-600">
                    <svg class="mt-0.5 h-4 w-4 shrink-0 text-green-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ is_string($amenity) ? $amenity : ($amenity['name'] ?? json_encode($amenity)) }}
                </li>
                @endforeach
            </ul>
            @else
            <p class="text-sm italic text-gray-400">Sin servicios registrados.</p>
            @endif
        </div>

        {{-- Col 2: Grupos de hotel y tipos de alojamiento --}}
        <div class="rounded-2xl bg-white p-6 shadow-xl">
            <h2 class="mb-4 text-xl font-bold text-indigo-950">Grupos y tipos</h2>
            <div class="space-y-5">
                @if ($hotel->hotelGroups->isNotEmpty())
                <div>
                    <h3 class="mb-2 text-sm font-semibold uppercase tracking-wide text-indigo-400">
                        Grupos de hotel
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($hotel->hotelGroups as $group)
                        @php
                        $groupName = $group->translations->first()?->name;
                        @endphp
                        @if ($groupName)
                        <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-medium text-indigo-700">
                            {{ $groupName }}
                        </span>
                        @endif
                        @endforeach
                    </div>
                </div>
                @endif

                @if ($hotel->accommodationTypes->isNotEmpty())
                <div>
                    <h3 class="mb-2 text-sm font-semibold uppercase tracking-wide text-indigo-400">
                        Tipos de alojamiento
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($hotel->accommodationTypes as $type)
                        @php
                        $typeName = $type->translations->first()?->name;
                        @endphp
                        @if ($typeName)
                        <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-medium text-indigo-700">
                            {{ $typeName }}
                        </span>
                        @endif
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- Col 3: Calificaciones --}}
        <div class="rounded-2xl bg-white p-6 shadow-xl">
            <h2 class="mb-4 text-xl font-bold text-indigo-950">Calificaciones</h2>
            <div class="flex flex-col items-center justify-center py-6 text-center">
                <p class="text-5xl font-bold text-indigo-950">{{ number_format($avgRating, 1) }}</p>
                <div class="mt-2 flex gap-0.5">
                    @for ($i = 1; $i <= 5; $i++)
                        <svg
                        class="h-6 w-6 {{ $i <= round($avgRating) ? 'text-amber-400' : 'text-gray-300' }}"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        @endfor
                </div>
                <p class="mt-3 text-sm text-gray-500">
                    Basado en {{ $reviewCount }} {{ $reviewCount === 1 ? 'reseña' : 'reseñas' }}
                </p>
            </div>
        </div>
    </section>

    {{-- Opiniones --}}
    <section class="rounded-2xl bg-white p-6 shadow-xl">
        <h2 class="mb-6 text-xl font-bold text-indigo-950">Opiniones</h2>

        {{-- Formulario visual (sin persistencia) --}}
        <div class="mb-8 rounded-xl border border-dashed border-gray-300 bg-gray-50 p-6">
            <h3 class="mb-4 text-lg font-semibold text-indigo-950">Deja tu opinión</h3>
            <form class="space-y-4" onsubmit="return false;">
                <div>
                    <label for="reviewer_name" class="mb-1 block text-sm font-medium text-gray-700">Nombre</label>
                    <input
                        type="text"
                        id="reviewer_name"
                        name="reviewer_name"
                        placeholder="Tu nombre"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-green-1 focus:outline-none focus:ring-1 focus:ring-green-1" />
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">Calificación</label>
                    <div class="flex gap-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <button
                            type="button"
                            class="text-amber-400 transition-colors hover:text-amber-500"
                            aria-label="{{ $i }} estrellas">
                            <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            </button>
                            @endfor
                    </div>
                </div>

                <div>
                    <label for="review_text" class="mb-1 block text-sm font-medium text-gray-700">Comentario</label>
                    <textarea
                        id="review_text"
                        name="review_text"
                        rows="4"
                        placeholder="Cuéntanos tu experiencia..."
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-green-1 focus:outline-none focus:ring-1 focus:ring-green-1"></textarea>
                </div>

                <button
                    type="button"
                    class="rounded-full bg-green-1 px-6 py-2.5 text-sm font-semibold text-white transition-opacity hover:opacity-90">
                    Enviar opinión
                </button>
            </form>
        </div>

        {{-- Listado de reseñas aprobadas --}}
        @if ($reviews->isNotEmpty())
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-indigo-950">Reseñas de viajeros</h3>
            @foreach ($reviews as $review)
            <article class="rounded-xl border border-gray-100 bg-gray-50 p-4">
                <div class="mb-2 flex items-center justify-between">
                    <p class="font-semibold text-indigo-950">
                        {{ $review->traveler?->first_name ?? 'Viajero' }}
                    </p>
                    <div class="flex items-center gap-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg
                            class="h-4 w-4 {{ $i <= round($review->rating_overall) ? 'text-amber-400' : 'text-gray-300' }}"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            @endfor
                    </div>
                </div>
                <p class="text-sm leading-relaxed text-gray-600">{{ $review->review_text }}</p>
            </article>
            @endforeach
        </div>
        @else
        <p class="text-sm italic text-gray-400">Aún no hay reseñas para este hotel.</p>
        @endif
    </section>
</div>
@endsection
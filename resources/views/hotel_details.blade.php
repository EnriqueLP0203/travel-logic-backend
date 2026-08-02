@extends('layouts.app')

@section('title', $hotel->name . ' - Travel Logic')

@section('content')
@php
$translation = $hotel->translations->first();

$principalImage = $hotel->principalImage;
$mosaicImages = $hotel->gallery
    ->filter(fn ($img) => ! $img->is_principal)
    ->values();
$mosaicTotal = $mosaicImages->count();
$hasMorePhotos = $mosaicTotal > 4;
$mosaicSlots = $hasMorePhotos ? $mosaicImages->take(3) : $mosaicImages->take(4);
$remainingPhotos = $hasMorePhotos ? $mosaicTotal - 3 : 0;

$location = $hotel->destination
    ? collect([$hotel->destination->city, $hotel->destination->state, $hotel->destination->country])->filter()->implode(', ')
    : null;
@endphp

<div class="mx-auto mt-24 w-full max-w-[1600px] px-2 pb-10 sm:px-3 md:px-4 lg:px-6 lg:pb-16">
    {{-- Encabezado --}}
    <header class="mb-8">
        <p class="mb-3.5 text-xs font-semibold text-gray-400 sm:text-sm">
            <a href="{{ route('hotels') }}" class="transition-colors hover:text-blue-300">Hoteles</a>
            <span class="mx-1">/</span>
            <span class="text-blue-300">{{ $hotel->name }}</span>
        </p>

        <div class="flex flex-wrap items-baseline justify-between gap-3.5">
            <h1 class="text-3xl font-extrabold text-blue-300 sm:text-4xl">{{ $hotel->name }}</h1>

            @if ($location)
            <span class="flex items-center gap-2 text-sm font-medium text-gray-500 sm:text-base">
                <span class="size-1.5 shrink-0 rounded-full bg-green-300"></span>
                {{ $location }}
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
                $isSeeMoreSlot = $hasMorePhotos && $slot === 3;
                $image = $isSeeMoreSlot ? null : $mosaicSlots->get($slot);
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

    {{-- Detalles + Grupos / Tipos --}}
    <section class="mb-10 grid grid-cols-1 items-start gap-7 lg:grid-cols-[1.4fr_1fr]">
        {{-- Columna izquierda: Detalles --}}
        <div>
            <h2 class="mb-4 text-xl font-extrabold text-blue-300">Detalles del hotel</h2>
            @if ($translation && filled($translation->description))
            <div class="text-sm leading-relaxed text-gray-600 [&_b]:font-semibold [&_b]:text-blue-300 [&_strong]:font-semibold [&_ul]:list-disc [&_ul]:pl-5">
                {!! $translation->description !!}
            </div>
            @elseif ($translation && filled($translation->short_description))
            <div class="text-sm leading-relaxed text-gray-600 [&_b]:font-semibold [&_b]:text-blue-300 [&_strong]:font-semibold [&_ul]:list-disc [&_ul]:pl-5">
                {!! $translation->short_description !!}
            </div>
            @else
            <p class="text-sm italic text-gray-400">Sin descripción disponible.</p>
            @endif
        </div>

        {{-- Columna derecha: dos tarjetas apiladas --}}
        <div class="space-y-5">
            <div class="rounded-2xl border border-[#eef3e9] bg-[#f8faf6] p-6">
                <h2 class="mb-4 text-xl font-extrabold text-blue-300">Grupos de hotel</h2>
                @if ($hotel->hotelGroups->isNotEmpty())
                <div class="flex flex-wrap gap-2.5">
                    @foreach ($hotel->hotelGroups as $group)
                        @php
                        $groupName = $group->translations->first()?->name;
                        @endphp
                        @if ($groupName)
                        <span class="inline-flex rounded-full bg-[#eef3e9] px-4 py-2 text-sm font-semibold text-[#3f6d1f]">
                            {{ $groupName }}
                        </span>
                        @endif
                    @endforeach
                </div>
                @else
                <p class="text-sm italic text-gray-400">Sin grupos registrados.</p>
                @endif
            </div>

            <div class="rounded-2xl border border-[#eef3e9] bg-[#f8faf6] p-6">
                <h2 class="mb-4 text-xl font-extrabold text-blue-300">Tipos de alojamiento</h2>
                @if ($hotel->accommodationTypes->isNotEmpty())
                <div class="flex flex-wrap gap-2.5">
                    @foreach ($hotel->accommodationTypes as $type)
                        @php
                        $typeName = $type->translations->first()?->name;
                        @endphp
                        @if ($typeName)
                        <span class="inline-flex rounded-full bg-[#eef3e9] px-4 py-2 text-sm font-semibold text-[#3f6d1f]">
                            {{ $typeName }}
                        </span>
                        @endif
                    @endforeach
                </div>
                @else
                <p class="text-sm italic text-gray-400">Sin tipos de alojamiento registrados.</p>
                @endif
            </div>
        </div>
    </section>
</div>

{{-- Banner CTA — ancho completo --}}
<section class="relative w-full overflow-hidden bg-blue-400 py-12 sm:py-24">
    <div class="relative mx-auto w-full max-w-[1600px] px-2 sm:px-3 md:px-4 lg:px-6">
        <div class="flex flex-col items-start justify-between gap-8 px-6 sm:px-8 lg:flex-row lg:items-center lg:px-10">
            <div class="max-w-2xl">
                <span class="mb-4 inline-block rounded-md bg-green-300/15 px-3.5 py-1.5 text-xs font-bold uppercase tracking-wider text-green-200">
                    Para agencias
                </span>
                <h2 class="mb-3 text-2xl font-extrabold leading-snug text-white sm:text-6xl">
                    Trabaja este hotel con tarifas de convenio
                </h2>
                <p class="text-sm leading-relaxed text-white/70 sm:text-xl">
                    Travel Logic cuenta con convenios directos con este hotel y otros destinos, con condiciones preferenciales para que tu agencia revenda experiencias memorables a sus clientes.
                </p>
            </div>

            <a
                href="{{ route('register-agency') }}"
                class="relative shrink-0 rounded-lg bg-green-300 px-7 py-3.5 text-xl font-bold text-white transition-opacity hover:opacity-90">
                Regístrate
            </a>
        </div>
    </div>
</section>

{{-- Mismo formulario de contacto (interested_clients) — fondo blanco, ancho completo --}}
<section id="contacto" aria-label="Formulario de contacto" class="w-full bg-white">
    <div class="mx-auto w-full max-w-[1600px] px-2 sm:px-3 md:px-4 lg:px-6">
        <x-interested-client-contact-section />
    </div>
</section>
@endsection

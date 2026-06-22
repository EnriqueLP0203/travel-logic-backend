@extends('layouts.app')

@section('title', 'Destinos - Travel Logic')

@section('content')

<div class="mx-auto w-full max-w-[1600px] px-2 pb-10 sm:px-3 md:px-4 lg:px-6 lg:pb-16">

    {{-- Banner --}}
    <x-animate-in>
        <div class="mb-8 overflow-hidden rounded-lg sm:mb-10 md:mb-12">
            <div class="h-48 w-full bg-gray-300 sm:h-56 md:h-64 lg:h-80"></div>
        </div>
    </x-animate-in>

    {{-- Listado de destinos --}}
    <section aria-label="Listado de destinos" class="mb-10 md:mb-14 lg:mb-20">
        <x-animate-in>
            <h2 class="mb-4 text-center text-3xl font-bold text-indigo-950 sm:mb-6 sm:text-4xl lg:text-5xl">
                Destinos
            </h2>
        </x-animate-in>
        <x-animate-in delay="100">
            <p class="mx-auto mb-8 max-w-3xl text-center text-base font-normal text-stone-900 sm:mb-10 sm:text-lg lg:text-xl">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Bibendum amet
                at molestie mattis.
            </p>
        </x-animate-in>

        {{-- Cards de destinos --}}
        @php
        $destinations = [
        ['title' => 'Familiar', 'delay' => 120],
        ['title' => 'Deportivos', 'delay' => 200],
        ['title' => 'Eventos', 'delay' => 280],
        ['title' => 'Lifestyle & Wellness','delay' => 360],
        ];
        @endphp

        <div class="grid w-full grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-6 lg:grid-cols-4">
            @foreach ($destinations as $dest)
            <x-animate-in delay="{{ $dest['delay'] }}">
                <div class="flex flex-col overflow-hidden rounded-lg border border-indigo-950/20 transition-transform duration-300 hover:scale-[1.02] motion-reduce:transition-none">
                    {{-- Imagen placeholder --}}
                    <div class="h-48 w-full bg-gray-300"></div>

                    {{-- Contenido --}}
                    <div class="flex flex-1 flex-col gap-3 p-4 sm:p-5">
                        <h3 class="text-xl font-bold text-indigo-950 sm:text-2xl">
                            {{ $dest['title'] }}
                        </h3>
                        <p class="flex-1 text-base font-normal text-stone-900 sm:text-lg">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Bibendum amet at molestie mattis.
                        </p>
                        <button
                            type="button"
                            class="mt-2 w-fit rounded-full bg-green-1 px-5 py-2 text-sm font-semibold text-white transition-opacity hover:opacity-90 sm:text-base">
                            Más información
                        </button>
                    </div>
                </div>
            </x-animate-in>
            @endforeach
        </div>

        {{-- Botón Ver más --}}
        <div class="mt-8 flex justify-center sm:mt-10">
            <x-animate-in delay="200">
                <a
                    href="{{ route('hotels') }}"
                    class="rounded-full bg-green-1 px-8 py-3 text-sm font-semibold text-white transition-opacity hover:opacity-90 sm:text-base">
                    Ver más
                </a>
            </x-animate-in>
        </div>
    </section>

    {{-- Destino destacado 1 (texto izquierda / imagen derecha) --}}
    <section aria-label="Destino destacado" class="mb-10 md:mb-14 lg:mb-20">
        <div class="flex w-full flex-col items-stretch gap-8 lg:flex-row lg:items-center lg:justify-between lg:gap-12 xl:gap-16">
            <x-animate-in class="flex w-full flex-1 flex-col gap-4 lg:max-w-2xl">
                <p class="text-sm font-semibold text-emerald-500 sm:text-base">CAPTION</p>
                <h3 class="text-start text-3xl font-bold text-indigo-950 sm:text-4xl lg:text-5xl">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Bibendum amet at molestie mattis.
                </h3>
                <p class="text-start text-base font-normal text-stone-900 sm:text-lg lg:text-xl">
                    Rhoncus morbi et augue nec, in id ullamcorper at sit. Condimentum sit nunc
                    in eros scelerisque sed. Commodo in viverra nunc, ullamcorper ut. Non, amet,
                    aliquet scelerisque nullam sagittis, pulvinar.
                </p>
                <button
                    type="button"
                    class="w-fit rounded-full bg-green-1 px-6 py-3 text-sm font-semibold text-white transition-opacity hover:opacity-90 sm:text-base">
                    Primary Action
                </button>
            </x-animate-in>

            <x-animate-in delay="180" class="w-full shrink-0 overflow-hidden rounded-lg lg:w-[min(100%,520px)] lg:flex-1">
                <div class="h-56 w-full bg-gray-300 transition-transform duration-500 ease-out hover:scale-[1.02] motion-reduce:transition-none sm:h-64 lg:h-80"></div>
            </x-animate-in>
        </div>
    </section>

    {{-- Destino destacado 2 (imagen izquierda / texto derecha) --}}
    <section aria-label="Otro destino destacado" class="mb-10 md:mb-14 lg:mb-16">
        <div class="flex w-full flex-col-reverse items-stretch gap-8 lg:flex-row lg:items-center lg:justify-between lg:gap-12 xl:gap-16">
            <x-animate-in delay="180" class="w-full shrink-0 overflow-hidden rounded-lg lg:w-[min(100%,520px)] lg:flex-1">
                <div class="h-56 w-full bg-gray-300 transition-transform duration-500 ease-out hover:scale-[1.02] motion-reduce:transition-none sm:h-64 lg:h-80"></div>
            </x-animate-in>

            <x-animate-in class="flex w-full flex-1 flex-col gap-4 lg:max-w-2xl">
                <p class="text-sm font-semibold text-emerald-500 sm:text-base">CAPTION</p>
                <h3 class="text-start text-3xl font-bold text-indigo-950 sm:text-4xl lg:text-5xl">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Bibendum amet at molestie mattis.
                </h3>
                <p class="text-start text-base font-normal text-stone-900 sm:text-lg lg:text-xl">
                    Rhoncus morbi et augue nec, in id ullamcorper at sit. Condimentum sit nunc
                    in eros scelerisque sed. Commodo in viverra nunc, ullamcorper ut. Non, amet,
                    aliquet scelerisque nullam sagittis, pulvinar.
                </p>
                <button
                    type="button"
                    class="w-fit rounded-full bg-green-1 px-6 py-3 text-sm font-semibold text-white transition-opacity hover:opacity-90 sm:text-base">
                    Primary Action
                </button>
            </x-animate-in>
        </div>
    </section>

</div>

@endsection
@extends('layouts.app')

@section('title', 'Home Travel Logic Backend')

@section('content')

{{-- Hero --}}
<x-animate-in>
    <div class="relative mb-12 flex min-h-[70vh] flex-col justify-center gap-5 overflow-hidden px-6 py-12 sm:min-h-[80vh] sm:px-8 sm:py-16 md:px-16 lg:min-h-screen lg:px-24">
        <img
            src="{{ asset('images/home/bg-1.webp') }}"
            alt=""
            class="absolute inset-0 h-full w-full object-cover"
            aria-hidden="true" />

        <div class="absolute inset-0 bg-black/50" aria-hidden="true"></div>

        <p class="ml-24 relative z-10 max-w-xl text-6xl font-black font-montserrat leading-tight text-white">
            El socio estratégico que tu agencia necesita
        </p>
        <p class="ml-24 mb-4 relative z-10 max-w-xl text-base font-normal text-white/90 sm:text-lg md:text-xl">
            Soluciones integrales y personalizadas bajo el modelo que simplifican tu operación y te permiten ofrecer experiencias memorables a tus clientes.
        </p>
        <div class="ml-24 flex items-center gap-2">
            <button
                type="button"
                class="flex items-center gap-2 relative z-10 w-fit rounded-lg bg-green-400 px-6 py-3 text-base font-bold text-white transition-opacity hover:opacity-90">
                Acceder al portal
                <x-lucide-arrow-right class="h-4 w-4 text-white" />

            </button>
            <button
                type="button"
                class="relative z-10 w-fit rounded-lg border border-white px-6 py-3 text-base font-semibold text-white transition-opacity hover:opacity-90">
                Quiero registrarme
            </button>
        </div>
    </div>
</x-animate-in>

<div class="font-sans antialiased bg-white text-stone-900 mx-auto w-full max-w-[1600px] px-2 sm:px-3 md:px-4 lg:px-6">
    {{-- Recomendaciones --}}
    <section id="recomendaciones" aria-label="Recomendaciones" class="mb-10 md:mb-14 lg:mb-20">
        <x-animate-in>
            <h2 class="mb-6 text-center text-3xl font-bold text-indigo-950 sm:text-4xl lg:mb-8 lg:text-5xl">
                RECOMENDACIONES
            </h2>
        </x-animate-in>

        <div class="mb-8 flex w-full flex-col gap-4 sm:mb-10 sm:gap-6 md:mb-12 md:flex-row lg:mb-14">
            <x-animate-in delay="100" class="aspect-square flex-1 overflow-hidden rounded-lg">
                <img
                    src="{{ asset('images/home/frame1.webp') }}"
                    alt="Frame 1"
                    class="h-full w-full object-cover transition-transform duration-500 ease-out hover:scale-105 motion-reduce:transition-none" />
            </x-animate-in>
            <x-animate-in delay="200" class="aspect-square flex-1 overflow-hidden rounded-lg">
                <img
                    src="{{ asset('images/home/frame2.webp') }}"
                    alt="Frame 2"
                    class="h-full w-full object-cover transition-transform duration-500 ease-out hover:scale-105 motion-reduce:transition-none" />
            </x-animate-in>
            <x-animate-in delay="300" class="aspect-square flex-1 overflow-hidden rounded-lg">
                <img
                    src="{{ asset('images/home/frame3.webp') }}"
                    alt="Frame 3"
                    class="h-full w-full object-cover transition-transform duration-500 ease-out hover:scale-105 motion-reduce:transition-none" />
            </x-animate-in>
        </div>

        <x-animate-in delay="120">
            <div class="flex w-full justify-center">
                <div class="grid w-full grid-cols-1 gap-6 rounded-lg bg-emerald-500/20 p-6 sm:grid-cols-3 sm:gap-8 sm:p-8 md:gap-10 lg:h-72 lg:items-center">
                    <div class="flex h-40 flex-col items-center justify-center rounded-lg border border-emerald-500 bg-white p-4 transition-transform duration-500 ease-out hover:scale-[1.02] motion-reduce:transition-none">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-10 w-10 text-emerald-500" aria-hidden="true">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M8 14s1.5 2 4 2 4-2 4-2" />
                            <line x1="9" x2="9.01" y1="9" y2="9" />
                            <line x1="15" x2="15.01" y1="9" y2="9" />
                        </svg>
                        <p class="text-xl font-bold sm:text-2xl">250+</p>
                        <p class="text-base font-normal sm:text-lg lg:text-xl">Happy Customers</p>
                    </div>
                    <div class="flex h-40 flex-col items-center justify-center rounded-lg border border-emerald-500 bg-white p-4 transition-transform duration-500 ease-out hover:scale-[1.02] motion-reduce:transition-none">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-10 w-10 text-emerald-500" aria-hidden="true">
                            <rect width="14" height="14" x="8" y="8" rx="2" ry="2" />
                            <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2" />
                        </svg>
                        <p class="text-xl font-bold sm:text-2xl">600+</p>
                        <p class="text-base font-normal sm:text-lg lg:text-xl">Projects Completed</p>
                    </div>
                    <div class="flex h-40 flex-col items-center justify-center rounded-lg border border-emerald-500 bg-white p-4 transition-transform duration-500 ease-out hover:scale-[1.02] motion-reduce:transition-none">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-10 w-10 text-emerald-500" aria-hidden="true">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                        <p class="text-xl font-bold sm:text-2xl">11k+</p>
                        <p class="text-base font-normal sm:text-lg lg:text-xl">Subscribers</p>
                    </div>
                </div>
            </div>
        </x-animate-in>
    </section>

    {{-- Features --}}
    <section id="features" aria-label="Features" class="mb-10 md:mb-14 lg:mb-20">
        <div class="flex flex-col items-stretch gap-10 lg:flex-row lg:items-center lg:justify-between lg:gap-12 xl:gap-16">
            <x-animate-in class="flex w-full flex-1 flex-col gap-4 lg:max-w-2xl">
                <p class="mb-6 text-start text-3xl font-bold text-indigo-950 sm:text-4xl lg:mb-8 lg:text-5xl">TITLE</p>
                <p class="text-start text-base font-normal text-stone-900 sm:text-lg lg:text-xl">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In quis blandit lorem. In quis turpis congue, accumsan lacus eu, mollis arcu. Fusce finibus nec elit a semper. Vivamus auctor pulvinar tincidunt. Nunc lacinia urna velit, quis fringilla dui vulputate egestas. Quisque lobortis ex eget magna pretium, nec cursus felis lacinia. Nam accumsan ante sed libero tincidunt faucibus. Duis nec erat diam. Aenean dui nunc, pretium et semper vulputate, mattis in purus. Donec luctus rutrum faucibus.
                </p>
                <p class="text-start text-base font-normal text-stone-900 sm:text-lg lg:text-xl">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In quis blandit lorem. In quis turpis congue, accumsan lacus eu, mollis arcu. Fusce finibus nec elit a semper. Vivamus auctor pulvinar tincidunt. Nunc lacinia urna velit, quis fringilla dui vulputate egestas. Quisque lobortis ex eget magna pretium, nec cursus felis lacinia. Nam accumsan ante sed libero tincidunt faucibus. Duis nec erat diam. Aenean dui nunc, pretium et semper vulputate, mattis in purus. Donec luctus rutrum faucibus.
                </p>
            </x-animate-in>
            <x-animate-in delay="180" class="w-full shrink-0 overflow-hidden rounded-lg lg:w-[min(100%,520px)] lg:flex-1">
                <img
                    src="{{ asset('images/home/frame4.webp') }}"
                    alt="Frame 4"
                    class="h-full w-full object-cover transition-transform duration-500 ease-out hover:scale-[1.02] motion-reduce:transition-none" />
            </x-animate-in>
        </div>
    </section>

    {{-- Ventajas --}}
    <section id="ventajas" aria-label="Ventajas" class="mb-10 md:mb-14 lg:mb-20">
        <div class="flex w-full flex-col items-center justify-center rounded-lg border border-emerald-500 p-4 sm:p-6 md:p-8">
            <x-animate-in>
                <p class="mb-6 mt-1 text-center text-3xl font-bold text-indigo-950 sm:mb-8 sm:text-4xl lg:text-5xl">
                    PORQUE VIAJAR CON TRAVEL LOGIC
                </p>
            </x-animate-in>

            <div class="flex w-full flex-col items-center gap-8 py-4 sm:gap-10 lg:flex-row lg:items-center lg:justify-center lg:gap-6 xl:gap-8">
                <x-animate-in delay="100" class="flex shrink-0 flex-col items-center justify-center gap-4 sm:gap-5">
                    <div class="size-32 shrink-0 overflow-hidden rounded-full sm:size-36 lg:size-40">
                        <img
                            src="{{ asset('images/home/frame1.webp') }}"
                            alt="Frame 1"
                            class="aspect-square h-full w-full object-cover transition-transform duration-500 ease-out hover:scale-105 motion-reduce:transition-none" />
                    </div>
                    <p class="text-center text-lg font-normal text-indigo-950 sm:text-xl lg:text-2xl">VENTAJA</p>
                </x-animate-in>

                <div class="hidden h-1 w-12 shrink-0 bg-emerald-500 lg:block lg:w-16 xl:w-20" aria-hidden="true"></div>

                <x-animate-in delay="220" class="flex shrink-0 flex-col items-center justify-center gap-4 sm:gap-5">
                    <div class="size-32 shrink-0 overflow-hidden rounded-full sm:size-36 lg:size-40">
                        <img
                            src="{{ asset('images/home/frame2.webp') }}"
                            alt="Frame 2"
                            class="aspect-square h-full w-full object-cover transition-transform duration-500 ease-out hover:scale-105 motion-reduce:transition-none" />
                    </div>
                    <p class="text-center text-lg font-normal text-indigo-950 sm:text-xl lg:text-2xl">VENTAJA</p>
                </x-animate-in>

                <div class="hidden h-1 w-12 shrink-0 bg-emerald-500 lg:block lg:w-16 xl:w-20" aria-hidden="true"></div>

                <x-animate-in delay="340" class="flex shrink-0 flex-col items-center justify-center gap-4 sm:gap-5">
                    <div class="size-32 shrink-0 overflow-hidden rounded-full sm:size-36 lg:size-40">
                        <img
                            src="{{ asset('images/home/frame3.webp') }}"
                            alt="Frame 3"
                            class="aspect-square h-full w-full object-cover transition-transform duration-500 ease-out hover:scale-105 motion-reduce:transition-none" />
                    </div>
                    <p class="text-center text-lg font-normal text-indigo-950 sm:text-xl lg:text-2xl">VENTAJA</p>
                </x-animate-in>
            </div>
        </div>
    </section>

    {{-- About --}}
    <section id="about" aria-label="About" class="mb-10 md:mb-14 lg:mb-20">
        <x-animate-in>
            <div class="relative overflow-hidden rounded-lg">
                <img
                    src="{{ asset('images/home/bg2.webp') }}"
                    alt=""
                    class="block h-auto min-h-[280px] w-full object-cover sm:min-h-[360px] lg:min-h-[420px]"
                    aria-hidden="true" />

                <div class="absolute inset-0 bg-black/60" aria-hidden="true"></div>

                <div class="absolute inset-0 flex flex-col items-center justify-center gap-5 px-6 py-12 sm:px-8 sm:py-16">
                    <p class="mb-6 text-center text-3xl font-bold text-white sm:mb-8 sm:text-4xl md:text-5xl lg:mb-10 lg:text-6xl">
                        ACERCA DE TRAVEL LOGICS
                    </p>
                    <button
                        type="button"
                        class="rounded-full bg-green-1 px-8 py-3 text-base font-semibold text-white transition-opacity hover:opacity-90 sm:px-12 sm:text-lg lg:text-xl">
                        VER MAS
                    </button>
                </div>
            </div>
        </x-animate-in>
    </section>
</div>

<x-contact-form />

@endsection
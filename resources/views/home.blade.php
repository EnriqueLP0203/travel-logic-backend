@extends('layouts.app')

@section('title', 'Home Travel Logic Backend')

@section('content')

{{-- Hero + filtro flotante entre secciones --}}
<div class="relative">
    <x-animate-in>
        <div class="relative flex min-h-[70vh] flex-col justify-center gap-5 overflow-hidden px-6 py-12 sm:min-h-[80vh] sm:px-8 sm:py-16 md:px-16 lg:min-h-screen lg:px-24">
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
                    typCrucerose="button"
                    class="flex items-center gap-2 relative z-10 w-fit rounded-lg bg-green-300 px-6 py-3 text-base font-bold text-white transition-opacity hover:opacity-90">
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

    <div class="pointer-events-none absolute inset-x-0 bottom-0 z-20 translate-y-1/2 px-2 sm:px-3 md:px-4 lg:px-6">
        <div class="pointer-events-auto mx-auto w-full max-w-[1600px]">
            <x-home-filter-info />
        </div>
    </div>
</div>


<div class="font-sans antialiased bg-white text-stone-900 mx-auto w-full max-w-[1600px] px-2 pt-28 sm:px-3 sm:pt-32 md:px-4 md:pt-36 lg:px-6 lg:pt-40">
    {{-- key features --}}
    <section id="key-features" aria-label="Key Features" class="mb-10 md:mb-14 lg:mb-20">
        <div class="flex flex-col items-stretch gap-10 lg:flex-row lg:items-center lg:justify-between lg:gap-12 xl:gap-16">
            <div class="flex flex-col items-center gap-2">
                <div class="size-16 bg-green-100 rounded-lg flex items-center justify-center">
                    <x-lucide-plane-takeoff class="h-10 w-10 text-green-300" />
                </div>
                <p class="w-72 text-center text-2xl font-extrabold font-inter text-indigo-950">Liberar el potencial de cada agencia</p>
                <p class="w-72 text-center text-base font-medium text-zinc-500">Proporcionamos acceso a soluciones integrales y personalizadas que simplifican su operación y les permiten ofrecer experiencias memorables a sus clientes finales.</p>
            </div>

            <div class="flex flex-col items-center gap-4">
                <div class="size-16 bg-green-100 rounded-lg flex items-center justify-center">
                    <x-lucide-plane-takeoff class="h-10 w-10 text-green-300" />
                </div>
                <p class="w-72 text-center text-2xl font-extrabold font-inter text-indigo-950">El operador turístico líder del mercado</p>
                <p class="w-72 text-center text-base font-medium text-zinc-500">Ser reconocidos como el socio estratégico de referencia para agencias de viajes mediante nuestro enfoque de.</p>
            </div>

            <div class="flex flex-col items-center gap-4">
                <div class="size-16 bg-green-100 rounded-lg flex items-center justify-center">
                    <x-lucide-plane-takeoff class="h-10 w-10 text-green-300" />
                </div>
                <p class="w-72 text-center text-2xl font-extrabold font-inter text-indigo-950">Tu socio estratégico B2B</p>
                <p class="w-72 text-center text-base font-medium text-zinc-500">Tour operador especializado en el mercado B2B que conecta agencias con una amplia red de servicios hoteleros, mejorando su eficiencia y garantizando experiencias de viaje memorables</p>
            </div>
        </div>

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
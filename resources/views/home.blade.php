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
</div>

{{-- Features --}}
<section id="features" aria-label="Features" class="w-full bg-blue-400">
    <div class="grid min-h-[420px] grid-cols-1 lg:grid-cols-2 lg:min-h-[520px]">
        <div class="flex flex-col justify-center gap-6 px-6 py-12 sm:px-8 sm:py-16 md:px-16 lg:px-24 xl:px-32">
            <p class="text-sm font-extrabold font-inter text-green-300">¿Por qué Travel Logic?</p>
            <div class="flex flex-col gap-4">
                <p class="text-2xl font-bold font-inter text-white sm:text-3xl lg:text-4xl">Todo lo que tu agencia necesita</p>
                <div class="h-1 w-12 bg-green-300" aria-hidden="true"></div>
            </div>
            <p class="max-w-xl text-base font-normal font-inter text-white">Plataforma B2B diseñada por expertos bajo el modelo One Stop Shop para impulsar las ventas de tu agencia.</p>
            <div class="flex flex-col gap-6">
                <div class="flex items-start gap-4">
                    <div class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-green-300">
                        <p class="text-2xl font-normal font-inter text-white">1</p>
                    </div>
                    <div>
                        <p class="text-base font-bold font-inter text-white">Portal B2B Exclusivo</p>
                        <p class="text-xs font-normal font-inter text-white/90">Plataforma 100% diseñada para agencias. Consulta disponibilidad, cotiza y reserva en tiempo real, las 24 horas del día.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-green-300">
                        <p class="text-2xl font-normal font-inter text-white">2</p>
                    </div>
                    <div>
                        <p class="text-base font-bold font-inter text-white">Tarifas Netas Garantizadas</p>
                        <p class="text-xs font-normal font-inter text-white/90">Precios de mayorista en más de 500 hoteles y paquetes en México, el Caribe y destinos internacionales seleccionados.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-green-300">
                        <p class="text-2xl font-normal font-inter text-white">3</p>
                    </div>
                    <div>
                        <p class="text-base font-bold font-inter text-white">Cotizador con tu Marca</p>
                        <p class="text-xs font-normal font-inter text-white/90">Genera propuestas con el logo y datos de tu agencia, listas para enviar a tus clientes al instante vía PDF o correo.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-green-300">
                        <p class="text-2xl font-normal font-inter text-white">4</p>
                    </div>
                    <div>
                        <p class="text-base font-bold font-inter text-white">Herramientas de Marketing</p>
                        <p class="text-xs font-normal font-inter text-white/90">Descarga flyers y materiales promocionales personalizados para impulsar tus ventas en redes sociales y WhatsApp.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-green-300">
                        <p class="text-2xl font-normal font-inter text-white">5</p>
                    </div>
                    <div>
                        <p class="text-base font-bold font-inter text-white">Herramientas de Marketing</p>
                        <p class="text-xs font-normal font-inter text-white/90">Plataforma 100% diseñada para agencias. Consulta disponibilidad, cotiza y reserva en tiempo real, las 24 horas del día.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-green-300">
                        <p class="text-2xl font-normal font-inter text-white">6</p>
                    </div>
                    <div>
                        <p class="text-base font-bold font-inter text-white">Portal B2B Exclusivo</p>
                        <p class="text-xs font-normal font-inter text-white/90">Plataforma 100% diseñada para agencias. Consulta disponibilidad, cotiza y reserva en tiempo real, las 24 horas del día.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-center px-6 py-12 sm:px-8 lg:px-12 lg:py-16">
            <img
                src="{{ asset('images/home/keys.webp') }}"
                alt="Todo lo que tu agencia necesita"
                width="560"
                height="575"
                class="h-auto w-2xl object-contain" />
        </div>
    </div>
</section>

<!-- seccion portafolio de hoteles -->
<section id="portfolio-hotels" aria-label="Portfolio Hotels" class="w-full bg-white mt-10 px-24">
    <div class="flex flex-col items-start gap-3">
        <p class="text-sm font-extrabold font-inter text-green-300">Nuestro portafolio</p>
        <p class="text-4xl font-black font-inter text-indigo-950">Destinos que venden solos</p>
        <div class="w-12 h-1 bg-green-300" aria-hidden="true"></div>
    </div>

    <div class="flex flex-row gap-4 mt-10">
        <div class="w-md h-132 p-10 bg-gray-400 rounded-3xl"></div>
        <div class="w-md h-132 p-10 bg-gray-400 rounded-3xl"></div>
        <div class="w-md h-132 p-10 bg-gray-400 rounded-3xl"></div>
        <div class="w-md h-132 p-10 bg-gray-400 rounded-3xl"></div>
    </div>

</section>

<section id="steps" aria-label="Cómo empezar" class="w-full bg-blue-400 mt-20">
    <div class="grid grid-cols-1 gap-10 px-6 py-12 sm:px-8 sm:py-16 md:px-16 lg:grid-cols-2 lg:gap-16 lg:px-24 lg:py-20">
        <div class="w-2xl flex flex-col gap-6">
            <div class="flex flex-col items-start gap-3">
                <p class="text-sm font-extrabold font-inter text-green-300">Así de fácil</p>
                <p class="text-4xl font-black font-inter text-white">Empieza a vender en 4 pasos</p>
                <div class="h-1 w-12 bg-green-300" aria-hidden="true"></div>
            </div>

            <p class="max-w-sm text-base font-normal font-inter text-white">
                Sin contratos complicados. Sin cuotas de entrada. Solo regístrate y genera comisiones.
            </p>

            <ol class="mt-4 flex flex-col gap-8 border-l-4 border-green-300 pl-8">
                <li class="flex items-center gap-8">
                    <span class="flex size-14 shrink-0 items-center justify-center rounded-full outline outline-3 outline-green-300 text-3xl font-bold font-inter text-white" aria-hidden="true">1</span>
                    <div>
                        <p class="text-3xl font-bold font-inter text-white">Regístrate gratis</p>
                        <p class="max-w-lg text-xl font-light font-inter text-white">Llena el formulario en línea con los datos de tu agencia. Aprobación en 24 horas.</p>
                    </div>
                </li>
                <li class="flex items-center gap-8">
                    <span class="flex size-14 shrink-0 items-center justify-center rounded-full outline outline-3 outline-green-300 text-3xl font-bold font-inter text-white" aria-hidden="true">2</span>
                    <div>
                        <p class="text-3xl font-bold font-inter text-white">Accede al portal B2B</p>
                        <p class="max-w-lg text-xl font-light font-inter text-white">Explora tarifas netas y disponibilidad en tiempo real de más de 500 hoteles y paquetes.</p>
                    </div>
                </li>
                <li class="flex items-center gap-8">
                    <span class="flex size-14 shrink-0 items-center justify-center rounded-full outline outline-3 outline-green-300 text-3xl font-bold font-inter text-white" aria-hidden="true">3</span>
                    <div>
                        <p class="text-3xl font-bold font-inter text-white">Cotiza y reserva</p>
                        <p class="max-w-lg text-xl font-light font-inter text-white">Genera propuestas con tu marca y confirma reservas para tus clientes al instante.</p>
                    </div>
                </li>
                <li class="flex items-center gap-8">
                    <span class="flex size-14 shrink-0 items-center justify-center rounded-full outline outline-3 outline-green-300 text-3xl font-bold font-inter text-white" aria-hidden="true">4</span>
                    <div>
                        <p class="text-3xl font-bold font-inter text-white">Genera comisiones</p>
                        <p class="max-w-lg text-xl font-light font-inter text-white">Vende experiencias memorables y recibe tus comisiones sin trámites complicados.</p>
                    </div>
                </li>
            </ol>

            <button
                type="button"
                class="mt-6 flex w-sm self-center justify-center items-center gap-2 rounded-lg bg-green-300 px-6 py-3 text-2xl font-bold text-white transition-opacity hover:opacity-90">
                Empezar
                <x-lucide-arrow-right class="h-6 w-6 text-white" />
            </button>
        </div>

        <div class="flex flex-col gap-4 items-center justify-center">
            <div class="w-2xl h-96 rounded-3xl bg-zinc-300"></div>
            <div class="grid grid-cols-2 gap-4 w-2xl">
                <div class="h-96 rounded-3xl bg-zinc-300"></div>
                <div class="h-96 flex flex-col gap-4">
                    <div class="h-full rounded-3xl bg-zinc-300"></div>
                    <div class="h-full rounded-3xl bg-zinc-300"></div>
                </div>
            </div>
        </div>
    </div>
</section>


<x-contact-form />

@endsection
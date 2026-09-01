@extends('layouts.app')

@section('title', 'Home Travel Logic Backend')

@section('content')

{{-- Hero + filtro flotante entre secciones --}}
<div x-data="{ activo: null }">
    <div class="relative">
        <x-animate-in>
            <div class="relative flex min-h-[70vh] flex-col justify-center gap-5 overflow-hidden px-6 py-12 sm:min-h-[80vh] sm:px-8 sm:py-16 md:px-16 lg:min-h-screen lg:px-24 lg:pb-32">
                <img
                    src="{{ asset('images/home/bg-1.webp') }}"
                    alt=""
                    class="absolute inset-0 h-full w-full object-cover"
                    aria-hidden="true" />

                <div class="absolute inset-0 bg-black/50" aria-hidden="true"></div>

                <p class="relative z-10 ml-0 max-w-xl text-3xl font-black font-montserrat leading-tight text-white sm:ml-8 sm:text-4xl md:text-5xl lg:ml-24 lg:text-7xl">
                    Tu socio, tu ventaja
                </p>
                <p class="relative z-10 mb-4 ml-0 max-w-xl text-base font-lato font-bold text-white/90 sm:ml-8 sm:text-lg md:text-xl lg:ml-24">
                    Tour operador B2B que simplifica tu operación con tarifas exclusivas y nuestro modelo One Stop Shop.

                </p>
                <div class="relative z-10 ml-0 flex flex-col gap-3 sm:ml-8 sm:flex-row sm:items-center sm:gap-2 lg:ml-24">
                    <a
                        href="https://www.partners.travel-logic.com/site/login"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="flex w-fit items-center gap-2 rounded-lg bg-green-300 px-6 py-3 text-base font-bold text-white transition-all duration-200 hover:-translate-y-0.5 hover:opacity-90 hover:shadow-md">
                        Acceder al portal
                        <x-lucide-arrow-right class="h-4 w-4 text-white" />
                    </a>
                    <a
                        href="{{ route('register-agency') }}"
                        class="w-fit rounded-lg border border-white px-6 py-3 text-base font-semibold text-white transition-all duration-200 hover:-translate-y-0.5 hover:opacity-90">
                        Quiero registrarme
                    </a>
                </div>

            </div>
        </x-animate-in>

        <div class="pointer-events-none absolute inset-x-0 bottom-0 z-20 translate-y-1/2 px-2 sm:px-3 md:px-4 lg:px-6">
            <div class="pointer-events-auto mx-auto w-full max-w-[1600px]">
                <x-home-filter-info />
            </div>
        </div>
    </div>

    {{-- Bloque de detalles: FUERA del hero, en el flujo normal.
         Al aparecer empuja el contenido de abajo; al ocultarse, libera el espacio. --}}
    <div class="mt-24 sm:mt-28 md:mt-32">
        <x-home-filter-details />
    </div>
</div>{{-- cierra x-data --}}


<div class="font-sans antialiased bg-white text-stone-900 mx-auto w-full max-w-[1600px] px-2 pt-28 sm:px-3 sm:pt-32 md:px-4 md:pt-36 lg:px-6 lg:pt-40">
    {{-- key features --}}
    <x-animate-in>
        <section id="key-features" aria-label="Key Features" class="mb-10 md:mb-14 lg:mb-20">
            <div class="flex flex-col items-stretch gap-10 lg:flex-row lg:items-start lg:justify-between lg:gap-12 xl:gap-16">
                @php
                $keyFeatures = [
                ['title' => 'Liberar el potencial de cada agencia', 'desc' => 'Proporcionamos acceso a soluciones integrales y personalizadas que simplifican su operación y les permiten ofrecer experiencias memorables a sus clientes finales.', 'icon' => 'lock-keyhole'],
                ['title' => 'El operador turístico líder del mercado', 'desc' => 'Ser reconocidos como el socio estratégico de referencia para agencias de viajes mediante nuestro enfoque de.', 'icon' => 'trophy'],
                ['title' => 'Tu socio estratégico B2B', 'desc' => 'Tour operador especializado en el mercado B2B que conecta agencias con una amplia red de servicios hoteleros, mejorando su eficiencia y garantizando experiencias de viaje memorables', 'icon' => 'handshake'],
                ];
                @endphp
                @foreach ($keyFeatures as $index => $feature)
                <x-animate-in delay="{{ $index * 100 }}" variant="subtle" class="flex flex-col items-center gap-2 sm:gap-4">
                    <div class="flex size-16 items-center justify-center rounded-lg bg-green-100">
                        <x-dynamic-component :component="'lucide-' . $feature['icon']" class="h-10 w-10 text-green-300" />
                    </div>
                    <p class="w-full max-w-xs text-center text-xl font-extrabold font-inter text-indigo-950 sm:text-2xl">{{ $feature['title'] }}</p>
                    <p class="w-full max-w-xs text-center text-base font-medium text-zinc-500">{{ $feature['desc'] }}</p>
                </x-animate-in>
                @endforeach
            </div>
        </section>
    </x-animate-in>
</div>

{{-- Features --}}
<x-animate-in>
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
                    @php
                    $features = [
                    ['num' => 1, 'title' => 'Portal B2B Exclusivo', 'desc' => 'Plataforma 100% diseñada para agencias. Consulta disponibilidad, cotiza y reserva en tiempo real, las 24 horas del día.'],
                    ['num' => 2, 'title' => 'Tarifas Netas Garantizadas', 'desc' => 'Precios de mayorista en más de 500 hoteles y paquetes en México, el Caribe y destinos internacionales seleccionados.'],
                    ['num' => 3, 'title' => 'Cotizador con tu Marca', 'desc' => 'Genera propuestas con el logo y datos de tu agencia, listas para enviar a tus clientes al instante vía PDF o correo.'],
                    ['num' => 4, 'title' => 'Herramientas de Marketing', 'desc' => 'Descarga flyers y materiales promocionales personalizados para impulsar tus ventas en redes sociales y WhatsApp.'],
                    ['num' => 5, 'title' => 'Herramientas de Marketing', 'desc' => 'Plataforma 100% diseñada para agencias. Consulta disponibilidad, cotiza y reserva en tiempo real, las 24 horas del día.'],
                    ['num' => 6, 'title' => 'Portal B2B Exclusivo', 'desc' => 'Plataforma 100% diseñada para agencias. Consulta disponibilidad, cotiza y reserva en tiempo real, las 24 horas del día.'],
                    ];
                    @endphp
                    @foreach ($features as $index => $feature)
                    <x-animate-in delay="{{ $index * 80 }}" variant="subtle">
                        <div class="flex items-start gap-4">
                            <div class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-green-300">
                                <p class="text-2xl font-normal font-inter text-white">{{ $feature['num'] }}</p>
                            </div>
                            <div>
                                <p class="text-base font-bold font-inter text-white">{{ $feature['title'] }}</p>
                                <p class="text-xs font-normal font-inter text-white/90">{{ $feature['desc'] }}</p>
                            </div>
                        </div>
                    </x-animate-in>
                    @endforeach
                </div>
            </div>
            <div class="flex items-center justify-center px-6 py-12 sm:px-8 lg:px-12 lg:py-16">
                <img
                    src="{{ asset('images/home/keys.webp') }}"
                    alt="Todo lo que tu agencia necesita"
                    width="560"
                    height="575"
                    class="h-auto w-full max-w-2xl object-contain transition-transform duration-500 hover:scale-105" />
            </div>
        </div>
    </section>
</x-animate-in>

<!-- seccion portafolio de destinos -->
<x-animate-in>
    <section id="portfolio-hotels" aria-label="Portafolio de destinos" class="mt-10 w-full bg-white">
        <div class="flex flex-col items-start gap-3 px-6 sm:px-8 md:px-16 lg:px-24">
            <p class="text-sm font-extrabold font-inter text-green-300">Nuestro portafolio</p>
            <p class="text-3xl font-black font-inter text-indigo-950 sm:text-4xl">Destinos que venden solos</p>
            <div class="h-1 w-12 bg-green-300" aria-hidden="true"></div>
        </div>

        <div class="flex gap-8 py-12 justify-center">
            <div class="group relative w-[316px] h-[500px] overflow-hidden bg-zinc-300 rounded-2xl hover:scale-105 transition-all duration-300">
                <img src="{{ asset('images/destination-home-section/playas.webp') }}" class="w-full h-full object-cover rounded-2xl">
                <div class="absolute inset-0 flex flex-col gap-2 justify-center items-center p-4 bg-black/50 group-hover:opacity-100 opacity-0 transition-all duration-300">
                    <p class="text-white text-2xl font-bold font-inter">Sol y playa</p>
                    <p class="text-white text-base font-normal font-inter">costas y actividades marinas</p>
                </div>
            </div>
            <div class="group relative w-[316px] h-[500px] overflow-hidden bg-zinc-300 rounded-2xl hover:scale-105 transition-all duration-300">
                <img src="{{ asset('images/destination-home-section/cultura.webp') }}" class="w-full h-full object-cover rounded-2xl">
                <div class="absolute inset-0 flex flex-col gap-2 justify-center items-center p-4 bg-black/50 group-hover:opacity-100 opacity-0 transition-all duration-300">
                    <p class="text-white text-2xl font-bold font-inter">Cultura</p>
                    <p class="text-white text-base font-normal font-inter">historia, arte y gastronomía</p>
                </div>
            </div>
            <div class="group relative w-[316px] h-[500px] overflow-hidden bg-zinc-300 rounded-2xl hover:scale-105 transition-all duration-300">
                <img src="{{ asset('images/destination-home-section/naturaleza.webp') }}" class="w-full h-full object-cover rounded-2xl">
                <div class="absolute inset-0 flex flex-col gap-2 justify-center items-center p-4 bg-black/50 group-hover:opacity-100 opacity-0 transition-all duration-300">
                    <p class="text-white text-2xl font-bold font-inter">Naturaleza y ecoturismo</p>
                    <p class="text-white text-base font-normal font-inter">aventura al aire libre</p>
                </div>
            </div>
            <div class="group relative w-[316px] h-[500px] overflow-hidden bg-zinc-300 rounded-2xl hover:scale-105 transition-all duration-300">
                <img src="{{ asset('images/destination-home-section/negocios.webp') }}" class="w-full h-full object-cover rounded-2xl">
                <div class="absolute inset-0 flex flex-col gap-2 justify-center items-center p-4 bg-black/50 group-hover:opacity-100 opacity-0 transition-all duration-300">
                    <p class="text-white text-2xl font-bold font-inter">Negocios y reuniones</p>
                    <p class="text-white text-base font-normal font-inter">congresos y viajes corporativos</p>
                </div>
            </div>
            <div class="group relative w-[316px] h-[500px] overflow-hidden bg-zinc-300 rounded-2xl hover:scale-105 transition-all duration-300">
                <img src="{{ asset('images/destination-home-section/termalismo.webp') }}" class="w-full h-full object-cover rounded-2xl">
                <div class="absolute inset-0 flex flex-col gap-2 justify-center items-center p-4 bg-black/50 group-hover:opacity-100 opacity-0 transition-all duration-300">
                    <p class="text-white text-2xl font-bold font-inter">Salud y bienestar</p>
                    <p class="text-white text-base font-normal font-inter">termalismo y recuperación</p>
                </div>
            </div>
        </div>
    </section>
</x-animate-in>

<x-animate-in>
    <section id="steps" aria-label="Cómo empezar" class="mt-20 w-full bg-blue-400">
        <div class="grid grid-cols-1 gap-10 px-6 py-12 sm:px-8 sm:py-16 md:px-16 lg:grid-cols-2 lg:gap-16 lg:px-24 lg:py-20">
            <div class="flex w-full max-w-2xl flex-col gap-6">
                <div class="flex flex-col items-start gap-3">
                    <p class="text-sm font-extrabold font-inter text-green-300">Así de fácil</p>
                    <p class="text-3xl font-black font-inter text-white sm:text-4xl">Empieza a vender en 4 pasos</p>
                    <div class="h-1 w-12 bg-green-300" aria-hidden="true"></div>
                </div>

                <p class="max-w-sm text-base font-normal font-inter text-white">
                    Sin contratos complicados. Sin cuotas de entrada. Solo regístrate y genera comisiones.
                </p>

                <ol class="mt-4 flex flex-col gap-6 border-l-4 border-green-300 pl-6 sm:gap-8 sm:pl-8">
                    @php
                    $steps = [
                    ['title' => 'Regístrate gratis', 'desc' => 'Llena el formulario en línea con los datos de tu agencia. Aprobación en 24 horas.'],
                    ['title' => 'Accede al portal B2B', 'desc' => 'Explora tarifas netas y disponibilidad en tiempo real de más de 500 hoteles y paquetes.'],
                    ['title' => 'Cotiza y reserva', 'desc' => 'Genera propuestas con tu marca y confirma reservas para tus clientes al instante.'],
                    ['title' => 'Genera comisiones', 'desc' => 'Vende experiencias memorables y recibe tus comisiones sin trámites complicados.'],
                    ];
                    @endphp
                    @foreach ($steps as $index => $step)
                    <li>
                        <x-animate-in delay="{{ $index * 100 }}" variant="subtle">
                            <div class="flex flex-col items-start gap-4 sm:flex-row sm:items-center sm:gap-6 lg:gap-8">
                                <span class="flex size-12 shrink-0 items-center justify-center rounded-full text-2xl font-bold font-inter text-white outline outline-3 outline-green-300 sm:size-14 sm:text-3xl" aria-hidden="true">{{ $index + 1 }}</span>
                                <div>
                                    <p class="text-xl font-bold font-inter text-white sm:text-2xl lg:text-3xl">{{ $step['title'] }}</p>
                                    <p class="max-w-lg text-base font-light font-inter text-white sm:text-lg lg:text-xl">{{ $step['desc'] }}</p>
                                </div>
                            </div>
                        </x-animate-in>
                    </li>
                    @endforeach
                </ol>

                <a
                    href="{{ route('register-agency') }}"
                    class="mt-6 flex w-full max-w-xs items-center justify-center gap-2 self-center rounded-lg bg-green-300 px-6 py-3 text-xl font-bold text-white transition-all duration-200 hover:-translate-y-0.5 hover:opacity-90 hover:shadow-md sm:text-2xl">
                    Empezar
                    <x-lucide-arrow-right class="h-6 w-6 text-white" />
                </a>
            </div>

            <div class="flex flex-col items-center justify-center gap-4">
                <div class="h-64 w-full max-w-2xl rounded-3xl bg-zinc-300 sm:h-80 lg:h-96"></div>
                <div class="grid w-full max-w-2xl grid-cols-2 gap-4">
                    <div class="h-48 rounded-3xl bg-zinc-300 sm:h-64 lg:h-96"></div>
                    <div class="flex h-48 flex-col gap-4 sm:h-64 lg:h-96">
                        <div class="h-full rounded-3xl bg-zinc-300"></div>
                        <div class="h-full rounded-3xl bg-zinc-300"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-animate-in>

<x-animate-in>
    <section
        id="testimonials"
        aria-label="Testimonios"
        class="mt-20 w-full bg-white pb-12 sm:pb-20"
        x-data="{
            modal: null,
            canScroll: false,
            init() {
                const track = this.$refs.track;
                const check = () => { this.canScroll = track.scrollWidth > track.clientWidth + 8 };
                check();
                new ResizeObserver(check).observe(track);
            },
            go(dir) {
                const card = this.$refs.track.querySelector('article');
                this.$refs.track.scrollBy({ left: dir * ((card?.offsetWidth ?? 320) + 16), behavior: 'smooth' });
            },
        }"
        x-on:keydown.escape.window="modal = null"
        x-effect="document.body.classList.toggle('overflow-hidden', !!modal)"
    >
        <div class="flex flex-col gap-6 px-4 sm:px-8 lg:flex-row lg:items-center lg:justify-between lg:px-24">
            <div class="flex flex-col gap-3">
                <p class="text-sm font-extrabold font-inter text-green-300">Testimonios</p>
                <p class="text-3xl font-black font-inter text-blue-400 sm:text-4xl">Lo que dicen nuestras agencias</p>
                <div class="h-1 w-12 bg-green-300" aria-hidden="true"></div>
            </div>
            <div class="flex items-center gap-4" x-show="canScroll" x-cloak>
                <button
                    type="button"
                    aria-label="Testimonio anterior"
                    x-on:click="go(-1)"
                    class="flex size-12 items-center justify-center rounded-full border-3 border-green-300 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md lg:size-20"
                >
                    <x-lucide-arrow-left class="h-6 w-6 text-green-300 lg:h-10 lg:w-10" />
                </button>
                <button
                    type="button"
                    aria-label="Testimonio siguiente"
                    x-on:click="go(1)"
                    class="flex size-12 items-center justify-center rounded-full border-3 border-green-300 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md lg:size-20"
                >
                    <x-lucide-arrow-right class="h-6 w-6 text-green-300 lg:h-10 lg:w-10" />
                </button>
            </div>
        </div>

        @php
        $testimonials = [
        ['name' => 'Lizette Zepeda — Citimar Travel Agency', 'quote' => 'Tuve la oportunidad de participar en el FAMTRIP a Tulum organizado por Travel Logic, y la experiencia fue excelente de principio a fin. Conocimos dos magníficas propiedades, disfrutamos del destino y visitamos la zona arqueológica de Cobá, viviendo de primera mano todo lo que posteriormente podremos recomendar a nuestros viajeros. Quiero destacar el profesionalismo de Dani Mercado, gerente de ventas, así como de todo su equipo, quienes estuvieron siempre atentos para que cada actividad se desarrollara en tiempo y forma, haciendo de este viaje una experiencia productiva y enriquecedora para todos los agentes de viajes participantes. Además, fue muy valioso formar parte de un nuevo concepto de FAMTRIP, integrando a diversos socios comerciales que presentaron sus servicios y beneficios para fortalecer el trabajo conjunto entre agencias y proveedores. ¡Una experiencia que califico con 5 estrellas!', 'rating' => 5],
        ['name' => 'Noravi Travel', 'quote' => 'La verdad han sido muy atentos, sus explicaciones son muy precisas, te atienden las dudas prácticamente de inmediato y resuelven, que es lo más importante. Con las personas que he tratado siempre han estado al pendiente de todo.', 'rating' => 5],
        ];
        @endphp

        <div
            x-ref="track"
            class="mt-10 flex flex-nowrap snap-x snap-mandatory gap-4 overflow-x-auto px-4 py-2 sm:mt-16 sm:px-8 lg:mt-32 lg:px-24 [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden"
            :class="canScroll ? 'justify-start' : 'justify-center'"
        >
            @foreach ($testimonials as $index => $testimonial)
            <x-animate-in delay="{{ $index * 100 }}" variant="subtle" class="flex shrink-0 snap-start">
                <x-testimonial-card
                    :name="$testimonial['name']"
                    :quote="$testimonial['quote']"
                    :rating="$testimonial['rating'] ?? 5" />
            </x-animate-in>
            @endforeach
        </div>

        <template x-teleport="body">
        <div
            x-show="modal"
            x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[200] flex items-center justify-center p-4"
            role="dialog"
            aria-modal="true"
            aria-labelledby="testimonial-modal-title"
        >
            <div class="absolute inset-0 bg-stone-900/50" x-on:click="modal = null"></div>
            <div class="relative z-10 flex max-h-[80vh] w-full max-w-xl flex-col overflow-hidden rounded-3xl border border-green-300 bg-white p-6 shadow-2xl sm:p-10">
                <button
                    type="button"
                    aria-label="Cerrar"
                    x-on:click="modal = null"
                    class="absolute right-4 top-4 flex size-9 items-center justify-center rounded-full text-stone-500 transition-colors hover:bg-stone-100 hover:text-stone-900"
                >
                    <x-lucide-x class="size-5" />
                </button>
                <div class="flex min-h-0 flex-col gap-6 overflow-y-auto pr-2">
                    <header class="flex items-center gap-4 pr-8">
                        <div class="flex size-16 shrink-0 items-center justify-center rounded-full bg-green-300 sm:size-20" aria-hidden="true">
                            <x-lucide-user class="h-8 w-8 text-white" />
                        </div>
                        <div>
                            <p id="testimonial-modal-title" class="text-xl font-bold font-inter text-blue-400" x-text="modal?.name"></p>
                            <div class="mt-1 flex items-center gap-0.5" role="img" :aria-label="(modal?.rating ?? 0) + ' de 5 estrellas'">
                                <template x-for="i in [1, 2, 3, 4, 5]" :key="i">
                                    <span>
                                        <x-lucide-star
                                            class="h-4 w-4"
                                            x-bind:class="i <= (modal?.rating ?? 0) ? 'fill-amber-400 text-amber-400' : 'text-gray-300'"
                                        />
                                    </span>
                                </template>
                            </div>
                        </div>
                    </header>
                    <blockquote class="text-base font-light font-inter text-slate-500 sm:text-xl" x-text="modal?.quote"></blockquote>
                </div>
            </div>
        </div>
        </template>
    </section>
</x-animate-in>

<x-animate-in>
    <section id="contact" aria-label="Contact" class="mt-20 w-full bg-blue-300 px-4 py-16 sm:px-8 sm:py-24 lg:px-24 lg:py-32">
        <div class="mx-auto flex max-w-6xl flex-col items-center justify-center gap-8 lg:flex-row lg:gap-20">
            <div class="flex w-full max-w-xl flex-col items-center justify-center gap-6 text-center lg:items-start lg:text-left">
                <p class="text-3xl font-black font-inter text-white sm:text-4xl lg:text-5xl">¿Listo para hacer crecer tu agencia con nosotros?</p>
                <p class="text-base font-medium font-inter text-white">Únete a más de 200 agencias que ya disfrutan de tarifas exclusivas y herramientas profesionales bajo el modelo One Stop Shop.</p>
                <div class="flex w-full flex-col gap-3 sm:flex-row sm:justify-center lg:justify-start">
                    <a href="{{ route('register-agency') }}" class="rounded-lg bg-green-300 px-8 py-3 text-center text-base font-medium font-inter text-white transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md sm:px-12">Registrarme gratis</a>
                    <a href="https://apsholding.mx/agendar-cita-travel-logic" target="_blank" rel="noopener noreferrer" class="rounded-lg border border-green-300 px-8 py-3 text-center text-base font-medium font-inter text-white transition-all duration-200 hover:-translate-y-0.5 sm:px-12">Hablar con un asesor</a>
                </div>
            </div>
            <div class="w-full max-w-xl">
                <img src="{{ asset('images/mapa.png') }}" alt="Contact" width="560" height="575" class="h-auto w-full object-contain" />
            </div>
        </div>
    </section>
</x-animate-in>

@endsection
@extends('layouts.app')

@section('title', 'Nosotros - Travel Logic')

@section('content')

{{-- Hero about: imágenes desde la izquierda, texto desde la derecha --}}
<section id="about" aria-label="Nosotros" class="w-full bg-blue-300 py-10 sm:py-16 md:py-24 lg:py-32 overflow-hidden">
    <div class="mx-auto flex w-full max-w-[1600px] flex-col items-center gap-10 px-4 sm:px-8 md:gap-14 md:px-12 lg:flex-row lg:items-center lg:justify-center lg:gap-16 xl:gap-20 lg:px-16 xl:px-24">
        {{-- Bloque de imágenes — entra desde la izquierda --}}
        <div data-animate="fade-left" data-animate-distance="100" class="group flex w-full shrink-0 flex-col items-center gap-3 sm:gap-4 sm:flex-row sm:items-stretch justify-center lg:w-auto">
            <div class="w-full max-w-sm overflow-hidden rounded-2xl sm:rounded-3xl sm:w-72 md:w-80 lg:w-72 xl:w-96">
                <img
                    src="{{ asset('images/home/frame1.webp') }}"
                    alt="Equipo de Travel Logic"
                    class="h-64 sm:h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
            </div>
            <div class="flex w-full max-w-sm flex-col gap-3 sm:gap-4 sm:w-72 md:w-80 lg:w-72 xl:w-96">
                <div class="h-48 sm:min-h-60 md:min-h-80 flex-1 overflow-hidden rounded-2xl sm:rounded-3xl">
                    <img
                        src="{{ asset('images/home/frame2.webp') }}"
                        alt="Oficinas de Travel Logic"
                        class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
                </div>
                <div class="flex gap-3 sm:gap-4">
                    <div class="h-32 sm:h-auto flex-1 overflow-hidden rounded-2xl sm:rounded-3xl">
                        <img
                            src="{{ asset('images/home/frame3.webp') }}"
                            alt="Experiencias de viaje"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
                    </div>
                    <div class="h-32 sm:h-auto flex-1 overflow-hidden rounded-2xl sm:rounded-3xl">
                        <img
                            src="{{ asset('images/home/frame4.webp') }}"
                            alt="Destinos turísticos"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
                    </div>
                </div>
            </div>
        </div>

        {{-- Texto — entra desde la derecha --}}
        <div data-animate="fade-right" data-animate-distance="100" class="flex w-full max-w-xl flex-col justify-center gap-4 sm:gap-6">
            <div class="mb-1 sm:mb-2 flex flex-col gap-2">
                <h1 class="font-inter text-3xl sm:text-4xl lg:text-5xl font-semibold leading-tight text-white">Nosotros</h1>
            </div>
            <div class="border-l-4 border-sky-500 pl-4 sm:pl-6">
                <div class="flex flex-col gap-3 sm:gap-4 font-inter text-sm sm:text-base md:text-lg font-normal leading-relaxed sm:leading-8 text-white">
                    <p>Travel Logic nació el 23 de septiembre de 2023 de una idea simple: si ya negociábamos las mejores tarifas hoteleras para nuestra propia operación dentro de APS Holding, ¿por qué no compartir esa ventaja con otras agencias? Así nació una operadora mayorista construida desde la experiencia real de operar y negociar.</p>
                    <p>Somos parte de una familia de empresas: <span class="font-bold text-green-400">COME-EVA, GATE 48, TRAKEN, SMART AVIATION, BAGGAGE EXPRESS Y VIRION MEDIA</span>, todas unidas por una misma visión. Hoy seguimos con la misma idea original: convertir las mejores tarifas en ventaja competitiva para todo el gremio.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Marcas: título entra desde abajo, logos en batch desde izquierda/derecha alternado --}}
<section id="brands" aria-label="Marcas con las que trabajamos" class="w-full bg-white px-4 py-12 sm:px-8 sm:py-20 lg:px-24 lg:py-28 overflow-hidden">
    @php
    $airlines = [
    ['src' => 'volaris.webp', 'alt' => 'Volaris'],
    ['src' => 'aeromexico.webp', 'alt' => 'Aeroméxico'],
    ['src' => 'viva-aerobus.webp', 'alt' => 'Viva Aerobus'],
    ];
    $hotels = [
    ['src' => 'palace.webp', 'alt' => 'Palace Resorts'],
    ['src' => 'pam.webp', 'alt' => 'PAM Hotels'],
    ['src' => 'xcaret.webp', 'alt' => 'Xcaret'],
    ['src' => 'karisma.webp', 'alt' => 'Karisma Hotels & Resorts'],
    ['src' => 'accor.webp', 'alt' => 'Accor'],
    ['src' => 'arriva.webp', 'alt' => 'Arriva Hospitality'],
    ['src' => 'marriott.webp', 'alt' => 'Marriott'],
    ['src' => 'hilton.webp', 'alt' => 'Hilton'],
    ['src' => 'hyatt.webp', 'alt' => 'Hyatt'],
    ['src' => 'emporio.webp', 'alt' => 'Emporio'],
    ['src' => 'fairmont.webp', 'alt' => 'Fairmont'],
    ['src' => 'aimbridge.webp', 'alt' => 'Aimbridge'],
    ['src' => 'catalonia.webp', 'alt' => 'Catalonia'],
    ['src' => 'imperial.webp', 'alt' => 'Grupo Imperial'],
    ['src' => 'paladium.webp', 'alt' => 'Palladium'],
    ];
    $airlineLogoClass = 'h-14 w-44 sm:h-12 sm:w-40 md:h-14 md:w-44 lg:h-16 lg:w-48 shrink-0 object-contain transition-transform duration-300 hover:scale-105';
    $hotelLogoClass = 'h-8 sm:h-10 md:h-12 lg:h-14 w-28 sm:w-36 md:w-44 lg:w-48 shrink-0 object-contain transition-transform duration-300 hover:scale-105';
    @endphp

    <div class="mx-auto mt-8 flex w-full max-w-8xl flex-col items-center gap-10 sm:mt-16 sm:gap-14">
        <div data-animate="fade-up" class="flex flex-col items-center gap-3">
            <p class="text-center text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold font-inter text-blue-300">Marcas con las que trabajamos</p>
            <div class="h-1 w-12 bg-green-300" aria-hidden="true"></div>
        </div>

        {{-- Aerolíneas: batch desde la izquierda --}}
        <div class="flex w-full flex-col items-center gap-4 sm:gap-6">
            <p data-animate="fade-left" class="text-xs sm:text-sm font-extrabold font-inter uppercase tracking-wide text-green-300">Aerolíneas</p>
            <div
                data-batch-group
                data-batch-direction="left"
                class="grid w-full max-w-sm sm:max-w-none grid-cols-2 sm:grid-cols-3 items-center justify-items-center gap-x-4 gap-y-6 sm:gap-x-10 md:gap-x-14 lg:gap-x-16">
                @foreach ($airlines as $airline)
                <div class="{{ $loop->last ? 'col-span-2 sm:col-span-1' : '' }} flex items-center justify-center">
                    <img
                        data-batch-item
                        src="{{ asset('images/about/' . $airline['src']) }}"
                        alt="{{ $airline['alt'] }}"
                        class="{{ $airlineLogoClass }}" />
                </div>
                @endforeach
            </div>
        </div>

        {{-- Hoteles: batch desde la derecha --}}
        <div class="flex w-full flex-col items-center gap-4 sm:gap-6">
            <p data-animate="fade-right" class="text-xs sm:text-sm font-extrabold font-inter uppercase tracking-wide text-green-300">Cadenas de hoteles</p>
            <div
                data-batch-group
                data-batch-direction="right"
                class="flex flex-wrap items-center justify-center gap-x-6 sm:gap-x-10 md:gap-x-12 lg:gap-x-16 gap-y-6 sm:gap-y-8">
                @foreach ($hotels as $hotel)
                <img
                    data-batch-item
                    src="{{ asset('images/about/' . $hotel['src']) }}"
                    alt="{{ $hotel['alt'] }}"
                    class="{{ $hotelLogoClass }}" />
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Misión y visión: Misión desde la izquierda, Visión desde la derecha --}}
<section id="mission" aria-label="Misión y visión" class="mt-8 sm:mt-16 md:mt-20 w-full bg-blue-300 px-4 py-12 sm:px-8 sm:py-20 lg:px-20 lg:py-28 overflow-hidden">
    @php
    $missionVision = [
    [
    'label' => 'Nuestro propósito',
    'title' => 'Misión',
    'icon' => 'target',
    'text' => 'Liberar el potencial de las agencias de viajes con soluciones integrales que simplifican su operación y crean experiencias memorables para sus clientes.',
    'animate' => 'fade-left',
    ],
    [
    'label' => 'Hacia dónde vamos',
    'title' => 'Visión',
    'icon' => 'compass',
    'text' => 'Ser el operador turístico líder, reconocido como el socio estratégico de referencia para agencias de viajes.',
    'animate' => 'fade-right',
    ],
    ];
    @endphp
    <div class="mx-auto flex max-w-6xl flex-col items-stretch gap-6 lg:flex-row lg:gap-8">
        @foreach ($missionVision as $index => $item)
        <div
            data-animate="{{ $item['animate'] }}"
            data-animate-delay="{{ $index * 0.15 }}"
            data-animate-distance="90"
            class="flex-1">
            <article class="flex h-full flex-col gap-4 sm:gap-5 md:gap-6 rounded-2xl sm:rounded-3xl border-l-4 border-green-300 bg-white/5 p-5 sm:p-6 md:p-8 transition-all duration-300 hover:-translate-y-0.5">
                <div class="flex size-12 sm:size-16 items-center justify-center rounded-lg bg-white/10">
                    <x-dynamic-component :component="'lucide-' . $item['icon']" class="h-6 w-6 sm:h-8 sm:w-8 text-green-300" />
                </div>
                <div class="flex flex-col gap-1.5 sm:gap-2">
                    <p class="text-xs sm:text-sm font-extrabold font-inter uppercase tracking-wide text-green-300">{{ $item['label'] }}</p>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold font-inter text-balance text-white">{{ $item['title'] }}</h2>
                </div>
                <p class="text-pretty text-sm sm:text-base md:text-lg font-medium font-inter leading-relaxed sm:leading-8 text-white/80">{{ $item['text'] }}</p>
            </article>
        </div>
        @endforeach
    </div>
</section>

{{-- Valores: título desde abajo, cards alternando izquierda/derecha en batch --}}
<section id="values" aria-label="Nuestros valores" class="w-full bg-white px-4 py-12 sm:px-8 sm:py-20 lg:px-24 lg:py-28 overflow-hidden">
    @php
    $values = [
    ['title' => 'Confianza', 'desc' => 'Base de cada relación con nuestras agencias.', 'icon' => 'shield-check'],
    ['title' => 'Cercanía', 'desc' => 'Acompañamiento humano en cada etapa.', 'icon' => 'heart-handshake'],
    ['title' => 'Innovación', 'desc' => 'IA y herramientas digitales integradas.', 'icon' => 'sparkles'],
    ['title' => 'Colaboración', 'desc' => 'Red de socios comprometidos.', 'icon' => 'users'],
    ['title' => 'Integridad', 'desc' => 'Transparencia y ética en todo lo que hacemos.', 'icon' => 'scale'],
    ['title' => 'Reconocimiento', 'desc' => 'Valoramos el esfuerzo de cada agencia.', 'icon' => 'award'],
    ['title' => 'Eficiencia', 'desc' => 'Optimización continua para mejores resultados.', 'icon' => 'gauge'],
    ];
    @endphp
    <div class="mx-auto flex w-full max-w-7xl flex-col items-center gap-8 sm:gap-12">
        <div data-animate="fade-up" class="flex flex-col items-center gap-3">
            <h2 class="text-center text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold font-inter text-blue-300">Nuestros valores</h2>
            <div class="h-1 w-12 bg-green-300" aria-hidden="true"></div>
        </div>

        {{-- Batch alternado: filas impares desde izquierda, pares desde derecha --}}
        <div
            data-batch-group
            data-batch-direction="up"
            class="grid w-full grid-cols-1 gap-4 sm:gap-6 sm:grid-cols-2 lg:grid-cols-3 justify-items-center">
            @foreach ($values as $index => $value)
            <div
                data-batch-item
                class="w-full max-w-sm {{ $loop->last && count($values) % 3 !== 0 ? 'sm:col-span-2 lg:col-span-3' : '' }}">
                <article class="flex h-full flex-col items-center gap-3 sm:gap-4 rounded-2xl sm:rounded-3xl p-5 sm:p-6 md:p-8 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex size-12 sm:size-16 items-center justify-center rounded-lg bg-green-100">
                        <x-dynamic-component :component="'lucide-' . $value['icon']" class="h-7 w-7 sm:h-10 sm:w-10 text-green-300" />
                    </div>
                    <h3 class="text-lg sm:text-xl md:text-2xl font-extrabold font-inter text-blue-300">{{ $value['title'] }}</h3>
                    <p class="text-pretty text-sm sm:text-base font-normal font-lato leading-relaxed sm:leading-7 text-zinc-500">{{ $value['desc'] }}</p>
                </article>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Equipo: título desde izquierda, cards alternando desde laterales --}}
<section id="team" aria-label="Team" class="mb-12 sm:mb-20 w-full bg-white px-4 sm:px-8 md:px-12 lg:px-16 xl:px-24 overflow-hidden">
    @php $team = [
    ['name' => 'Ana Ornelas', 'role' => 'Gerente General', 'phone' => '9987348273', 'email' => 'gerencia@travel-logic.com', 'avatar' => 'ana.webp'],
    ['name' => 'Danny Mercado', 'role' => 'Gerente Comercial', 'phone' => '9981251330', 'email' => 'producto@travel-logic.com', 'avatar' => 'danny.webp'],
    ['name' => 'Sofia Gerardo', 'role' => 'Ejecutiva de Ventas & RRPP', 'phone' => '9981351534', 'email' => 'ventas@travel-logic.com', 'avatar' => 'sofia.webp'],
    ['name' => 'Fernanda Valdéz', 'role' => 'Especialista de Servicio', 'phone' => '9982404465', 'email' => 'reservas@travel-logic.com', 'avatar' => 'fernanda.webp'],
    ['name' => 'pendiente', 'role' => 'Especialista de Hospedaje', 'phone' => '9982339545', 'email' => 'reservas@travel-logic.com', 'avatar' => 'pendiente.webp'],
    ['name' => 'Yamili Dzib', 'role' => 'Asistente Administrativo', 'phone' => '9982321008', 'email' => 'administracion@travel-logic.com', 'avatar' => 'yamili.webp'],
    ]; @endphp

    <div class="mx-auto w-full max-w-[1600px]">
        <p data-animate="fade-left" class="mb-6 sm:mb-8 md:mb-12 text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold font-inter text-blue-300">El Equipo</p>

        <div class="grid grid-cols-1 gap-6 sm:gap-8 sm:grid-cols-2 lg:grid-cols-3 lg:gap-10">
            @foreach ($team as $index => $member)
            {{-- Par → entra desde la derecha, impar → desde la izquierda --}}
            <div
                data-animate="{{ $index % 2 === 0 ? 'fade-left' : 'fade-right' }}"
                data-animate-delay="{{ ($index % 3) * 0.12 }}"
                data-animate-distance="80">
                <div class="group relative aspect-[568/488] w-full overflow-hidden bg-white transition-all duration-300 hover:-translate-y-1">
                    <div class="absolute left-[10%] sm:left-[12%] lg:left-[14%] top-[4.5%] h-[59%] w-[50%] sm:w-[46%] lg:w-[45%] overflow-hidden rounded-2xl bg-gray-400">
                        <img src="{{ asset('images/team/' . $member['avatar']) }}" alt="{{ $member['name'] }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                    <div class="absolute bottom-[4%] left-[22%] sm:left-[24%] lg:left-[28%] w-[72%] sm:w-[68%] md:w-[64%] lg:w-[60%] xl:w-1/2 rounded-tl-2xl rounded-tr-2xl rounded-br-2xl bg-blue-300 p-3 sm:p-4 md:p-5 lg:p-6 xl:p-8">
                        <p class="font-inter text-sm sm:text-base lg:text-lg font-bold leading-tight sm:leading-5 text-white">
                            {{ $member['name'] }}
                        </p>
                        <p class="font-inter text-xs sm:text-sm lg:text-base font-normal leading-tight sm:leading-5 text-white/90">
                            {{ $member['role'] }}
                        </p>
                        <div class="mt-2 sm:mt-3 flex flex-col gap-0.5 sm:gap-1">
                            <a href="tel:{{ $member['phone'] }}" class="font-inter text-[11px] sm:text-xs lg:text-sm font-normal leading-4 sm:leading-5 text-white/80 hover:text-white">
                                {{ $member['phone'] }}
                            </a>
                            <a href="mailto:{{ $member['email'] }}" class="font-inter text-[10px] sm:text-xs lg:text-sm font-normal leading-4 sm:leading-5 text-white/80 hover:text-white truncate" title="{{ $member['email'] }}">
                                {{ $member['email'] }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
@vite('resources/js/about-animations.js')
@endpush

@endsection
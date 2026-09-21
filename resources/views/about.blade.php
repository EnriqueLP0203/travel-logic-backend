@extends('layouts.app')

@section('title', 'Nosotros - Travel Logic')

@section('content')

{{-- Hero about: imágenes desde la izquierda, texto desde la derecha --}}
<section id="about" aria-label="Nosotros" class="w-full bg-blue-300 py-16 md:py-24 lg:py-32 overflow-hidden">
    <div class="mx-auto flex w-full max-w-[1600px] flex-col items-center gap-12 px-6 sm:px-8 md:gap-16 md:px-16 lg:flex-row lg:items-center lg:justify-center lg:gap-20 lg:px-24">
        {{-- Bloque de imágenes — entra desde la izquierda --}}
        <div data-animate="fade-left" data-animate-distance="100" class="group flex w-full shrink-0 flex-col items-center gap-4 sm:flex-row sm:items-stretch lg:w-auto">
            <div class="w-full max-w-sm overflow-hidden rounded-3xl sm:w-80 lg:w-96">
                <img
                    src="{{ asset('images/home/frame1.webp') }}"
                    alt="Equipo de Travel Logic"
                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
            </div>
            <div class="flex w-full max-w-sm flex-col gap-4 sm:w-80 lg:w-96">
                <div class="min-h-80 flex-1 overflow-hidden rounded-3xl">
                    <img
                        src="{{ asset('images/home/frame2.webp') }}"
                        alt="Oficinas de Travel Logic"
                        class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
                </div>
                <div class="flex gap-4">
                    <div class="flex-1 overflow-hidden rounded-3xl">
                        <img
                            src="{{ asset('images/home/frame3.webp') }}"
                            alt="Experiencias de viaje"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
                    </div>
                    <div class="flex-1 overflow-hidden rounded-3xl">
                        <img
                            src="{{ asset('images/home/frame4.webp') }}"
                            alt="Destinos turísticos"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
                    </div>
                </div>
            </div>
        </div>

        {{-- Texto — entra desde la derecha --}}
        <div data-animate="fade-right" data-animate-distance="100" class="flex w-full max-w-xl flex-col justify-center gap-6">
            <div class="mb-2 flex flex-col gap-2">
                <h1 class="font-inter text-4xl font-semibold leading-tight text-white">Nosotros</h1>
            </div>
            <div class="border-l-4 border-sky-500 pl-6">
                <div class="flex flex-col gap-4 font-inter text-base font-normal leading-8 text-white sm:text-lg">
                    <p>Travel Logic nació el 23 de septiembre de 2023 de una idea simple: si ya negociábamos las mejores tarifas hoteleras para nuestra propia operación dentro de APS Holding, ¿por qué no compartir esa ventaja con otras agencias? Así nació una operadora mayorista construida desde la experiencia real de operar y negociar.</p>
                    <p>Somos parte de una familia de empresas: <span class="font-bold text-green-400">COME-EVA, GATE 48, TRAKEN, SMART AVIATION, BAGGAGE EXPRESS Y VIRION MEDIA</span>, todas unidas por una misma visión. Hoy seguimos con la misma idea original: convertir las mejores tarifas en ventaja competitiva para todo el gremio.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Marcas: título entra desde abajo, logos en batch desde izquierda/derecha alternado --}}
<section id="brands" aria-label="Marcas con las que trabajamos" class="w-full bg-white px-4 py-16 sm:px-8 sm:py-24 lg:px-24 lg:py-32 overflow-hidden">
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
    $logoClass = 'w-48 shrink-0 object-contain transition-transform duration-300 hover:scale-105';
    @endphp

    <div class="mx-auto mt-12 flex w-full max-w-8xl flex-col items-center gap-12 sm:mt-20 sm:gap-16">
        <div data-animate="fade-up" class="flex flex-col items-center gap-3">
            <p class="text-center text-3xl font-extrabold font-inter text-blue-300 sm:text-4xl lg:text-5xl">Marcas con las que trabajamos</p>
            <div class="h-1 w-12 bg-green-300" aria-hidden="true"></div>
        </div>

        {{-- Aerolíneas: batch desde la izquierda --}}
        <div class="flex w-full flex-col items-center gap-6">
            <p data-animate="fade-left" class="text-sm font-extrabold font-inter uppercase tracking-wide text-green-300">Aerolíneas</p>
            <div
                data-batch-group
                data-batch-direction="left"
                class="flex flex-wrap items-center justify-center gap-x-10 gap-y-6 sm:gap-x-16">
                @foreach ($airlines as $airline)
                <img
                    data-batch-item
                    src="{{ asset('images/about/' . $airline['src']) }}"
                    alt="{{ $airline['alt'] }}"
                    class="{{ $logoClass }}" />
                @endforeach
            </div>
        </div>

        {{-- Hoteles: batch desde la derecha --}}
        <div class="flex w-full flex-col items-center gap-6">
            <p data-animate="fade-right" class="text-sm font-extrabold font-inter uppercase tracking-wide text-green-300">Cadenas de hoteles</p>
            <div
                data-batch-group
                data-batch-direction="right"
                class="flex flex-wrap items-center justify-center gap-x-16 gap-y-8">
                @foreach ($hotels as $hotel)
                <img
                    data-batch-item
                    src="{{ asset('images/about/' . $hotel['src']) }}"
                    alt="{{ $hotel['alt'] }}"
                    class="{{ $logoClass }}" />
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Misión y visión: Misión desde la izquierda, Visión desde la derecha --}}
<section id="mission" aria-label="Misión y visión" class="mt-12 w-full bg-blue-300 px-4 py-16 sm:mt-20 sm:px-8 sm:py-24 lg:px-24 lg:py-32 overflow-hidden">
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
            <article class="flex h-full flex-col gap-5 rounded-3xl border-l-4 border-green-300 bg-white/5 p-6 transition-all duration-300 hover:-translate-y-0.5 sm:gap-6 sm:p-8">
                <div class="flex size-16 items-center justify-center rounded-lg bg-white/10">
                    <x-dynamic-component :component="'lucide-' . $item['icon']" class="h-8 w-8 text-green-300" />
                </div>
                <div class="flex flex-col gap-2">
                    <p class="text-sm font-extrabold font-inter uppercase tracking-wide text-green-300">{{ $item['label'] }}</p>
                    <h2 class="text-3xl font-extrabold font-inter text-balance text-white lg:text-4xl">{{ $item['title'] }}</h2>
                </div>
                <p class="text-pretty text-base font-medium font-inter leading-8 text-white/80 sm:text-lg">{{ $item['text'] }}</p>
            </article>
        </div>
        @endforeach
    </div>
</section>

{{-- Valores: título desde abajo, cards alternando izquierda/derecha en batch --}}
<section id="values" aria-label="Nuestros valores" class="w-full bg-white px-4 py-16 sm:px-8 sm:py-24 lg:px-24 lg:py-32 overflow-hidden">
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
    <div class="mx-auto flex w-full max-w-7xl flex-col items-center gap-12">
        <div data-animate="fade-up" class="flex flex-col items-center gap-3">
            <h2 class="text-center text-3xl font-extrabold font-inter text-blue-300 sm:text-4xl lg:text-5xl">Nuestros valores</h2>
            <div class="h-1 w-12 bg-green-300" aria-hidden="true"></div>
        </div>

        {{-- Batch alternado: filas impares desde izquierda, pares desde derecha --}}
        <div
            data-batch-group
            data-batch-direction="up"
            class="grid w-full grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 justify-items-center">
            @foreach ($values as $index => $value)
            <div
                data-batch-item
                class="w-full max-w-sm {{ $loop->last && count($values) % 3 !== 0 ? 'lg:col-span-3' : '' }}">
                <article class="flex h-full flex-col items-center gap-4 rounded-3xl p-6 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg sm:p-8">
                    <div class="flex size-16 items-center justify-center rounded-lg bg-green-100">
                        <x-dynamic-component :component="'lucide-' . $value['icon']" class="h-10 w-10 text-green-300" />
                    </div>
                    <h3 class="text-xl font-extrabold font-inter text-blue-300 sm:text-2xl">{{ $value['title'] }}</h3>
                    <p class="text-pretty text-base font-normal font-lato leading-7 text-zinc-500">{{ $value['desc'] }}</p>
                </article>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Equipo: título desde izquierda, cards alternando desde laterales --}}
<section id="team" aria-label="Team" class="mb-12 w-full bg-white px-4 sm:mb-20 sm:px-8 md:px-12 lg:px-16 xl:px-24 overflow-hidden">
    @php $team = [
    ['name' => 'Ana Ornelas', 'role' => 'Gerente General', 'phone' => '9987348273', 'email' => 'gerencia@travel-logic.com', 'avatar' => 'ana.webp'],
    ['name' => 'Danny Mercado', 'role' => 'Gerente Comercial', 'phone' => '9981251330', 'email' => 'producto@travel-logic.com', 'avatar' => 'danny.webp'],
    ['name' => 'Sofia Gerardo', 'role' => 'Ejecutiva de Ventas & RRPP', 'phone' => '9981351534', 'email' => 'ventas@travel-logic.com', 'avatar' => 'sofia.webp'],
    ['name' => 'Fernanda Valdéz', 'role' => 'Especialista de Servicio', 'phone' => '9982404465', 'email' => 'reservas@travel-logic.com', 'avatar' => 'fernanda.webp'],
    ['name' => 'pendiente', 'role' => 'Especialista de Hospedaje', 'phone' => '9982339545', 'email' => 'reservas@travel-logic.com', 'avatar' => 'pendiente.webp'],
    ['name' => 'Yamili Dzib', 'role' => 'Asistente Administrativo', 'phone' => '9982321008', 'email' => 'administracion@travel-logic.com', 'avatar' => 'yamili.webp'],
    ]; @endphp

    <div class="mx-auto w-full max-w-[1600px]">
        <p data-animate="fade-left" class="mb-8 text-3xl font-extrabold font-inter text-blue-300 sm:mb-12 sm:text-4xl lg:text-5xl">El Equipo</p>

        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 lg:gap-10">
            @foreach ($team as $index => $member)
            {{-- Par → entra desde la derecha, impar → desde la izquierda --}}
            <div
                data-animate="{{ $index % 2 === 0 ? 'fade-left' : 'fade-right' }}"
                data-animate-delay="{{ ($index % 3) * 0.12 }}"
                data-animate-distance="80">
                <div class="group relative aspect-[568/488] w-full overflow-hidden bg-white transition-all duration-300 hover:-translate-y-1">
                    <div class="absolute left-[14%] top-[4.5%] h-[59%] w-[45%] overflow-hidden rounded-2xl bg-gray-400">
                        <img src="{{ asset('images/team/' . $member['avatar']) }}" alt="{{ $member['name'] }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                    <div class="absolute bottom-[4%] left-[28%] w-1/2 rounded-tl-2xl rounded-tr-2xl rounded-br-2xl bg-blue-300 p-4 sm:p-6 lg:p-8">
                        <p class="font-inter text-base font-bold leading-5 text-white lg:text-lg">
                            {{ $member['name'] }}
                        </p>
                        <p class="font-inter text-sm font-normal leading-5 text-white/90 lg:text-base">
                            {{ $member['role'] }}
                        </p>
                        <div class="mt-3 flex flex-col gap-1">
                            <a href="tel:{{ $member['phone'] }}" class="font-inter text-xs font-normal leading-5 text-white/80 hover:text-white lg:text-sm">
                                {{ $member['phone'] }}
                            </a>
                            <a href="mailto:{{ $member['email'] }}" class="font-inter text-xs font-normal leading-5 text-white/80 hover:text-white lg:text-sm break-all">
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
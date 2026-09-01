@extends('layouts.app')

@section('title', 'Nosotros - Travel Logic')

@section('content')

<x-animate-in>
    <section id="about" aria-label="Nosotros" class="w-full bg-blue-300 py-16 md:py-24 lg:py-32">
        <div class="mx-auto flex w-full max-w-[1600px] flex-col items-center gap-12 px-6 sm:px-8 md:gap-16 md:px-16 lg:flex-row lg:items-center lg:justify-center lg:gap-20 lg:px-24">
            <div class="group flex w-full shrink-0 flex-col items-center gap-4 sm:flex-row sm:items-stretch lg:w-auto">
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

            <div class="flex w-full max-w-xl flex-col justify-center">
                <div class="mb-6 flex flex-col gap-2">
                    <h1 class="font-inter text-4xl font-semibold leading-tight text-white">Nosotros</h1>
                    <p class="font-inter text-xl font-medium text-white/80">Soluciones integrales y personalizadas.</p>
                </div>
                <div class="border-l-4 border-sky-500 pl-6">
                    <p class="font-inter text-xl font-normal leading-8 text-white">
                        Lorem ipsum dolor sit amet consectetur. In at amet semper velit elit nisi faucibus arcu. Bibendum nulla porttitor faucibus bibendum erat a vulputate sed. Quisque quis viverra turpis at erat vel ut metus congue. Sed senectus ullamcorper imperdiet sit fermentum. Fermentum faucibus proin hac sed condimentum euismod felis risus.
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-animate-in>

<x-animate-in>
    <section id="history" aria-label="History" class="w-full bg-white px-4 py-16 sm:px-8 sm:py-24 lg:px-24 lg:py-32">
        <div class="flex flex-col items-center gap-4">
            <p class="text-3xl font-extrabold font-inter text-blue-300 sm:text-4xl lg:text-5xl">Nuestra Historia</p>
            <div class="flex max-w-7xl flex-col gap-6 text-center text-base font-normal font-lato leading-8 text-black sm:text-lg lg:text-xl">
                <p>Travel Logic nació el 23 de septiembre de 2023 de una idea simple: si ya negociábamos las mejores tarifas hoteleras para nuestra propia operación dentro de APS Holding, ¿por qué no compartir esa ventaja con otras agencias? Así nació una operadora mayorista construida desde la experiencia real de operar y negociar.</p>
                <p>Somos parte de una familia de empresas: <span class="font-bold text-green-400">COMEVA, GATE 48, TRAKEN, SMART AVIATION, BAGGAGE EXPRESS Y VIRION MEDIA</span>, todas unidas por una misma visión. Hoy seguimos con la misma idea original: convertir las mejores tarifas en ventaja competitiva para todo el gremio.</p>
            </div>
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
                <div class="flex flex-col items-center gap-3">
                    <p class="text-center text-3xl font-extrabold font-inter text-blue-300 sm:text-4xl lg:text-5xl">Marcas con las que trabajamos</p>
                    <div class="h-1 w-12 bg-green-300" aria-hidden="true"></div>
                </div>

                <div class="flex w-full flex-col items-center gap-6">
                    <p class="text-sm font-extrabold font-inter uppercase tracking-wide text-green-300">Aerolíneas</p>
                    <div class="flex flex-wrap items-center justify-center gap-x-10 gap-y-6 sm:gap-x-16">
                        @foreach ($airlines as $airline)
                        <img
                            src="{{ asset('images/about/' . $airline['src']) }}"
                            alt="{{ $airline['alt'] }}"
                            class="{{ $logoClass }}" />
                        @endforeach
                    </div>
                </div>

                <div class="flex w-full flex-col items-center gap-6">
                    <p class="text-sm font-extrabold font-inter uppercase tracking-wide text-green-300">Cadenas de hoteles</p>
                    <div class="flex flex-wrap items-center justify-center gap-x-16 gap-y-8">
                        @foreach ($hotels as $hotel)
                        <img
                            src="{{ asset('images/about/' . $hotel['src']) }}"
                            alt="{{ $hotel['alt'] }}"
                            class="{{ $logoClass }}" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-animate-in>

<x-animate-in>
    <section id="mission" aria-label="Misión y visión" class="mt-12 w-full bg-blue-300 px-4 py-16 sm:mt-20 sm:px-8 sm:py-24 lg:px-24 lg:py-32">
        @php
        $missionVision = [
        [
        'label' => 'Nuestro propósito',
        'title' => 'Misión',
        'icon' => 'target',
        'text' => 'Liberar el potencial de las agencias de viajes con soluciones integrales que simplifican su operación y crean experiencias memorables para sus clientes.',
        ],
        [
        'label' => 'Hacia dónde vamos',
        'title' => 'Visión',
        'icon' => 'compass',
        'text' => 'Ser el operador turístico líder, reconocido como el socio estratégico de referencia para agencias de viajes.',
        ],
        ];
        @endphp
        <div class="mx-auto flex max-w-6xl flex-col items-stretch gap-6 lg:flex-row lg:gap-8">
            @foreach ($missionVision as $index => $item)
            <x-animate-in delay="{{ $index * 80 }}" variant="subtle" class="flex-1">
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
            </x-animate-in>
            @endforeach
        </div>
    </section>
</x-animate-in>

<x-animate-in>
    <section id="values" aria-label="Nuestros valores" class="w-full bg-white px-4 py-16 sm:px-8 sm:py-24 lg:px-24 lg:py-32">
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
            <div class="flex flex-col items-center gap-3">
                <h2 class="text-center text-3xl font-extrabold font-inter text-blue-300 sm:text-4xl lg:text-5xl">Nuestros valores</h2>
                <div class="h-1 w-12 bg-green-300" aria-hidden="true"></div>
            </div>

            <div class="flex w-full flex-wrap items-start justify-center gap-x-6 gap-y-2 sm:gap-x-10">
                @foreach ($values as $index => $value)
                <x-animate-in
                    delay="{{ $index * 80 }}"
                    variant="subtle"
                    @class([ 'w-full max-w-sm' , 'lg:mt-16'=> $index % 2 === 1,
                    'lg:mb-16' => $index % 2 === 0,
                    ])
                    >
                    <article class="flex h-full flex-col gap-4 rounded-3xl p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg sm:p-8">
                        <div class="flex size-16 items-center justify-center rounded-lg bg-green-100">
                            <x-dynamic-component :component="'lucide-' . $value['icon']" class="h-10 w-10 text-green-300" />
                        </div>
                        <h3 class="text-xl font-extrabold font-inter text-blue-300 sm:text-2xl">{{ $value['title'] }}</h3>
                        <p class="text-pretty text-base font-normal font-lato leading-7 text-zinc-500">{{ $value['desc'] }}</p>
                    </article>
                </x-animate-in>
                @endforeach
            </div>
        </div>
    </section>
</x-animate-in>

<x-animate-in>
    <section id="team" aria-label="Team" class="mb-12 mt-12 w-full bg-white px-4 sm:mb-20 sm:mt-20 sm:px-8 md:px-12 lg:px-16 xl:px-24">
        @php $team = [
        ['name' => 'Ana Ornelas', 'role' => 'Gerente General', 'phone' => '9987348273', 'email' => 'gerencia@travel-logic.com', 'avatar' => 'ana.webp'],
        ['name' => 'Danny Mercado', 'role' => 'Gerente Comercial', 'phone' => '9981251330', 'email' => 'producto@travel-logic.com', 'avatar' => 'danny.webp'],
        ['name' => 'Sofia Gerardo', 'role' => 'Ejecutiva de Ventas & RRPP', 'phone' => '9981351534', 'email' => 'ventas@travel-logic.com', 'avatar' => 'sofia.webp'],
        ['name' => 'Fernanda Valdéz', 'role' => 'Especialista de Servicio', 'phone' => '9982404465', 'email' => 'reservas@travel-logic.com', 'avatar' => 'fernanda.webp'],
        ['name' => 'pendiente', 'role' => 'Especialista de Hospedaje', 'phone' => '9982339545', 'email' => 'reservas@travel-logic.com', 'avatar' => 'pendiente.webp'],
        ['name' => 'Yamili Dzib', 'role' => 'Asistente Administrativo', 'phone' => '9982321008', 'email' => 'administracion@travel-logic.com', 'avatar' => 'yamili.webp'],
        ]; @endphp

        <div class="mx-auto w-full max-w-[1600px]">
            <p class="mb-8 text-3xl font-extrabold font-inter text-blue-300 sm:mb-12 sm:text-4xl lg:text-5xl">El Equipo</p>

            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 lg:gap-10">
                @foreach ($team as $index => $member)
                <x-animate-in delay="{{ $index * 80 }}" variant="subtle">
                    <div class="relative aspect-[568/488] w-full overflow-hidden bg-white transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                        <div class="absolute left-[14%] top-[4.5%] h-[59%] w-[45%] overflow-hidden rounded-2xl bg-gray-400">
                            <img src="{{ asset('images/team/' . $member['avatar']) }}" alt="{{ $member['name'] }}" class="h-full w-full object-cover">
                        </div>
                        <div class="absolute bottom-[4%] left-[28%] w-[56%] rounded-tl-xl rounded-tr-xl rounded-br-xl bg-blue-300 p-4 sm:p-6 lg:p-8">
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
                </x-animate-in>
                @endforeach
            </div>
        </div>
    </section>
</x-animate-in>

@endsection
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
        <div class="flex max-w-7xl flex-col gap-4 text-center text-base font-medium font-inter leading-6 text-zinc-600 sm:text-lg lg:text-xl">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas dui magna, venenatis in gravida eget, dictum at lectus. Sed ex lectus, laoreet et felis at, ultricies mattis ex. Praesent eu auctor lacus. Nam ipsum lectus, accumsan sit amet nunc non, eleifend placerat orci. Fusce sed tempus nisl. </p>
            <p>Donec eget consectetur nisl. Aliquam fringilla sapien a dapibus vehicula. Vivamus cursus, elit porttitor aliquet scelerisque, justo nisi tincidunt tellus, vitae iaculis nulla enim eu sapien. Praesent venenatis quis augue et mattis. Sed interdum diam sit amet nunc volutpat, id vehicula tortor hendrerit. Curabitur vitae varius ante. Aliquam et nibh lectus.</p>
        </div>
        @php
        $airlines = [
        ['src' => 'aircanada.png', 'alt' => 'Air Canada'],
        ['src' => 'american.png', 'alt' => 'American Airlines'],
        ['src' => 'british.png', 'alt' => 'British Airways'],
        ['src' => 'qatar.png', 'alt' => 'Qatar Airways'],
        ['src' => 'emirates.png', 'alt' => 'Emirates'],
        ['src' => 'southwest.png', 'alt' => 'Southwest Airlines'],
        ['src' => 'turkish.png', 'alt' => 'Turkish Airlines'],
        ];
        @endphp

        <div class="mx-auto mt-12 flex w-full flex-col gap-12 sm:mt-20 sm:gap-16 lg:gap-24">
            @foreach (array_chunk($airlines, 4) as $row)
            <div class="flex flex-wrap items-center justify-center gap-x-8 gap-y-6 sm:gap-x-16 lg:gap-x-24">
                @foreach ($row as $airline)
                <img
                    src="{{ asset('images/about/' . $airline['src']) }}"
                    alt="{{ $airline['alt'] }}"
                    class="h-16 w-32 shrink-0 object-contain transition-transform duration-300 hover:scale-105 sm:h-20 sm:w-48 lg:h-24 lg:w-64" />
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</section>
</x-animate-in>

<x-animate-in>
<section id="mission" aria-label="Mission" class="mt-12 w-full bg-blue-300 px-4 py-16 sm:mt-20 sm:px-8 sm:py-24 lg:px-24 lg:py-32">
    <div class="mx-auto flex max-w-6xl flex-col items-start justify-center gap-12 sm:gap-16 lg:flex-row lg:gap-24">
        <div class="flex max-w-md flex-col items-center justify-center gap-2">
            <p class="text-2xl font-extrabold font-inter text-white">Misión</p>
            <p class="text-center text-base font-medium font-inter text-white/80">Proporcionamos acceso a soluciones integrales y personalizadas que simplifican su operación y les permiten ofrecer experiencias memorables a sus clientes finales.</p>
        </div>
        <div class="flex max-w-md flex-col items-center justify-center gap-2">
            <p class="text-2xl font-extrabold font-inter text-white">Visión</p>
            <p class="text-center text-base font-medium font-inter text-white/80">Ser reconocidos como el socio estratégico de referencia para agencias de viajes mediante nuestro enfoque de.</p>
        </div>
        <div class="flex max-w-md flex-col items-center justify-center gap-2">
            <p class="text-2xl font-extrabold font-inter text-white">Valores</p>
            <p class="text-center text-base font-medium font-inter text-white/80">Tour operador especializado en el mercado B2B que conecta agencias con una amplia red de servicios hoteleros, mejorando su eficiencia y garantizando experiencias de viaje memorables</p>
        </div>
    </div>
</section>
</x-animate-in>

<x-animate-in>
<section id="team" aria-label="Team" class="mb-12 mt-12 w-full bg-white px-4 sm:mb-20 sm:mt-20 sm:px-8 md:px-12 lg:px-16 xl:px-24">
    <div class="mx-auto w-full max-w-[1600px]">
        <p class="mb-8 text-3xl font-extrabold font-inter text-blue-300 sm:mb-12 sm:text-4xl lg:text-5xl">El Equipo</p>

        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 lg:gap-10">
            @foreach (range(1, 6) as $index)
                <x-animate-in delay="{{ $index * 80 }}" variant="subtle">
                    <div class="relative aspect-[568/488] w-full overflow-hidden bg-white transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                        <div class="absolute left-[14%] top-[4.5%] h-[59%] w-[45%] rounded-2xl bg-gray-400"></div>
                        <div class="absolute bottom-[4%] left-[28%] w-[56%] rounded-tl-xl rounded-tr-xl rounded-br-xl bg-blue-300 p-4 sm:p-6 lg:p-8">
                            <p class="font-inter text-sm font-normal leading-5 text-white lg:text-base">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas dui magna, venenatis in gravida eget, dictum at lectus.
                            </p>
                        </div>
                    </div>
                </x-animate-in>
            @endforeach
        </div>
    </div>
</section>
</x-animate-in>

@endsection

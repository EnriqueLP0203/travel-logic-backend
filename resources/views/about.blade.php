@extends('layouts.app')

@section('title', 'Nosotros - Travel Logic')

@section('content')

<section id="about" aria-label="Nosotros" class="w-full bg-blue-300 py-16 md:py-24 lg:py-32">
    <div class="mx-auto flex w-full max-w-[1600px] flex-col items-center gap-12 px-6 sm:px-8 md:gap-16 md:px-16 lg:flex-row lg:items-center lg:justify-center lg:gap-20 lg:px-24">
        <div class="flex shrink-0 items-stretch gap-4">
            <div class="w-80 overflow-hidden rounded-3xl lg:w-96">
                <img
                    src="{{ asset('images/home/frame1.webp') }}"
                    alt="Equipo de Travel Logic"
                    class="h-full w-full object-cover" />
            </div>
            <div class="flex w-80 flex-col gap-4 lg:w-96">
                <div class="min-h-80 flex-1 overflow-hidden rounded-3xl">
                    <img
                        src="{{ asset('images/home/frame2.webp') }}"
                        alt="Oficinas de Travel Logic"
                        class="h-full w-full object-cover" />
                </div>
                <div class="flex gap-4">
                    <div class="size flex-1 overflow-hidden rounded-3xl">
                        <img
                            src="{{ asset('images/home/frame3.webp') }}"
                            alt="Experiencias de viaje"
                            class="h-full w-full object-cover" />
                    </div>
                    <div class="size flex-1 overflow-hidden rounded-3xl">
                        <img
                            src="{{ asset('images/home/frame4.webp') }}"
                            alt="Destinos turísticos"
                            class="h-full w-full object-cover" />
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

<section id="history" aria-label="History" class="w-full bg-white px-24 py-32">
    <div class="flex flex-col gap-4 items-center">
        <p class="text-5xl font-extrabold font-inter text-blue-300">Nuestra Historia</p>
        <div class="max-w-7xl flex flex-col gap-4 text-center text-xl font-medium font-inter text-zinc-600 leading-6">
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

        <div class="mx-auto flex w-full flex-col gap-24 mt-20">
            @foreach (array_chunk($airlines, 4) as $row)
            <div class="flex flex-wrap justify-center gap-x-24 gap-y-6">
                @foreach ($row as $airline)
                <img
                    src="{{ asset('images/about/' . $airline['src']) }}"
                    alt="{{ $airline['alt'] }}"
                    class="w-64 h-24 shrink-0 object-contain" />
                @endforeach
            </div>
            @endforeach
        </div>
    </div>

</section>

<section id="mission" aria-label="Mission" class="w-full bg-blue-300 mt-20 px-24 py-32">
    <div class="flex flex-row gap-24 items-start justify-center">
        <div class="max-w-md flex flex-col gap-2 items-center justify-center">
            <p class="text-2xl text-white font-extrabold font-inter">Misión</p>
            <p class=" text-center text-base font-medium font-inter text-white/80">Proporcionamos acceso a soluciones integrales y personalizadas que simplifican su operación y les permiten ofrecer experiencias memorables a sus clientes finales.</p>
        </div>
        <div class="max-w-md flex flex-col gap-2 items-center justify-center">
            <p class="text-2xl text-white font-extrabold font-inter">Visión</p>
            <p class="text-center text-base font-medium font-inter text-white/80">Ser reconocidos como el socio estratégico de referencia para agencias de viajes mediante nuestro enfoque de.</p>
        </div>
        <div class="max-w-md flex flex-col gap-2 items-center justify-center">
            <p class="text-2xl text-white font-extrabold font-inter">Valores</p>
            <p class="text-center text-base font-medium font-inter text-white/80">Tour operador especializado en el mercado B2B que conecta agencias con una amplia red de servicios hoteleros, mejorando su eficiencia y garantizando experiencias de viaje memorables</p>
        </div>
    </div>

</section>

<section id="team" aria-label="Team" class="w-full bg-blue-300 mt-20 px-24 py-32">

</section>

@endsection
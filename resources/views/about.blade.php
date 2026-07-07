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
                    class="h-full w-full object-cover"
                />
            </div>
            <div class="flex w-80 flex-col gap-4 lg:w-96">
                <div class="min-h-80 flex-1 overflow-hidden rounded-3xl">
                    <img
                        src="{{ asset('images/home/frame2.webp') }}"
                        alt="Oficinas de Travel Logic"
                        class="h-full w-full object-cover"
                    />
                </div>
                <div class="flex gap-4">
                    <div class="size flex-1 overflow-hidden rounded-3xl">
                        <img
                            src="{{ asset('images/home/frame3.webp') }}"
                            alt="Experiencias de viaje"
                            class="h-full w-full object-cover"
                        />
                    </div>
                    <div class="size flex-1 overflow-hidden rounded-3xl">
                        <img
                            src="{{ asset('images/home/frame4.webp') }}"
                            alt="Destinos turísticos"
                            class="h-full w-full object-cover"
                        />
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

<section id="history" aria-label="History" class="w-full bg-blue-300 mt-20 px-24 py-32">

</section>

<section id="mission" aria-label="Mission" class="w-full bg-blue-300 mt-20 px-24 py-32">

</section>

<section id="team" aria-label="Team" class="w-full bg-blue-300 mt-20 px-24 py-32">

</section>

@endsection
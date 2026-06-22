@extends('layouts.app')

@section('title', 'Nosotros - Travel Logic')

@section('content')

<div class="mx-auto w-full max-w-[1600px] px-2 sm:px-3 md:px-4 lg:px-6">

    {{-- Banner image --}}
    <x-animate-in>
        <div class="mb-10 h-64 w-full rounded-lg bg-gray-300 md:mb-12 md:h-80 lg:mb-16 lg:h-96"></div>
    </x-animate-in>

    {{-- Nosotros --}}
    <div class="mb-10 flex flex-col items-center justify-center gap-6 md:mb-14 md:gap-10 lg:mb-20">
        <x-animate-in>
            <p class="text-center text-3xl font-bold text-indigo-950 sm:text-4xl lg:text-5xl">
                NOSOTROS
            </p>
        </x-animate-in>
        <x-animate-in delay="120">
            <p class="mx-auto max-w-4xl text-center text-base font-normal text-indigo-950 sm:text-lg lg:max-w-5xl lg:text-xl">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. In quis
                blandit lorem. In quis turpis congue, accumsan lacus eu, mollis arcu.
                Fusce finibus nec elit a semper. Vivamus auctor pulvinar tincidunt.
                Nunc lacinia urna velit, quis fringilla dui vulputate egestas. Quisque
                lobortis ex eget magna pretium, nec cursus felis lacinia. Nam accumsan
                ante sed libero tincidunt faucibus. Duis nec erat diam. Aenean dui
                nunc, pretiu
            </p>
        </x-animate-in>
    </div>

    {{-- Qué nos diferencia --}}
    <div class="mb-10 md:mb-14 lg:mb-20">
        <x-animate-in>
            <p class="mb-6 text-center text-3xl font-bold text-indigo-950 sm:text-4xl lg:mb-8 lg:text-5xl">
                QUE NOS DIFERENCIA
            </p>
        </x-animate-in>

        <div class="w-full rounded-lg border border-indigo-950/20 p-4 sm:p-6 md:p-8 lg:p-10">

            @php
                $differentiators = [
                    ['delay' => 100],
                    ['delay' => 200],
                    ['delay' => 300],
                    ['delay' => 400],
                ];
            @endphp

            @foreach ($differentiators as $index => $item)
                <x-animate-in delay="{{ $item['delay'] }}">
                    <div class="grid w-full grid-cols-1 items-center gap-6 sm:gap-8 md:grid-cols-[minmax(96px,128px)_minmax(140px,1fr)_minmax(0,2.5fr)] md:gap-10 lg:gap-14 xl:gap-16">
                        <div class="mx-auto size-24 shrink-0 rounded-[52px] bg-gray-300 transition-transform duration-500 ease-out hover:scale-105 motion-reduce:transition-none md:mx-0 md:size-28 lg:size-32" aria-hidden="true"></div>
                        <p class="min-w-0 text-center text-2xl font-semibold text-emerald-500 sm:text-3xl md:text-left lg:text-4xl">LOREM IPSUM</p>
                        <p class="min-w-0 text-base font-normal text-stone-900 sm:text-lg lg:text-xl">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In quis
                            blandit lorem. In quis turpis congue, accumsan lacus eu, mollis
                            arcu. Fusce finibus nec elit a semper. Vivamus auctor pulvinar
                            tincidunt. Nunc lacinia urna velit, quis fringilla dui vulputate
                            egestas. Quisque lobortis ex eget magna pretium, nec cursus felis
                            lacinia. Nam acc
                        </p>
                    </div>
                </x-animate-in>

                @if (!$loop->last)
                    <div class="my-6 border-t border-indigo-950/20 md:my-8 lg:my-10" aria-hidden="true"></div>
                @endif
            @endforeach

        </div>
    </div>

    {{-- Nuestra historia --}}
    <div class="mb-10 md:mb-14 lg:mb-20">
        <div class="flex flex-col items-stretch gap-10 lg:flex-row lg:items-center lg:justify-between lg:gap-12 xl:gap-16">
            <x-animate-in class="flex w-full flex-1 flex-col gap-4 lg:max-w-2xl">
                <p class="mb-6 text-start text-3xl font-bold text-indigo-950 sm:text-4xl lg:mb-8 lg:text-5xl">
                    NUESTRA HISTORIA
                </p>
                <p class="text-base font-normal text-start sm:text-lg lg:text-xl">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In quis
                    blandit lorem. In quis turpis congue, accumsan lacus eu, mollis
                    arcu. Fusce finibus nec elit a semper. Vivamus auctor pulvinar
                    tincidunt. Nunc lacinia urna velit, quis fringilla dui vulputate
                    egestas. Quisque lobortis ex eget magna pretium, nec cursus felis
                    lacinia. Nam accumsan ante sed libero tincidunt faucibus. Duis nec
                    erat diam. Aenean dui nunc, pretium et semper vulputate, mattis in
                    purus. Donec luctus rutrum faucibus.
                </p>
                <p class="text-base font-normal text-start sm:text-lg lg:text-xl">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In quis
                    blandit lorem. In quis turpis congue, accumsan lacus eu, mollis
                    arcu. Fusce finibus nec elit a semper. Vivamus auctor pulvinar
                    tincidunt. Nunc lacinia urna velit, quis fringilla dui vulputate
                    egestas. Quisque lobortis ex eget magna pretium, nec cursus felis
                    lacinia. Nam accumsan ante sed libero tincidunt faucibus. Duis nec
                    erat diam. Aenean dui nunc, pretium et semper vulputate, mattis in
                    purus. Donec luctus rutrum faucibus.
                </p>
            </x-animate-in>

            <x-animate-in delay="180" class="w-full shrink-0 lg:w-[min(100%,520px)] lg:flex-1">
                <div class="h-64 w-full rounded-lg bg-gray-300 sm:h-80 lg:h-[542px]"></div>
            </x-animate-in>
        </div>
    </div>

    {{-- Conoce al equipo --}}
    <div class="mb-10 md:mb-14 lg:mb-20">
        <x-animate-in>
            <p class="mb-6 text-center text-3xl font-bold text-indigo-950 sm:text-4xl lg:mb-8 lg:text-5xl">
                CONOCE AL EQUIPO
            </p>
        </x-animate-in>

        <div class="flex w-full flex-col gap-8 rounded-lg border border-indigo-950/20 p-4 sm:gap-10 sm:p-6 md:p-8 lg:p-10">

            @php
                $teamMembers = [
                    ['delay' => 100,  'role' => 'CEO'],
                    ['delay' => 220,  'role' => 'CEO'],
                    ['delay' => 340,  'role' => 'CEO'],
                ];
            @endphp

            @foreach ($teamMembers as $member)
                <x-animate-in delay="{{ $member['delay'] }}">
                    <div class="flex flex-col items-center gap-8 md:flex-row md:items-start md:gap-10 lg:gap-12">
                        <div class="size-48 shrink-0 rounded-[52px] bg-gray-300 transition-transform duration-500 ease-out hover:scale-[1.02] motion-reduce:transition-none sm:size-56 lg:size-64" aria-hidden="true"></div>
                        <div class="flex min-w-0 flex-1 flex-col justify-center gap-6 sm:gap-8 lg:gap-10">
                            <div class="flex flex-col items-center gap-3 sm:flex-row sm:flex-wrap sm:items-center sm:gap-6 lg:gap-10">
                                <p class="text-center text-2xl font-semibold text-indigo-950 sm:text-left sm:text-3xl lg:text-4xl">
                                    NOMBRE APELLIDO
                                </p>
                                <p class="text-xl font-normal text-emerald-500 sm:text-2xl">{{ $member['role'] }}</p>
                            </div>
                            <p class="min-w-0 text-base font-normal text-stone-900 sm:text-lg lg:text-xl">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. In quis
                                blandit lorem. In quis turpis congue, accumsan lacus eu, mollis
                                arcu. Fusce finibus nec elit a semper. Vivamus auctor pulvinar
                                tincidunt. Nunc lacinia urna velit, quis fringilla dui vulputate
                                egestas. Quisque lobortis ex eget magna pretium, nec cursus
                                felis lacinia. Nam acc
                            </p>
                        </div>
                    </div>
                </x-animate-in>
            @endforeach

        </div>
    </div>

    {{-- Nuestros clientes --}}
    <div class="mb-10 md:mb-14 lg:mb-16">
        <x-animate-in>
            <p class="mb-6 text-center text-3xl font-bold text-indigo-950 sm:text-4xl lg:mb-8 lg:text-5xl">
                NUESTROS CLIENTES
            </p>
        </x-animate-in>

        <div class="grid w-full grid-cols-1 gap-6 sm:gap-8 md:grid-cols-2 md:gap-10 lg:gap-12">

            @php
                $clients = [
                    ['delay' => 100],
                    ['delay' => 200],
                    ['delay' => 300],
                    ['delay' => 400],
                ];
            @endphp

            @foreach ($clients as $client)
                <x-animate-in delay="{{ $client['delay'] }}">
                    <div class="flex w-full gap-4 sm:gap-6">
                        <div class="size-12 shrink-0 rounded-full bg-gray-300 sm:size-14" aria-hidden="true"></div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xl font-semibold text-indigo-950 sm:text-2xl">NOMBRE APELLIDO</p>
                            <p class="text-lg font-normal text-emerald-500 sm:text-2xl">*****</p>
                            <p class="mt-2 text-base font-normal text-stone-900 sm:text-lg">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. In quis
                                blandit lorem. In quis turpis congue, accumsan lacus eu, mollis
                                arcu. Fusce finibus nec elit a semper. Vivamus auctor pulvinar
                                tincidunt. Nunc lacinia urna velit, quis fringilla dui vulputate
                                egestas. Quisque lobortis ex eget magna pretium, nec cursus
                                felis lacinia. Nam acc
                            </p>
                        </div>
                    </div>
                </x-animate-in>
            @endforeach

        </div>
    </div>

    {{-- Contact Form --}}
    <x-contact-form />

</div>

@endsection
@extends('layouts.app')

@section('title', 'Contacto - Travel Logic')

@section('content')
<div class="mx-auto w-full max-w-[1600px] px-2 sm:px-3 md:px-4 lg:px-6">
    <div class="grid grid-cols-2 gap-12 py-24">
        <div class="flex w-3xl flex-col items-start text-left">
            <h1 class="mb-4 text-6xl font-black font-inter text-indigo-950">
                ¿Listo para hacer crecer tu agencia con nosotros?
            </h1>

            <p class="w-lg text-xl font-light font-inter text-indigo-950">
                Únete a más de 200 agencias que ya disfrutan de tarifas exclusivas y herramientas profesionales bajo el modelo One Stop Shop.
            </p>
            <div class="mt-8 w-lg">
                @if (session('success'))
                    <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="flex flex-col gap-4">
                    @csrf

                    <div class="flex flex-col gap-2">
                        <label for="name" class="text-sm font-medium font-lato text-indigo-950">Nombre</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            maxlength="250"
                            required
                            class="w-full h-12 rounded-lg border border-indigo-950/20 p-2 text-sm font-light font-lato text-indigo-950 @error('name') border-red-500 @enderror"
                        />
                        @error('name')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="email" class="text-sm font-medium font-lato text-indigo-950">Correo</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            maxlength="150"
                            required
                            class="w-full h-12 rounded-lg border border-indigo-950/20 p-2 text-sm font-light font-lato text-indigo-950 @error('email') border-red-500 @enderror"
                        />
                        @error('email')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="phone" class="text-sm font-medium font-lato text-indigo-950">Teléfono</label>
                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            value="{{ old('phone') }}"
                            inputmode="numeric"
                            minlength="7"
                            maxlength="15"
                            pattern="[0-9]{7,15}"
                            title="Entre 7 y 15 dígitos, sin espacios"
                            required
                            class="w-full h-12 rounded-lg border border-indigo-950/20 p-2 text-sm font-light font-lato text-indigo-950 @error('phone') border-red-500 @enderror"
                        />
                        <p class="text-xs text-indigo-950/60">Entre 7 y 15 dígitos, sin espacios ni guiones.</p>
                        @error('phone')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-1">
                        <div class="flex items-center gap-2">
                            <input
                                type="checkbox"
                                id="terms"
                                name="terms"
                                value="1"
                                @checked(old('terms'))
                                class="w-4 h-4 @error('terms') border-red-500 @enderror"
                            />
                            <label for="terms" class="text-sm font-light font-lato text-indigo-950">Acepto los <a href="#" class="text-sm font-medium font-lato text-indigo-950">términos y condiciones</a></label>
                        </div>
                        @error('terms')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="w-full h-12 rounded-lg bg-green-300 text-white p-2 text-sm font-medium font-lato">Enviar</button>
                </form>
            </div>
        </div>
        <div class="flex h-full items-center justify-center">
            <img src="{{ asset('images/mapa.png') }}" alt="Contacto" class="w-[720px] h-auto" />
        </div>

    </div>


</div>
@endsection

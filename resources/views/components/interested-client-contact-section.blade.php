@props([
    'inverted' => false,
])

@php
$headingClass = $inverted ? 'text-white' : 'text-indigo-950';
$subtitleClass = $inverted ? 'text-white' : 'text-indigo-950';
$labelClass = $inverted ? 'text-white' : 'text-indigo-950';
$inputClass = $inverted
    ? 'w-full h-12 rounded-lg border border-white/30 bg-white p-2 text-sm font-light font-lato text-blue-300'
    : 'w-full h-12 rounded-lg border border-indigo-950/20 p-2 text-sm font-light font-lato text-indigo-950';
$errorClass = $inverted ? 'text-red-300' : 'text-red-600';
$hintClass = $inverted ? 'text-white/60' : 'text-indigo-950/60';
$successBoxClass = $inverted
    ? 'mb-4 rounded-lg border border-green-200/30 bg-green-300/20 px-4 py-3 text-sm text-white'
    : 'mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700';
$termsLinkClass = $inverted
    ? 'text-sm font-medium font-lato text-green-300 hover:text-green-200'
    : 'text-sm font-medium font-lato text-indigo-950';
@endphp

<div {{ $attributes->merge(['class' => 'grid grid-cols-1 gap-12 py-16 md:py-24 lg:grid-cols-2']) }}>
    <div class="flex w-full flex-col items-start text-left lg:w-3xl">
        <h2 class="mb-4 text-4xl font-black font-inter sm:text-5xl lg:text-6xl {{ $headingClass }}">
            ¿Listo para hacer crecer tu agencia con nosotros?
        </h2>

        <p class="w-full max-w-lg text-lg font-light font-inter sm:text-xl {{ $subtitleClass }}">
            Únete a más de 200 agencias que ya disfrutan de tarifas exclusivas y herramientas profesionales bajo el modelo One Stop Shop.
        </p>

        <div class="mt-8 w-full max-w-lg">
            @if (session('success'))
            <div class="{{ $successBoxClass }}">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="flex flex-col gap-4">
                @csrf

                <div class="flex flex-col gap-2">
                    <label for="name" class="text-sm font-medium font-lato {{ $labelClass }}">Nombre</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        maxlength="250"
                        required
                        class="{{ $inputClass }} @error('name') border-red-500 @enderror"
                    />
                    @error('name')
                    <p class="text-xs {{ $errorClass }}">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label for="email" class="text-sm font-medium font-lato {{ $labelClass }}">Correo</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        maxlength="150"
                        required
                        class="{{ $inputClass }} @error('email') border-red-500 @enderror"
                    />
                    @error('email')
                    <p class="text-xs {{ $errorClass }}">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label for="phone" class="text-sm font-medium font-lato {{ $labelClass }}">Teléfono</label>
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
                        class="{{ $inputClass }} @error('phone') border-red-500 @enderror"
                    />
                    <p class="text-xs {{ $hintClass }}">Entre 7 y 15 dígitos, sin espacios ni guiones.</p>
                    @error('phone')
                    <p class="text-xs {{ $errorClass }}">{{ $message }}</p>
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
                            class="size-4 @error('terms') border-red-500 @enderror"
                        />
                        <label for="terms" class="text-sm font-light font-lato {{ $labelClass }}">
                            Acepto los <a href="#" class="{{ $termsLinkClass }}">términos y condiciones</a>
                        </label>
                    </div>
                    @error('terms')
                    <p class="text-xs {{ $errorClass }}">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="h-12 w-full rounded-lg bg-green-300 p-2 text-sm font-medium font-lato text-white transition-opacity hover:opacity-90">
                    Enviar
                </button>
            </form>
        </div>
    </div>

    <div class="flex h-full items-center justify-center">
        <img src="{{ asset('images/mapa.png') }}" alt="Contacto" class="h-auto w-full max-w-[720px]" />
    </div>
</div>

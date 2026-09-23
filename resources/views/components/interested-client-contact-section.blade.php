@props([
'inverted' => false,
])

@php
$headingClass = $inverted ? 'text-white' : 'text-indigo-950';
$subtitleClass = $inverted ? 'text-white' : 'text-indigo-950';
$labelClass = $inverted ? 'text-white' : 'text-indigo-950';
$inputClass = $inverted
? 'w-full h-12 rounded-lg border border-white/30 bg-white p-2 text-sm font-light font-lato text-blue-300 transition-shadow duration-200 focus:outline-none focus:ring-2 focus:ring-green-300'
: 'w-full h-12 rounded-lg border border-indigo-950/20 p-2 text-sm font-light font-lato text-indigo-950 transition-shadow duration-200 focus:outline-none focus:ring-2 focus:ring-green-300';
$errorClass = $inverted ? 'text-red-300' : 'text-red-600';
$hintClass = $inverted ? 'text-white/60' : 'text-indigo-950/60';
$successBoxClass = $inverted
? 'mb-4 rounded-lg border border-green-200/30 bg-green-300/20 px-4 py-3 text-sm text-white'
: 'mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700';
$termsLinkClass = $inverted
? 'text-sm font-medium font-lato text-green-300 hover:text-green-200'
: 'text-sm font-medium font-lato text-indigo-950';
@endphp

<x-animate-in>
    <div {{ $attributes->merge(['class' => 'grid grid-cols-1 gap-8 sm:gap-10 md:gap-12 py-8 sm:py-12 md:py-16 lg:py-24 lg:grid-cols-2 items-center']) }}>
        <div class="flex w-full flex-col items-start text-left lg:max-w-3xl">
            <h2 class="mb-3 sm:mb-4 text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black font-inter leading-tight {{ $headingClass }}">
                ¿Listo para hacer crecer tu agencia con nosotros?
            </h2>

            <p class="w-full max-w-3xl text-sm sm:text-base md:text-lg font-light font-inter leading-relaxed {{ $subtitleClass }}">
                Completa el formulario y un asesor te contactará con tarifas exclusivas. También puedes contactarnos por WhatsApp o enviarnos un correo.
            </p>

            {{-- Botones de contacto rápido --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 mt-6 sm:mt-8 w-full max-w-2xl">

                {{-- WhatsApp --}}
                @php $waCardClass = $inverted ? 'border border-white/20 bg-white/10' : 'border border-green-200 bg-green-50'; @endphp
                <a href="https://wa.me/529982339545?text=Hola,%20quiero%20hacer%20negocio%20con%20ustedes"
                    target="_blank" rel="noopener noreferrer"
                    class="flex items-center gap-3 rounded-lg p-3 sm:p-4 no-underline transition-all duration-200 hover:-translate-y-0.5 hover:opacity-90 hover:shadow-md {{ $waCardClass }}">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-green-100">
                        <x-lucide-phone class="h-5 w-5 text-green-600" />
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-medium font-inter {{ $inverted ? 'text-white/60' : 'text-gray-500' }}">WhatsApp</p>
                        <p class="text-sm font-semibold font-inter {{ $inverted ? 'text-white' : 'text-gray-900' }}">998 233 9545</p>
                    </div>
                </a>

                {{-- Email --}}
                @php $emailCardClass = $inverted ? 'border border-white/20 bg-white/10' : 'border border-indigo-200 bg-indigo-50'; @endphp
                <a href="mailto:reservaciones@travel-logic.com"
                    class="flex items-center gap-3 rounded-lg p-3 sm:p-4 no-underline transition-all duration-200 hover:-translate-y-0.5 hover:opacity-90 hover:shadow-md {{ $emailCardClass }}">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-indigo-100">
                        <x-lucide-mail class="h-5 w-5 text-indigo-600" />
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-medium font-inter {{ $inverted ? 'text-white/60' : 'text-gray-500' }}">Correo</p>
                        <p class="text-xs sm:text-sm font-semibold font-inter truncate {{ $inverted ? 'text-white' : 'text-gray-900' }}" title="reservaciones@travel-logic.com">reservaciones@travel-logic.com</p>
                    </div>
                </a>

            </div>

            <div class="mt-6 sm:mt-8 w-full max-w-3xl">
                @if (session('success'))
                <div class="{{ $successBoxClass }}">
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="flex flex-col gap-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 md:gap-8">
                        <div class="flex flex-col gap-2">
                            <label for="agency-name" class="text-sm sm:text-base font-medium font-lato {{ $labelClass }}">Nombre de la agencia</label>
                            <input
                                type="text"
                                id="agency-name"
                                name="agency_name"
                                value="{{ old('agency_name') }}"
                                maxlength="250"
                                required
                                class="{{ $inputClass }} @error('name') border-red-500 @enderror" />
                            @error('name')
                            <p class="text-xs {{ $errorClass }}">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="agent-name" class="text-sm sm:text-base font-medium font-lato {{ $labelClass }}">Nombre del agente</label>
                            <input
                                type="text"
                                id="agent-name"
                                name="agent_name"
                                value="{{ old('agent_name') }}"
                                maxlength="250"
                                required
                                class="{{ $inputClass }} @error('agent_name') border-red-500 @enderror" />
                            @error('agent_name')
                            <p class="text-xs {{ $errorClass }}">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="email" class="text-sm sm:text-base font-medium font-lato {{ $labelClass }}">Correo</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                maxlength="150"
                                required
                                class="{{ $inputClass }} @error('email') border-red-500 @enderror" />
                            @error('email')
                            <p class="text-xs {{ $errorClass }}">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="phone" class="text-sm sm:text-base font-medium font-lato {{ $labelClass }}">Teléfono/Whatsapp</label>
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
                                class="{{ $inputClass }} @error('phone') border-red-500 @enderror" />
                            <p class="text-xs {{ $hintClass }}">Entre 7 y 15 dígitos, sin espacios ni guiones.</p>
                            @error('phone')
                            <p class="text-xs {{ $errorClass }}">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="country" class="text-sm sm:text-base font-medium font-lato {{ $labelClass }}">País</label>
                            <input
                                type="text"
                                id="country"
                                name="country"
                                value="{{ old('country') }}"
                                maxlength="250"
                                required
                                class="{{ $inputClass }} @error('country') border-red-500 @enderror" />
                            @error('country')
                            <p class="text-xs {{ $errorClass }}">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="city" class="text-sm sm:text-base font-medium font-lato {{ $labelClass }}">Ciudad</label>
                            <input
                                type="text"
                                id="city"
                                name="city"
                                value="{{ old('city') }}"
                                maxlength="250"
                                required
                                class="{{ $inputClass }} @error('city') border-red-500 @enderror" />
                            @error('city')
                            <p class="text-xs {{ $errorClass }}">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2 sm:col-span-2">
                            <label for="service-type" class="text-sm sm:text-base font-medium font-lato {{ $labelClass }}">Tipo de servicio</label>
                            <input
                                type="text"
                                id="service-type"
                                name="service_type"
                                value="{{ old('service_type') }}"
                                maxlength="250"
                                required
                                class="{{ $inputClass }} @error('service_type') border-red-500 @enderror" />
                            @error('service_type')
                            <p class="text-xs {{ $errorClass }}">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col gap-1 mt-2">
                        <div class="flex items-center gap-2">
                            <input
                                type="checkbox"
                                id="terms"
                                name="terms"
                                value="1"
                                @checked(old('terms'))
                                class="size-4 rounded @error('terms') border-red-500 @enderror" />
                            <label for="terms" class="text-xs sm:text-sm font-light font-lato {{ $labelClass }}">
                                Acepto los <a href="#" class="{{ $termsLinkClass }}">términos y condiciones</a>
                            </label>
                        </div>
                        @error('terms')
                        <p class="text-xs {{ $errorClass }}">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="mt-2 h-11 sm:h-12 w-full rounded-lg bg-green-300 p-2 text-sm sm:text-base font-medium font-lato text-white transition-all duration-200 hover:-translate-y-0.5 hover:opacity-90 hover:shadow-md">
                        Enviar
                    </button>
                </form>
            </div>
        </div>

        <div class="flex h-full items-center justify-center pt-6 lg:pt-0">
            <img src="{{ asset('images/mapa.png') }}" alt="Contacto" class="h-auto w-full max-w-[360px] sm:max-w-[480px] lg:max-w-[720px] object-contain" />
        </div>
    </div>
</x-animate-in>
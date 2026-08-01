@extends('layouts.admin-auth')

@section('title', 'Registro de Agencia | Travel Logic')

@section('content')

@php
    $initialPaso = 1;

    if ($errors->hasAny(['contact_person', 'email', 'country', 'state', 'city', 'phone', 'mobile'])) {
        $initialPaso = 2;
    }

    if ($errors->hasAny([
        'billing_manager', 'billing_address', 'billing_zip_code', 'billing_tax_id',
        'billing_email', 'billing_country', 'billing_state', 'billing_city',
        'billing_phone', 'billing_phone_2', 'billing_mobile', 'billing_same_as_contact',
    ])) {
        $initialPaso = 3;
    }
@endphp

{{-- Registro de agencia en 3 pasos.
     x-show (no x-if) mantiene los inputs en el DOM para no perder los valores al cambiar de paso. --}}
<div
    x-data="{
        paso: {{ $initialPaso }},
        billingSameAsContact: {{ old('billing_same_as_contact') ? 'true' : 'false' }}
    }"
    class="relative min-h-screen grid grid-cols-1"
    :class="paso === 3 ? 'lg:grid-cols-3' : 'lg:grid-cols-2'"
>

    <a
        href="{{ route('home') }}"
        class="absolute left-4 top-4 z-10 inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold font-montserrat text-indigo-950 transition-opacity hover:opacity-80 sm:left-6 sm:top-6"
    >
        <x-lucide-arrow-left class="h-4 w-4" />
        Volver al inicio
    </a>

    <div
        class="relative hidden bg-[#D9D9D9] lg:block"
        :class="paso === 3 ? 'lg:col-span-1' : ''"
    >
        <div class="flex h-full min-h-[680px] w-full items-center justify-center">
            <x-lucide-user class="h-16 w-16 text-gray-400" />
        </div>
    </div>

    <div
        class="flex items-center justify-center px-6 py-12 sm:px-10 lg:px-16"
        :class="paso === 3 ? 'lg:col-span-2' : ''"
    >
        <div class="w-full" :class="paso === 3 ? 'max-w-3xl' : 'max-w-md'">

            @if (session('success'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    Revisa los campos marcados e intenta de nuevo.
                </div>
            @endif

            <h1 class="text-center text-3xl font-black font-montserrat text-indigo-950">
                <span x-show="paso !== 3">Crear Cuenta</span>
                <span x-show="paso === 3" x-cloak>Información de facturación</span>
            </h1>

            <div class="mt-6 flex items-center justify-center gap-2">
                <div
                    class="flex size-8 shrink-0 items-center justify-center rounded-full border-2 text-xs font-bold font-montserrat transition-colors"
                    :class="paso > 1 ? 'border-green-300 bg-green-300 text-white' : 'border-green-300 text-green-300'"
                >
                    <span x-show="paso === 1">01</span>
                    <svg x-show="paso > 1" x-cloak class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <div class="h-0.5 w-12 shrink-0 transition-colors" :class="paso > 1 ? 'bg-green-300' : 'bg-gray-300'"></div>

                <div
                    class="flex size-8 shrink-0 items-center justify-center rounded-full border-2 text-xs font-bold font-montserrat transition-colors"
                    :class="paso > 2 ? 'border-green-300 bg-green-300 text-white' : (paso === 2 ? 'border-green-300 text-green-300' : 'border-gray-300 text-gray-400')"
                >
                    <span x-show="paso <= 2">02</span>
                    <svg x-show="paso > 2" x-cloak class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <div class="h-0.5 w-12 shrink-0 transition-colors" :class="paso > 2 ? 'bg-green-300' : 'bg-gray-300'"></div>

                <div
                    class="flex size-8 shrink-0 items-center justify-center rounded-full border-2 text-xs font-bold font-montserrat transition-colors"
                    :class="paso === 3 ? 'border-green-300 text-green-300' : 'border-gray-300 text-gray-400'"
                >
                    03
                </div>
            </div>

            <form
                method="POST"
                action="{{ route('register-agency.store') }}"
                class="mt-8"
            >
                @csrf

                {{-- PASO 1 --}}
                <div x-show="paso === 1" class="flex flex-col gap-5">
                    <div class="flex flex-col gap-1.5">
                        <label for="agency_username" class="text-sm font-medium font-montserrat text-indigo-950">Nombre de Usuario</label>
                        <input id="agency_username" type="text" name="username" value="{{ old('username') }}"
                            class="h-12 w-full rounded-lg border px-4 text-base font-montserrat text-stone-900 placeholder:text-stone-900/40 focus:outline-none focus:ring-2 focus:ring-green-300/40 @error('username') border-red-400 @else border-stone-300 @enderror" />
                        @error('username')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="agency_name" class="text-sm font-medium font-montserrat text-indigo-950">Nombre de la Agencia</label>
                        <input id="agency_name" type="text" name="agency_name" value="{{ old('agency_name') }}"
                            class="h-12 w-full rounded-lg border px-4 text-base font-montserrat text-stone-900 placeholder:text-stone-900/40 focus:outline-none focus:ring-2 focus:ring-green-300/40 @error('agency_name') border-red-400 @else border-stone-300 @enderror" />
                        @error('agency_name')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="agency_legal_name" class="text-sm font-medium font-montserrat text-indigo-950">Nombre fiscal</label>
                        <input id="agency_legal_name" type="text" name="legal_name" value="{{ old('legal_name') }}"
                            class="h-12 w-full rounded-lg border px-4 text-base font-montserrat text-stone-900 placeholder:text-stone-900/40 focus:outline-none focus:ring-2 focus:ring-green-300/40 @error('legal_name') border-red-400 @else border-stone-300 @enderror" />
                        @error('legal_name')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="agency_logo_url" class="text-sm font-medium font-montserrat text-indigo-950">Enlace del logotipo</label>
                        <input id="agency_logo_url" type="url" name="logo_url" value="{{ old('logo_url') }}"
                            placeholder="https://drive.google.com/..."
                            class="h-12 w-full rounded-lg border px-4 text-base font-montserrat text-stone-900 placeholder:text-stone-900/40 focus:outline-none focus:ring-2 focus:ring-green-300/40 @error('logo_url') border-red-400 @else border-stone-300 @enderror" />
                        <p class="text-xs text-slate-500">Pega un enlace compartido (Google Drive, Dropbox, etc.) para descargar el logotipo.</p>
                        @error('logo_url')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="agency_password" class="text-sm font-medium font-montserrat text-indigo-950">Contraseña</label>
                        <input id="agency_password" type="password" name="password"
                            class="h-12 w-full rounded-lg border px-4 text-base font-montserrat text-stone-900 placeholder:text-stone-900/40 focus:outline-none focus:ring-2 focus:ring-green-300/40 @error('password') border-red-400 @else border-stone-300 @enderror" />
                        @error('password')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="agency_password_confirm" class="text-sm font-medium font-montserrat text-indigo-950">Confirmar contraseña</label>
                        <input id="agency_password_confirm" type="password" name="password_confirmation"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 placeholder:text-stone-900/40 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <button type="button" x-on:click="paso = 2"
                        class="mt-2 h-12 w-full rounded-lg bg-green-300 text-base font-bold font-montserrat text-white transition-opacity hover:opacity-90">
                        Siguiente
                    </button>
                </div>

                {{-- PASO 2 --}}
                <div x-show="paso === 2" x-cloak class="flex flex-col gap-5">
                    <div class="flex flex-col gap-1.5">
                        <label for="contact_person" class="text-sm font-medium font-montserrat text-indigo-950">Persona de contacto</label>
                        <input id="contact_person" type="text" name="contact_person" value="{{ old('contact_person') }}"
                            class="h-12 w-full rounded-lg border px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40 @error('contact_person') border-red-400 @else border-stone-300 @enderror" />
                        @error('contact_person')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="contact_email" class="text-sm font-medium font-montserrat text-indigo-950">Correo electrónico</label>
                        <input id="contact_email" type="email" name="email" value="{{ old('email') }}"
                            class="h-12 w-full rounded-lg border px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40 @error('email') border-red-400 @else border-stone-300 @enderror" />
                        @error('email')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="contact_country" class="text-sm font-medium font-montserrat text-indigo-950">País</label>
                        <input id="contact_country" type="text" name="country" value="{{ old('country') }}"
                            class="h-12 w-full rounded-lg border px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40 @error('country') border-red-400 @else border-stone-300 @enderror" />
                        @error('country')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="contact_state" class="text-sm font-medium font-montserrat text-indigo-950">Estado</label>
                        <input id="contact_state" type="text" name="state" value="{{ old('state') }}"
                            class="h-12 w-full rounded-lg border px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40 @error('state') border-red-400 @else border-stone-300 @enderror" />
                        @error('state')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="contact_city" class="text-sm font-medium font-montserrat text-indigo-950">Ciudad</label>
                        <input id="contact_city" type="text" name="city" value="{{ old('city') }}"
                            class="h-12 w-full rounded-lg border px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40 @error('city') border-red-400 @else border-stone-300 @enderror" />
                        @error('city')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="contact_phone" class="text-sm font-medium font-montserrat text-indigo-950">Teléfono</label>
                        <input id="contact_phone" type="tel" name="phone" value="{{ old('phone') }}"
                            class="h-12 w-full rounded-lg border px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40 @error('phone') border-red-400 @else border-stone-300 @enderror" />
                        @error('phone')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="contact_mobile" class="text-sm font-medium font-montserrat text-indigo-950">Teléfono móvil</label>
                        <input id="contact_mobile" type="tel" name="mobile" value="{{ old('mobile') }}"
                            class="h-12 w-full rounded-lg border px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40 @error('mobile') border-red-400 @else border-stone-300 @enderror" />
                        @error('mobile')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <button type="button" x-on:click="paso = 3"
                        class="mt-2 h-12 w-full rounded-lg bg-green-300 text-base font-bold font-montserrat text-white transition-opacity hover:opacity-90">
                        Siguiente
                    </button>

                    <button type="button" x-on:click="paso = 1"
                        class="flex h-12 w-full items-center justify-center gap-2 rounded-lg border border-stone-300 text-base font-semibold font-montserrat text-indigo-950 transition-opacity hover:opacity-80">
                        <x-lucide-arrow-left class="h-4 w-4" />
                        Regresar
                    </button>
                </div>

                {{-- PASO 3 --}}
                <div x-show="paso === 3" x-cloak class="grid grid-cols-1 gap-x-8 gap-y-5 md:grid-cols-2">
                    <div class="flex flex-col gap-1.5">
                        <label for="billing_manager" class="text-sm font-medium font-montserrat text-indigo-950">Encargado de facturación</label>
                        <input id="billing_manager" type="text" name="billing_manager" value="{{ old('billing_manager') }}"
                            placeholder="Opcional: si es la misma persona de contacto, déjalo vacío"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="billing_address" class="text-sm font-medium font-montserrat text-indigo-950">Dirección</label>
                        <input id="billing_address" type="text" name="billing_address" value="{{ old('billing_address') }}"
                            class="h-12 w-full rounded-lg border px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40 @error('billing_address') border-red-400 @else border-stone-300 @enderror" />
                        @error('billing_address')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="billing_zip" class="text-sm font-medium font-montserrat text-indigo-950">Código Postal</label>
                        <input id="billing_zip" type="text" name="billing_zip_code" value="{{ old('billing_zip_code') }}"
                            class="h-12 w-full rounded-lg border px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40 @error('billing_zip_code') border-red-400 @else border-stone-300 @enderror" />
                        @error('billing_zip_code')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="billing_tax_id" class="text-sm font-medium font-montserrat text-indigo-950">Código fiscal/identidad</label>
                        <input id="billing_tax_id" type="text" name="billing_tax_id" value="{{ old('billing_tax_id') }}"
                            class="h-12 w-full rounded-lg border px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40 @error('billing_tax_id') border-red-400 @else border-stone-300 @enderror" />
                        @error('billing_tax_id')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="billing_phone_2" class="text-sm font-medium font-montserrat text-indigo-950">Teléfono 2 (opcional)</label>
                        <input id="billing_phone_2" type="tel" name="billing_phone_2" value="{{ old('billing_phone_2') }}"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="inline-flex cursor-pointer items-center gap-2 text-sm font-medium font-montserrat text-indigo-950">
                            <input
                                type="checkbox"
                                name="billing_same_as_contact"
                                value="1"
                                x-model="billingSameAsContact"
                                class="size-4 rounded border-stone-300 text-green-400 focus:ring-green-300/40"
                                @checked(old('billing_same_as_contact'))
                            />
                            Usar los mismos datos de contacto para facturación
                        </label>
                    </div>

                    <div x-show="!billingSameAsContact" x-cloak class="contents">
                        <div class="flex flex-col gap-1.5">
                            <label for="billing_email" class="text-sm font-medium font-montserrat text-indigo-950">Correo electrónico</label>
                            <input id="billing_email" type="email" name="billing_email" value="{{ old('billing_email') }}"
                                class="h-12 w-full rounded-lg border px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40 @error('billing_email') border-red-400 @else border-stone-300 @enderror" />
                            @error('billing_email')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="billing_country" class="text-sm font-medium font-montserrat text-indigo-950">País</label>
                            <input id="billing_country" type="text" name="billing_country" value="{{ old('billing_country') }}"
                                class="h-12 w-full rounded-lg border px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40 @error('billing_country') border-red-400 @else border-stone-300 @enderror" />
                            @error('billing_country')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="billing_state" class="text-sm font-medium font-montserrat text-indigo-950">Estado</label>
                            <input id="billing_state" type="text" name="billing_state" value="{{ old('billing_state') }}"
                                class="h-12 w-full rounded-lg border px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40 @error('billing_state') border-red-400 @else border-stone-300 @enderror" />
                            @error('billing_state')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="billing_city" class="text-sm font-medium font-montserrat text-indigo-950">Ciudad</label>
                            <input id="billing_city" type="text" name="billing_city" value="{{ old('billing_city') }}"
                                class="h-12 w-full rounded-lg border px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40 @error('billing_city') border-red-400 @else border-stone-300 @enderror" />
                            @error('billing_city')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="billing_phone" class="text-sm font-medium font-montserrat text-indigo-950">Teléfono</label>
                            <input id="billing_phone" type="tel" name="billing_phone" value="{{ old('billing_phone') }}"
                                class="h-12 w-full rounded-lg border px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40 @error('billing_phone') border-red-400 @else border-stone-300 @enderror" />
                            @error('billing_phone')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="billing_mobile" class="text-sm font-medium font-montserrat text-indigo-950">Teléfono móvil</label>
                            <input id="billing_mobile" type="tel" name="billing_mobile" value="{{ old('billing_mobile') }}"
                                class="h-12 w-full rounded-lg border px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40 @error('billing_mobile') border-red-400 @else border-stone-300 @enderror" />
                            @error('billing_mobile')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="mt-4 flex flex-col items-center gap-3 md:col-span-2">
                        <button type="submit"
                            class="h-12 w-full max-w-xs rounded-lg bg-green-300 text-base font-bold font-montserrat text-white transition-opacity hover:opacity-90">
                            Enviar solicitud
                        </button>

                        <button type="button" x-on:click="paso = 2"
                            class="flex h-12 w-full max-w-xs items-center justify-center gap-2 rounded-lg border border-stone-300 text-base font-semibold font-montserrat text-indigo-950 transition-opacity hover:opacity-80">
                            <x-lucide-arrow-left class="h-4 w-4" />
                            Regresar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

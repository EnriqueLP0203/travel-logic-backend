@extends('layouts.admin-auth')

@section('title', 'Registro de Agencia | Travel Logic')

@section('content')

{{-- Registro de agencia en 3 pasos.
     Solo visual: los botones cambian de paso con Alpine, no envian nada.
     x-show (no x-if) mantiene los inputs en el DOM para no perder los valores al cambiar de paso. --}}
<div
    x-data="{ paso: 1 }"
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

    {{-- Columna izquierda: imagen --}}
    <div
        class="relative hidden bg-[#D9D9D9] lg:block"
        :class="paso === 3 ? 'lg:col-span-1' : ''"
    >
        {{-- Cuando la imagen este exportada, reemplazar este bloque por un <img>
             con class="absolute inset-0 h-full w-full object-cover" --}}
        <div class="flex h-full min-h-[680px] w-full items-center justify-center">
            <x-lucide-user class="h-16 w-16 text-gray-400" />
        </div>
    </div>

    {{-- Columna derecha: formulario --}}
    <div
        class="flex items-center justify-center px-6 py-12 sm:px-10 lg:px-16"
        :class="paso === 3 ? 'lg:col-span-2' : ''"
    >
        <div class="w-full" :class="paso === 3 ? 'max-w-3xl' : 'max-w-md'">

            <h1 class="text-center text-3xl font-black font-montserrat text-indigo-950">
                <span x-show="paso !== 3">Crear Cuenta</span>
                <span x-show="paso === 3" x-cloak>Información de facturación</span>
            </h1>

            {{-- Indicador de pasos (01 - 02 - 03) --}}
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

            <form class="mt-8">

                {{-- ============ PASO 1 ============ --}}
                <div x-show="paso === 1" class="flex flex-col gap-5">

                    <div class="flex flex-col gap-1.5">
                        <label for="agency_username" class="text-sm font-medium font-montserrat text-indigo-950">Nombre de Usuario</label>
                        <input id="agency_username" type="text" name="username"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 placeholder:text-stone-900/40 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="agency_name" class="text-sm font-medium font-montserrat text-indigo-950">Nombre de la Agencia</label>
                        <input id="agency_name" type="text" name="agency_name"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 placeholder:text-stone-900/40 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="agency_legal_name" class="text-sm font-medium font-montserrat text-indigo-950">Nombre fiscal</label>
                        <input id="agency_legal_name" type="text" name="legal_name"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 placeholder:text-stone-900/40 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="agency_logo" class="text-sm font-medium font-montserrat text-indigo-950">Subir logotipo</label>
                        <input id="agency_logo" type="file" name="logo" accept="image/*"
                            class="w-full rounded-lg border border-stone-300 px-4 py-3 text-sm font-montserrat text-stone-900 file:mr-4 file:rounded-md file:border-0 file:bg-green-300 file:px-3 file:py-1.5 file:text-xs file:font-bold file:text-white focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="agency_password" class="text-sm font-medium font-montserrat text-indigo-950">Contraseña</label>
                        <input id="agency_password" type="password" name="password"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 placeholder:text-stone-900/40 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
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

                    <p class="text-center text-sm font-normal font-montserrat text-slate-500">
                        ¿Ya tienes cuenta?
                        <a class="cursor-pointer font-semibold text-green-400 hover:underline">Iniciar sesión</a>
                    </p>
                </div>

                {{-- ============ PASO 2 ============ --}}
                <div x-show="paso === 2" x-cloak class="flex flex-col gap-5">

                    <div class="flex flex-col gap-1.5">
                        <label for="contact_person" class="text-sm font-medium font-montserrat text-indigo-950">Persona de contacto</label>
                        <input id="contact_person" type="text" name="contact_person"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 placeholder:text-stone-900/40 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="contact_email" class="text-sm font-medium font-montserrat text-indigo-950">Correo electrónico</label>
                        <input id="contact_email" type="email" name="email"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 placeholder:text-stone-900/40 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="contact_country" class="text-sm font-medium font-montserrat text-indigo-950">País</label>
                        <input id="contact_country" type="text" name="country"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 placeholder:text-stone-900/40 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="contact_state" class="text-sm font-medium font-montserrat text-indigo-950">Estado</label>
                        <input id="contact_state" type="text" name="state"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 placeholder:text-stone-900/40 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="contact_city" class="text-sm font-medium font-montserrat text-indigo-950">Ciudad</label>
                        <input id="contact_city" type="text" name="city"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 placeholder:text-stone-900/40 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="contact_phone" class="text-sm font-medium font-montserrat text-indigo-950">Teléfono</label>
                        <input id="contact_phone" type="tel" name="phone"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 placeholder:text-stone-900/40 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="contact_mobile" class="text-sm font-medium font-montserrat text-indigo-950">Teléfono móvil</label>
                        <input id="contact_mobile" type="tel" name="mobile"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 placeholder:text-stone-900/40 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <button type="button" x-on:click="paso = 3"
                        class="mt-2 h-12 w-full rounded-lg bg-green-300 text-base font-bold font-montserrat text-white transition-opacity hover:opacity-90">
                        Siguiente
                    </button>

                    <button
                        type="button"
                        x-on:click="paso = 1"
                        class="flex h-12 w-full items-center justify-center gap-2 rounded-lg border border-stone-300 text-base font-semibold font-montserrat text-indigo-950 transition-opacity hover:opacity-80"
                    >
                        <x-lucide-arrow-left class="h-4 w-4" />
                        Regresar
                    </button>
                </div>

                {{-- ============ PASO 3 ============ --}}
                <div x-show="paso === 3" x-cloak class="grid grid-cols-1 gap-x-8 gap-y-5 md:grid-cols-2">

                    <div class="flex flex-col gap-1.5">
                        <label for="billing_manager" class="text-sm font-medium font-montserrat text-indigo-950">Encargado Facturación</label>
                        <input id="billing_manager" type="text" name="billing_manager"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="billing_agency_name" class="text-sm font-medium font-montserrat text-indigo-950">Nombre de la agencia</label>
                        <input id="billing_agency_name" type="text" name="billing_agency_name"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="billing_email" class="text-sm font-medium font-montserrat text-indigo-950">Correo electrónico</label>
                        <input id="billing_email" type="email" name="billing_email"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="billing_address" class="text-sm font-medium font-montserrat text-indigo-950">Dirección</label>
                        <input id="billing_address" type="text" name="billing_address"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="billing_country" class="text-sm font-medium font-montserrat text-indigo-950">País</label>
                        <input id="billing_country" type="text" name="billing_country"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="billing_state" class="text-sm font-medium font-montserrat text-indigo-950">Estado</label>
                        <input id="billing_state" type="text" name="billing_state"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="billing_city" class="text-sm font-medium font-montserrat text-indigo-950">Ciudad</label>
                        <input id="billing_city" type="text" name="billing_city"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="billing_zip" class="text-sm font-medium font-montserrat text-indigo-950">Código Postal</label>
                        <input id="billing_zip" type="text" name="billing_zip_code"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="billing_phone" class="text-sm font-medium font-montserrat text-indigo-950">Teléfono</label>
                        <input id="billing_phone" type="tel" name="billing_phone"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="billing_phone_2" class="text-sm font-medium font-montserrat text-indigo-950">Teléfono 2</label>
                        <input id="billing_phone_2" type="tel" name="billing_phone_2"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="billing_mobile" class="text-sm font-medium font-montserrat text-indigo-950">Teléfono móvil</label>
                        <input id="billing_mobile" type="tel" name="billing_mobile"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="billing_tax_id" class="text-sm font-medium font-montserrat text-indigo-950">Código fiscal/identidad</label>
                        <input id="billing_tax_id" type="text" name="billing_tax_id"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="billing_password" class="text-sm font-medium font-montserrat text-indigo-950">Contraseña</label>
                        <input id="billing_password" type="password" name="billing_password"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="billing_password_confirm" class="text-sm font-medium font-montserrat text-indigo-950">Confirmar contraseña</label>
                        <input id="billing_password_confirm" type="password" name="billing_password_confirmation"
                            class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                    </div>

                    <div class="mt-4 flex flex-col items-center gap-3 md:col-span-2">
                        <button type="button"
                            class="h-12 w-full max-w-xs rounded-lg bg-green-300 text-base font-bold font-montserrat text-white transition-opacity hover:opacity-90">
                            Siguiente
                        </button>

                        <button
                            type="button"
                            x-on:click="paso = 2"
                            class="flex h-12 w-full max-w-xs items-center justify-center gap-2 rounded-lg border border-stone-300 text-base font-semibold font-montserrat text-indigo-950 transition-opacity hover:opacity-80"
                        >
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

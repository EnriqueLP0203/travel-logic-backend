@extends('layouts.app')

@section('title', 'Registro de Agencia | Travel Logic')

@section('content')

{{-- Registro de agencia en 2 pasos.
     Solo visual: los botones cambian de paso con Alpine, no envian nada. --}}
<div x-data="{ paso: 1 }" class="grid grid-cols-1 lg:grid-cols-2">

    {{-- Columna izquierda: imagen --}}
    <div class="relative hidden min-h-[640px] bg-[#D9D9D9] lg:block">
        {{-- Cuando la imagen este exportada, reemplazar este bloque por un <img>
             con class="absolute inset-0 h-full w-full object-cover" --}}
        <div class="flex h-full w-full items-center justify-center">
            <svg class="h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9.75L12 3l9 6.75V21a.75.75 0 01-.75.75H3.75A.75.75 0 013 21V9.75z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 21V12h6v9" />
            </svg>
        </div>
    </div>

    {{-- Columna derecha: formulario --}}
    <div class="flex items-center justify-center px-6 py-12 sm:px-10 lg:px-16">
        <div class="w-full max-w-md">

            <h1 class="text-center text-3xl font-black font-montserrat text-indigo-950">
                Crear Cuenta
            </h1>

            {{-- Indicador de pasos (01 - 02 - 03).
                 El paso 03 es facturacion, siempre pendiente en esta vista. --}}
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
                    :class="paso === 2 ? 'border-green-300 text-green-300' : 'border-gray-300 text-gray-400'"
                >
                    02
                </div>

                <div class="h-0.5 w-12 shrink-0 bg-gray-300"></div>

                <div class="flex size-8 shrink-0 items-center justify-center rounded-full border-2 border-gray-300 text-xs font-bold font-montserrat text-gray-400">
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

                    <a href="{{ route('billing') }}"
                        class="mt-2 flex h-12 w-full items-center justify-center rounded-lg bg-green-300 text-base font-bold font-montserrat text-white transition-opacity hover:opacity-90">
                        Siguiente
                    </a>

                    <button type="button" x-on:click="paso = 1"
                        class="text-center text-sm font-semibold font-montserrat text-slate-500 hover:underline">
                        Regresar
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
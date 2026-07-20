@extends('layouts.app')

@section('title', 'Información de facturación | Travel Logic')

@section('content')

{{-- Informacion de facturacion: paso 03 del registro. Solo visual. --}}
<div class="grid grid-cols-1 lg:grid-cols-3">

    {{-- Columna izquierda: imagen --}}
    <div class="relative hidden min-h-[680px] bg-[#D9D9D9] lg:col-span-1 lg:block">
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
    <div class="flex items-center justify-center px-6 py-12 sm:px-10 lg:col-span-2 lg:px-16">
        <div class="w-full max-w-3xl">

            <h1 class="text-center text-3xl font-black font-montserrat text-indigo-950">
                Información de facturación
            </h1>

            {{-- Indicador de pasos: 01 y 02 completados, 03 activo. --}}
            <div class="mt-6 flex items-center justify-center gap-2">

                <div class="flex size-8 shrink-0 items-center justify-center rounded-full border-2 border-green-300 bg-green-300 text-white">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <div class="h-0.5 w-12 shrink-0 bg-green-300"></div>

                <div class="flex size-8 shrink-0 items-center justify-center rounded-full border-2 border-green-300 bg-green-300 text-white">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <div class="h-0.5 w-12 shrink-0 bg-green-300"></div>

                <div class="flex size-8 shrink-0 items-center justify-center rounded-full border-2 border-green-300 text-xs font-bold font-montserrat text-green-300">
                    03
                </div>
            </div>

            <form class="mt-10 grid grid-cols-1 gap-x-8 gap-y-5 md:grid-cols-2">

                <div class="flex flex-col gap-1.5">
                    <label for="billing_manager" class="text-sm font-medium font-montserrat text-indigo-950">Encargado Facturación</label>
                    <input id="billing_manager" type="text" name="billing_manager"
                        class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="billing_agency_name" class="text-sm font-medium font-montserrat text-indigo-950">Nombre de la agencia</label>
                    <input id="billing_agency_name" type="text" name="agency_name"
                        class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="billing_email" class="text-sm font-medium font-montserrat text-indigo-950">Correo electrónico</label>
                    <input id="billing_email" type="email" name="email"
                        class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="billing_address" class="text-sm font-medium font-montserrat text-indigo-950">Dirección</label>
                    <input id="billing_address" type="text" name="address"
                        class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="billing_country" class="text-sm font-medium font-montserrat text-indigo-950">País</label>
                    <input id="billing_country" type="text" name="country"
                        class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="billing_state" class="text-sm font-medium font-montserrat text-indigo-950">Estado</label>
                    <input id="billing_state" type="text" name="state"
                        class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="billing_city" class="text-sm font-medium font-montserrat text-indigo-950">Ciudad</label>
                    <input id="billing_city" type="text" name="city"
                        class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="billing_zip" class="text-sm font-medium font-montserrat text-indigo-950">Código Postal</label>
                    <input id="billing_zip" type="text" name="zip_code"
                        class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="billing_phone" class="text-sm font-medium font-montserrat text-indigo-950">Teléfono</label>
                    <input id="billing_phone" type="tel" name="phone"
                        class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="billing_phone_2" class="text-sm font-medium font-montserrat text-indigo-950">Teléfono 2</label>
                    <input id="billing_phone_2" type="tel" name="phone_2"
                        class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="billing_mobile" class="text-sm font-medium font-montserrat text-indigo-950">Teléfono móvil</label>
                    <input id="billing_mobile" type="tel" name="mobile"
                        class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="billing_tax_id" class="text-sm font-medium font-montserrat text-indigo-950">Código fiscal/identidad</label>
                    <input id="billing_tax_id" type="text" name="tax_id"
                        class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="billing_password" class="text-sm font-medium font-montserrat text-indigo-950">Contraseña</label>
                    <input id="billing_password" type="password" name="password"
                        class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="billing_password_confirm" class="text-sm font-medium font-montserrat text-indigo-950">Confirmar contraseña</label>
                    <input id="billing_password_confirm" type="password" name="password_confirmation"
                        class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base font-montserrat text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-300/40" />
                </div>

                <div class="mt-4 flex justify-center md:col-span-2">
                    <button type="button"
                        class="h-12 w-full max-w-xs rounded-lg bg-green-300 text-base font-bold font-montserrat text-white transition-opacity hover:opacity-90">
                        Siguiente
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
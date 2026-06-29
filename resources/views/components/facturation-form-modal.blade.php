@props([
    'name' => 'facturation',
])

@php
    $fieldClass = 'h-12 w-full border-b border-neutral-300 bg-slate-100 px-4 py-3 text-base text-stone-900 placeholder:text-zinc-500 focus:border-indigo-400 focus:outline-none';
    $labelClass = 'text-sm font-normal text-stone-900';
    $checkboxClass = 'size-4 shrink-0 rounded-[3px] border border-neutral-400 accent-indigo-950';
@endphp

<div
    data-modal="{{ $name }}"
    role="dialog"
    aria-modal="true"
    aria-labelledby="{{ $name }}-title"
    class="fixed inset-0 z-[100] hidden items-center justify-center p-4"
>
    {{-- Overlay --}}
    <div data-modal-close class="absolute inset-0 bg-stone-900/50"></div>

    {{-- Contenedor del modal --}}
    <div class="relative z-10 flex max-h-[90vh] w-full max-w-5xl flex-col gap-12 overflow-y-auto rounded-lg bg-white p-6 shadow-2xl sm:p-10 lg:p-12">
        {{-- Botón cerrar --}}
        <button
            type="button"
            data-modal-close
            aria-label="Cerrar"
            class="absolute right-4 top-4 flex h-9 w-9 items-center justify-center rounded-full text-stone-500 transition-colors duration-200 hover:bg-stone-100 hover:text-stone-900"
        >
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        {{-- Encabezado --}}
        <div class="flex flex-col gap-2">
            <h2 id="{{ $name }}-title" class="text-4xl font-bold leading-tight text-indigo-950 sm:text-5xl">
                Información de facturación
            </h2>
            <p class="text-lg font-normal text-stone-900">Información general</p>
        </div>

        {{-- Formulario (sin lógica) --}}
        <form action="#" method="POST" class="flex w-full flex-col gap-12">
            @csrf

            {{-- Sección 1: datos de facturación --}}
            <div class="flex w-full flex-col gap-4">
                {{-- Fila 1 --}}
                <div class="flex flex-col gap-4 md:flex-row md:items-start">
                    <div class="flex flex-1 flex-col gap-2">
                        <label for="{{ $name }}-billing_manager" class="{{ $labelClass }}">Encargado facturacion</label>
                        <input id="{{ $name }}-billing_manager" type="text" name="billing_manager" placeholder="Placeholder" class="{{ $fieldClass }}" />
                    </div>
                    <div class="flex flex-1 flex-col gap-2">
                        <label for="{{ $name }}-agency_name" class="{{ $labelClass }}">Nombre de la agencia</label>
                        <input id="{{ $name }}-agency_name" type="text" name="agency_name" placeholder="Placeholder" class="{{ $fieldClass }}" />
                    </div>
                    <div class="flex flex-1 flex-col gap-2">
                        <label for="{{ $name }}-email" class="{{ $labelClass }}">Correo electronico</label>
                        <input id="{{ $name }}-email" type="email" name="email" placeholder="Placeholder" class="{{ $fieldClass }}" />
                    </div>
                </div>

                {{-- Fila 2 --}}
                <div class="flex flex-col gap-4 md:flex-row md:items-start">
                    <div class="flex flex-1 flex-col gap-2">
                        <label for="{{ $name }}-address" class="{{ $labelClass }}">Direccion</label>
                        <input id="{{ $name }}-address" type="text" name="address" placeholder="Placeholder" class="{{ $fieldClass }}" />
                    </div>
                    <div class="flex flex-1 flex-col gap-2">
                        <label for="{{ $name }}-postal_code" class="{{ $labelClass }}">Codigo postal</label>
                        <input id="{{ $name }}-postal_code" type="text" name="postal_code" placeholder="Placeholder" class="{{ $fieldClass }}" />
                    </div>
                    <div class="flex flex-1 flex-col gap-2">
                        <label for="{{ $name }}-country" class="{{ $labelClass }}">Pais</label>
                        <input id="{{ $name }}-country" type="text" name="country" placeholder="Placeholder" class="{{ $fieldClass }}" />
                    </div>
                </div>

                {{-- Fila 3 --}}
                <div class="flex flex-col gap-4 md:flex-row md:items-start">
                    <div class="flex flex-1 flex-col gap-2">
                        <label for="{{ $name }}-state" class="{{ $labelClass }}">Provincia/estado</label>
                        <input id="{{ $name }}-state" type="text" name="state" placeholder="Placeholder" class="{{ $fieldClass }}" />
                    </div>
                    <div class="flex flex-1 flex-col gap-2">
                        <label for="{{ $name }}-phone" class="{{ $labelClass }}">Telefono</label>
                        <input id="{{ $name }}-phone" type="tel" name="phone" placeholder="Placeholder" class="{{ $fieldClass }}" />
                    </div>
                    <div class="flex flex-1 flex-col gap-2">
                        <label for="{{ $name }}-phone_2" class="{{ $labelClass }}">Telefono 2</label>
                        <input id="{{ $name }}-phone_2" type="tel" name="phone_2" placeholder="Placeholder" class="{{ $fieldClass }}" />
                    </div>
                </div>

                {{-- Fila 4 --}}
                <div class="flex flex-col gap-4 md:flex-row md:items-start">
                    <div class="flex flex-1 flex-col gap-2">
                        <label for="{{ $name }}-mobile_phone" class="{{ $labelClass }}">telefono movil</label>
                        <input id="{{ $name }}-mobile_phone" type="tel" name="mobile_phone" placeholder="Placeholder" class="{{ $fieldClass }}" />
                    </div>
                    <div class="flex flex-1 flex-col gap-2">
                        <label for="{{ $name }}-tax" class="{{ $labelClass }}">tax</label>
                        <input id="{{ $name }}-tax" type="text" name="tax" placeholder="Placeholder" class="{{ $fieldClass }}" />
                    </div>
                    <div class="flex flex-1 flex-col gap-2">
                        <label for="{{ $name }}-tax_id" class="{{ $labelClass }}">Codigo fiscal / identidad</label>
                        <input id="{{ $name }}-tax_id" type="text" name="tax_id" placeholder="Placeholder" class="{{ $fieldClass }}" />
                    </div>
                </div>

                {{-- Checkbox --}}
                <label class="flex cursor-pointer items-center gap-2">
                    <input type="checkbox" name="terms" class="{{ $checkboxClass }}" />
                    <span class="text-sm font-normal text-stone-900">
                        Vestibulum faucibus odio vitae arcu auctor lectus.
                    </span>
                </label>
            </div>

            {{-- Sección 2: acceso y observaciones --}}
            <div class="flex w-full flex-col gap-4">
                <div class="flex flex-col gap-4 md:flex-row md:items-start">
                    <div class="flex flex-1 flex-col gap-2">
                        <label for="{{ $name }}-notes" class="{{ $labelClass }}">Observaciones</label>
                        <input id="{{ $name }}-notes" type="text" name="notes" placeholder="Placeholder" class="{{ $fieldClass }}" />
                    </div>
                    <div class="flex flex-1 flex-col gap-2">
                        <label for="{{ $name }}-password" class="{{ $labelClass }}">Contraseña</label>
                        <input id="{{ $name }}-password" type="password" name="password" placeholder="Placeholder" class="{{ $fieldClass }}" />
                    </div>
                    <div class="flex flex-1 flex-col gap-2">
                        <label for="{{ $name }}-password_confirmation" class="{{ $labelClass }}">Repetir contraseña</label>
                        <input id="{{ $name }}-password_confirmation" type="password" name="password_confirmation" placeholder="Placeholder" class="{{ $fieldClass }}" />
                    </div>
                </div>

                {{-- Checkbox --}}
                <label class="flex cursor-pointer items-center gap-2">
                    <input type="checkbox" name="accept" class="{{ $checkboxClass }}" />
                    <span class="text-sm font-normal text-stone-900">
                        Vestibulum faucibus odio vitae arcu auctor lectus.
                    </span>
                </label>

                {{-- Acciones --}}
                <div class="flex items-center justify-end gap-4">
                    <button
                        type="submit"
                        class="flex h-12 items-center justify-center rounded-[45px] bg-indigo-950 px-7 text-base font-medium tracking-wide text-white outline outline-2 outline-offset-[-2px] outline-indigo-950 transition-opacity duration-200 hover:opacity-90"
                    >
                        Guardar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

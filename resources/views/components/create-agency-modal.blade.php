@props([
    'name' => 'create-agency',
])

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
                Acceso a usuarios
            </h2>
            <p class="text-lg font-normal text-stone-900">Información general</p>
        </div>

        {{-- Formulario (sin lógica) --}}
        <form action="#" method="POST" class="flex w-full flex-col gap-4">
            @csrf

            {{-- Fila 1 --}}
            <div class="flex flex-col gap-4 md:flex-row md:items-start">
                <div class="flex flex-1 flex-col gap-2">
                    <label for="{{ $name }}-user_name" class="text-sm font-normal text-stone-900">Nombre del usuario</label>
                    <input
                        id="{{ $name }}-user_name"
                        type="text"
                        name="user_name"
                        placeholder="Placeholder"
                        class="h-12 w-full border-b border-neutral-300 bg-slate-100 px-4 py-3 text-base text-stone-900 placeholder:text-zinc-500 focus:border-indigo-400 focus:outline-none"
                    />
                </div>

                <div class="flex flex-1 flex-col gap-2">
                    <label for="{{ $name }}-comercial_name" class="text-sm font-normal text-stone-900">Nombre de la agencia</label>
                    <input
                        id="{{ $name }}-comercial_name"
                        type="text"
                        name="comercial_name"
                        placeholder="Placeholder"
                        class="h-12 w-full border-b border-neutral-300 bg-slate-100 px-4 py-3 text-base text-stone-900 placeholder:text-zinc-500 focus:border-indigo-400 focus:outline-none"
                    />
                </div>

                <div class="flex flex-1 flex-col gap-2">
                    <label for="{{ $name }}-business_name" class="text-sm font-normal text-stone-900">Nombre Fiscal:</label>
                    <input
                        id="{{ $name }}-business_name"
                        type="text"
                        name="business_name"
                        placeholder="Placeholder"
                        class="h-12 w-full border-b border-neutral-300 bg-slate-100 px-4 py-3 text-base text-stone-900 placeholder:text-zinc-500 focus:border-indigo-400 focus:outline-none"
                    />
                </div>
            </div>

            {{-- Fila 2 --}}
            <div class="flex flex-col gap-4 md:flex-row md:items-start">
                <div class="flex flex-1 flex-col gap-2">
                    <label for="{{ $name }}-logo_path" class="text-sm font-normal text-stone-900">Logotipo de la agencia</label>
                    <input
                        id="{{ $name }}-logo_path"
                        type="text"
                        name="logo_path"
                        placeholder="Placeholder"
                        class="h-12 w-full border-b border-neutral-300 bg-slate-100 px-4 py-3 text-base text-stone-900 placeholder:text-zinc-500 focus:border-indigo-400 focus:outline-none"
                    />
                </div>

                <div class="flex flex-1 flex-col gap-2">
                    <label for="{{ $name }}-logo" class="text-sm font-normal text-stone-900">Logo</label>
                    <input
                        id="{{ $name }}-logo"
                        type="text"
                        name="logo"
                        placeholder="Placeholder"
                        class="h-12 w-full border-b border-neutral-300 bg-slate-100 px-4 py-3 text-base text-stone-900 placeholder:text-zinc-500 focus:border-indigo-400 focus:outline-none"
                    />
                </div>
            </div>

            {{-- Checkbox --}}
            <label class="flex cursor-pointer items-center gap-2">
                <input
                    type="checkbox"
                    name="terms"
                    class="size-4 shrink-0 rounded-[3px] border border-neutral-400 accent-indigo-950"
                />
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
                    Crear agencia
                </button>
            </div>
        </form>
    </div>
</div>

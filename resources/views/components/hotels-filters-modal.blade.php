@props([
    'name' => 'hotels-filters',
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
    <div class="relative z-10 flex min-h-64 max-h-[90vh] w-full max-w-5xl flex-col overflow-y-auto rounded-2xl bg-white p-20 shadow-2xl">
        {{-- Botón cerrar --}}
        <button
            type="button"
            data-modal-close
            aria-label="Cerrar"
            class="absolute right-4 top-4 flex h-9 w-9 items-center justify-center rounded-full text-stone-500 transition-colors duration-200 hover:bg-stone-100 hover:text-stone-900"
        >
            <x-lucide-x class="size-6 text-gray-500" />
        </button>

        <p class="text-5xl font-extrabold font-inter leading-[54px] text-blue-300">Filtros</p>
        <p>Destinos</p>
    </div>
</div>

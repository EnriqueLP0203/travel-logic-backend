@props([
'name' => 'hotels-filters',
])

<div
    data-modal="{{ $name }}"
    role="dialog"
    aria-modal="true"
    aria-labelledby="{{ $name }}-title"
    class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    {{-- Overlay --}}
    <div data-modal-close class="absolute inset-0 bg-stone-900/50"></div>

    {{-- Contenedor del modal --}}
    <div class="relative z-10 flex min-h-64 max-h-[90vh] w-full max-w-5xl flex-col gap-10 overflow-y-auto rounded-2xl bg-white p-20 shadow-2xl">
        {{-- Botón cerrar --}}
        <button
            type="button"
            data-modal-close
            aria-label="Cerrar"
            class="absolute right-4 top-4 flex h-9 w-9 items-center justify-center rounded-full text-stone-500 transition-colors duration-200 hover:bg-stone-100 hover:text-stone-900">
            <x-lucide-x class="size-6 text-gray-500" />
        </button>

        <p class="text-5xl font-extrabold font-inter leading-[54px] text-blue-300">Filtros</p>
        <p class="text-2xl font-bold font-inter leading-5 text-slate-800">Destinos</p>
        <div class="grid grid-cols-6 gap-12">
            <div class="flex flex-col items-center gap-2">
                <div class="size-28 rounded-xl bg-gray-200"></div>
                <p class="text-base font-bold font-inter leading-5 text-slate-500">Familiar</p>
            </div>

            <div class="flex flex-col items-center gap-2">
                <div class="size-28 rounded-xl bg-gray-200"></div>
                <p class="text-base font-bold font-inter leading-5 text-slate-500">Deportivo</p>
            </div>

            <div class="flex flex-col items-center gap-2">
                <div class="size-28 rounded-xl bg-gray-200"></div>
                <p class="text-base font-bold font-inter leading-5 text-slate-500">Evento</p>
            </div>
            <div class="flex flex-col items-center gap-2">
                <div class="size-28 rounded-xl bg-gray-200"></div>
                <p class="text-base font-bold font-inter leading-5 text-slate-500">Lifestyle</p>
            </div>

            <div class="flex flex-col items-center gap-2">
                <div class="size-28 rounded-xl bg-gray-200"></div>
                <p class="text-base font-bold font-inter leading-5 text-slate-500">Adultos</p>
            </div>

            <div class="flex flex-col items-center gap-2">
                <div class="size-28 rounded-xl bg-gray-200"></div>
                <p class="text-base font-bold font-inter leading-5 text-slate-500">Convenciones</p>
            </div>
            <div class="flex flex-col items-center gap-2">
                <div class="size-28 rounded-xl bg-gray-200"></div>
                <p class="text-base font-bold font-inter leading-5 text-slate-500">Bodas</p>
            </div>
        </div>
        <p class="text-2xl font-bold font-inter leading-5 text-slate-800">Ciudades</p>

        <div class="flex gap-2">
            <button class="bg-white border border-gray-200 rounded-sm px-4 py-2">Cancun</button>
            <button class="bg-white border border-gray-200 rounded-sm px-4 py-2">CDMX</button>
            <button class="bg-white border border-gray-200 rounded-sm px-4 py-2">Merida</button>
            <button class="bg-white border border-gray-200 rounded-sm px-4 py-2">Playa del Carmen</button>
            <button class="bg-white border border-gray-200 rounded-sm px-4 py-2">Tulum</button>
            <button class="bg-white border border-gray-200 rounded-sm px-4 py-2">Todos</button>
        </div>

        <p class="text-2xl font-bold font-inter leading-5 text-slate-800">Tipo de alojamiento</p>
        <div class="flex gap-2">
            <button class="bg-white border border-gray-200 rounded-sm px-4 py-2">Plan europeo</button>
            <button class="bg-white border border-gray-200 rounded-sm px-4 py-2">Pet friendly</button>
            <button class="bg-white border border-gray-200 rounded-sm px-4 py-2">Familias</button>
            <button class="bg-white border border-gray-200 rounded-sm px-4 py-2">Solo adultos</button>
            <button class="bg-white border border-gray-200 rounded-sm px-4 py-2">Todo incluido</button>
        </div>

        <button class="max-w-96 h-16 bg-green-400 text-white text-2xl font-semibold font-inter rounded-sm px-4 py-2">Filtrar</button>
    </div>

</div>
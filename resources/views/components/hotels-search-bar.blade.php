@props([
'destinations' => collect(),
])

<form
    method="GET"
    action="{{ route('hotels') }}"
    class="w-full bg-white rounded-2xl shadow-xl p-6 mb-12">
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:gap-5">
        <!-- boton de filtros -->
        <button class="flex items-center gap-2 w-full border-2 border-gray-200 shrink-0 rounded-lg px-4 py-2.5 font-semibold text-black transition-colors duration-200 hover:bg-green-100 md:w-auto">
            Filtros
            <x-lucide-sliders-horizontal class="size-4 text-gray-500" />
        </button>

        <button class="flex items-center gap-2 w-full border-2 border-gray-200 shrink-0 rounded-lg px-8 py-2.5 font-semibold text-black transition-colors duration-200 hover:bg-green-100 md:w-auto">
            Playa
        </button>
        <button class="flex items-center gap-2 w-full border-2 border-gray-200 shrink-0 rounded-lg px-8 py-2.5 font-semibold text-black transition-colors duration-200 hover:bg-green-100 md:w-auto">
            Ciudad
        </button>
        <button class="flex items-center gap-2 w-full border-2 border-gray-200 shrink-0 rounded-lg px-8 py-2.5 font-semibold text-black transition-colors duration-200 hover:bg-green-100 md:w-auto"> 
            Descanso
        </button>
        <button class="flex items-center gap-2 w-full border-2 border-gray-200 shrink-0 rounded-lg px-8 py-2.5 font-semibold text-black transition-colors duration-200 hover:bg-green-100 md:w-auto">
            Fiesta
        </button>
        <button class="flex items-center gap-2 w-full border-2 border-gray-200 shrink-0 rounded-lg px-8 py-2.5 font-semibold text-black transition-colors duration-200 hover:bg-green-100 md:w-auto">
            Lujo
        </button>
        <button class="flex items-center gap-2 w-full border-2 border-gray-200 shrink-0 rounded-lg px-8 py-2.5 font-semibold text-black transition-colors duration-200 hover:bg-green-100 md:w-auto">
            Aeropuerto
        </button>



        {{-- Nombre del hotel --}}
        <div class="flex w-full flex-col gap-1.5">
            <input
                type="text"
                name="name"
                id="name"
                value="{{ request('name') }}"
                placeholder="Buscar hotel"
                class="w-full rounded-lg border border-gray-200 bg-gray-50 p-2.5 text-indigo-950 placeholder-gray-500  focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200" />
        </div>

        {{-- Botón aplicar --}}
        <button
            type="submit"
            class="w-full shrink-0 rounded-lg bg-green-300 px-8 py-2.5 font-semibold text-white transition-colors duration-200 hover:bg-green-400 md:w-auto">
            Buscar
        </button>
    </div>
</form>
@props([
    'destinations' => collect(),
])

@php
    $tabs = [
        ['label' => 'Hoteles', 'active' => true],
        ['label' => 'Vuelos', 'active' => false],
        ['label' => 'Paquetes', 'active' => false],
        ['label' => 'Tours', 'active' => false],
        ['label' => 'Grupos y bodas', 'active' => false],
    ];
@endphp

<div class="w-full rounded-lg border border-indigo-950/20 bg-neutral-50 p-5 sm:p-6 md:p-8">
    {{-- Pestañas (sin función) --}}
    <div class="flex flex-wrap gap-3">
        @foreach ($tabs as $tab)
            <button
                type="button"
                @class([
                    'inline-flex h-10 items-center gap-2 rounded-sm px-3 py-2 text-sm font-medium tracking-wide transition-colors duration-200',
                    'bg-indigo-950 text-white' => $tab['active'],
                    'border border-indigo-950 text-indigo-950 hover:bg-indigo-950/10' => ! $tab['active'],
                ])
            >
                <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M3.75 9.75L12 4.5l8.25 5.25M5.25 9v9.75A.75.75 0 006 19.5h12a.75.75 0 00.75-.75V9" />
                </svg>
                <span class="px-2">{{ $tab['label'] }}</span>
            </button>
        @endforeach
    </div>

    {{-- Campos del buscador --}}
    <div class="mt-6 grid grid-cols-1 gap-x-5 gap-y-4 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-[1fr_1fr_1fr_1fr_auto] xl:items-end">
        {{-- Destino --}}
        <div class="flex flex-col gap-1.5">
            <label for="dm_destination_id" class="text-xl font-medium tracking-wide text-indigo-950">Destino</label>
            <select
                name="destination_id"
                id="dm_destination_id"
                class="h-10 w-full rounded-sm border-0 bg-indigo-950/20 px-3 text-sm font-medium tracking-wide text-indigo-950 focus:outline-none focus:ring-2 focus:ring-indigo-400"
            >
                <option value="">Todas las ciudades</option>
                @foreach ($destinations as $destination)
                    <option value="{{ $destination->id }}">{{ $destination->city }}</option>
                @endforeach
            </select>
        </div>

        {{-- Check-in --}}
        <div class="flex flex-col gap-1.5">
            <label for="dm_check_in" class="text-xl font-medium tracking-wide text-indigo-950">Check-in</label>
            <input
                type="date"
                name="check_in"
                id="dm_check_in"
                class="h-10 w-full rounded-sm border-0 bg-indigo-950/20 px-3 text-sm font-medium tracking-wide text-indigo-950 focus:outline-none focus:ring-2 focus:ring-indigo-400"
            />
        </div>

        {{-- Check-out --}}
        <div class="flex flex-col gap-1.5">
            <label for="dm_check_out" class="text-xl font-medium tracking-wide text-indigo-950">Check-out</label>
            <input
                type="date"
                name="check_out"
                id="dm_check_out"
                class="h-10 w-full rounded-sm border-0 bg-indigo-950/20 px-3 text-sm font-medium tracking-wide text-indigo-950 focus:outline-none focus:ring-2 focus:ring-indigo-400"
            />
        </div>

        {{-- Huéspedes --}}
        <div class="flex flex-col gap-1.5">
            <label for="dm_guests" class="text-xl font-medium tracking-wide text-indigo-950">Huespedes</label>
            <input
                type="number"
                name="guests"
                id="dm_guests"
                min="1"
                value="2"
                class="h-10 w-full rounded-sm border-0 bg-indigo-950/20 px-3 text-sm font-medium tracking-wide text-indigo-950 focus:outline-none focus:ring-2 focus:ring-indigo-400"
            />
        </div>

        {{-- Botón Reservar (sin función) --}}
        <button
            type="button"
            class="h-10 w-full rounded-[100px] bg-emerald-500 px-8 text-xl font-medium tracking-wide text-white transition-opacity duration-200 hover:opacity-90 sm:col-span-2 lg:col-span-4 xl:col-span-1 xl:w-auto"
        >
            Reservar
        </button>
    </div>
</div>

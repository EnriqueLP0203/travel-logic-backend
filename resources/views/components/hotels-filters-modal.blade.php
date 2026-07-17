@props([
    'name' => 'hotels-filters',
    'hotelGroups' => collect(),
    'accommodationTypes' => collect(),
    'destinations' => collect(),
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

        {{-- 1. Grupos --}}
        <p class="text-2xl font-bold font-inter leading-5 text-slate-800">Grupos</p>

        <div class="grid grid-cols-2 gap-8 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6">
            @forelse ($hotelGroups as $group)
                @php
                    $groupName = $group->translations->first()?->name ?? 'Grupo';
                @endphp
                <button type="button" class="flex flex-col items-center gap-2">
                    @if ($group->thumbnail_url)
                        <img
                            src="{{ $group->thumbnail_url }}"
                            alt="{{ $groupName }}"
                            class="size-28 rounded-xl object-cover" />
                    @else
                        <div class="size-28 rounded-xl bg-gray-200"></div>
                    @endif
                    <p class="text-base font-bold font-inter leading-5 text-slate-500">
                        {{ $groupName }}
                    </p>
                </button>
            @empty
                <p class="col-span-full text-sm text-slate-400">No hay grupos disponibles.</p>
            @endforelse
        </div>

        {{-- 2. Tipos de alojamiento --}}
        <p class="text-2xl font-bold font-inter leading-5 text-slate-800">Tipo de alojamiento</p>
        <div class="flex flex-wrap gap-2">
            @forelse ($accommodationTypes as $type)
                @php
                    $typeName = $type->translations->first()?->name ?? 'Tipo';
                @endphp
                <button type="button" class="bg-white border border-gray-200 rounded-sm px-4 py-2">
                    {{ $typeName }}
                </button>
            @empty
                <p class="text-sm text-slate-400">No hay tipos de alojamiento disponibles.</p>
            @endforelse
        </div>

        {{-- 3. Destinos --}}
        <p class="text-2xl font-bold font-inter leading-5 text-slate-800">Destinos</p>
        <div class="flex flex-wrap gap-2">
            @forelse ($destinations as $destination)
                <button type="button" class="bg-white border border-gray-200 rounded-sm px-4 py-2">
                    {{ $destination->city }}
                </button>
            @empty
                <p class="text-sm text-slate-400">No hay destinos disponibles.</p>
            @endforelse
        </div>

        <button type="button" class="max-w-96 h-16 bg-green-400 text-white text-2xl font-semibold font-inter rounded-sm px-4 py-2">
            Filtrar
        </button>
    </div>
</div>

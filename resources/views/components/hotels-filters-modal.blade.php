@props([
    'name' => 'hotels-filters',
    'hotelGroups' => collect(),
    'accommodationTypes' => collect(),
    'destinations' => collect(),
])

@php
    $activeGroup = request('hotel_group_id');
    $activeType = request('accommodation_type');
    $activeDestination = request('destination_id');
@endphp

<div
    data-modal="{{ $name }}"
    role="dialog"
    aria-modal="true"
    aria-labelledby="{{ $name }}-title"
    class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <div data-modal-close class="absolute inset-0 bg-stone-900/50"></div>

    <div class="relative z-10 flex min-h-64 max-h-[90vh] w-full max-w-5xl flex-col gap-10 overflow-y-auto rounded-2xl bg-white p-20 shadow-2xl">
        <button
            type="button"
            data-modal-close
            aria-label="Cerrar"
            class="absolute right-4 top-4 flex h-9 w-9 items-center justify-center rounded-full text-stone-500 transition-colors duration-200 hover:bg-stone-100 hover:text-stone-900">
            <x-lucide-x class="size-6 text-gray-500" />
        </button>

        <form method="GET" action="{{ route('hotels') }}" class="flex flex-col gap-10">
            @if (request()->filled('name'))
                <input type="hidden" name="name" value="{{ request('name') }}">
            @endif

            <p class="text-5xl font-extrabold font-inter leading-[54px] text-blue-300">Filtros</p>

            {{-- 1. Grupos --}}
            <div class="flex flex-col gap-6">
                <p class="text-2xl font-bold font-inter leading-5 text-slate-800">Grupos</p>

                <div class="grid grid-cols-2 gap-8 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6">
                    <label class="flex cursor-pointer flex-col items-center gap-2 rounded-xl p-2 transition hover:bg-slate-50 has-[:checked]:bg-green-50 has-[:checked]:ring-2 has-[:checked]:ring-green-400">
                        <input type="radio" name="hotel_group_id" value="" class="sr-only" @checked(blank($activeGroup))>
                        <div class="flex size-28 items-center justify-center rounded-xl bg-gray-200 text-sm font-semibold text-slate-500">
                            Todos
                        </div>
                        <p class="text-base font-bold font-inter leading-5 text-slate-500">Todos</p>
                    </label>

                    @forelse ($hotelGroups as $group)
                        @php
                            $groupName = $group->translations->first()?->name ?? 'Grupo';
                            $isActive = (string) $activeGroup === (string) $group->id;
                        @endphp
                        <label class="flex cursor-pointer flex-col items-center gap-2 rounded-xl p-2 transition hover:bg-slate-50 has-[:checked]:bg-green-50 has-[:checked]:ring-2 has-[:checked]:ring-green-400">
                            <input
                                type="radio"
                                name="hotel_group_id"
                                value="{{ $group->id }}"
                                class="sr-only"
                                @checked($isActive)
                            >
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
                        </label>
                    @empty
                        <p class="col-span-full text-sm text-slate-400">No hay grupos disponibles.</p>
                    @endforelse
                </div>
            </div>

            {{-- 2. Tipos de alojamiento --}}
            <div class="flex flex-col gap-4">
                <p class="text-2xl font-bold font-inter leading-5 text-slate-800">Tipo de alojamiento</p>
                <div class="flex flex-wrap gap-2">
                    <label class="cursor-pointer rounded-sm border border-gray-200 bg-white px-4 py-2 transition hover:bg-slate-50 has-[:checked]:border-green-400 has-[:checked]:bg-green-50">
                        <input type="radio" name="accommodation_type" value="" class="sr-only" @checked(blank($activeType))>
                        <span>Todos</span>
                    </label>

                    @forelse ($accommodationTypes as $type)
                        @php
                            $typeName = $type->translations->first()?->name ?? 'Tipo';
                            $isActive = (string) $activeType === (string) $type->id;
                        @endphp
                        <label class="cursor-pointer rounded-sm border border-gray-200 bg-white px-4 py-2 transition hover:bg-slate-50 has-[:checked]:border-green-400 has-[:checked]:bg-green-50">
                            <input
                                type="radio"
                                name="accommodation_type"
                                value="{{ $type->id }}"
                                class="sr-only"
                                @checked($isActive)
                            >
                            <span>{{ $typeName }}</span>
                        </label>
                    @empty
                        <p class="text-sm text-slate-400">No hay tipos de alojamiento disponibles.</p>
                    @endforelse
                </div>
            </div>

            {{-- 3. Destinos --}}
            <div class="flex flex-col gap-4">
                <p class="text-2xl font-bold font-inter leading-5 text-slate-800">Destinos</p>
                <div class="flex flex-wrap gap-2">
                    <label class="cursor-pointer rounded-sm border border-gray-200 bg-white px-4 py-2 transition hover:bg-slate-50 has-[:checked]:border-green-400 has-[:checked]:bg-green-50">
                        <input type="radio" name="destination_id" value="" class="sr-only" @checked(blank($activeDestination))>
                        <span>Todos</span>
                    </label>

                    @forelse ($destinations as $destination)
                        @php
                            $isActive = (string) $activeDestination === (string) $destination->id;
                        @endphp
                        <label class="cursor-pointer rounded-sm border border-gray-200 bg-white px-4 py-2 transition hover:bg-slate-50 has-[:checked]:border-green-400 has-[:checked]:bg-green-50">
                            <input
                                type="radio"
                                name="destination_id"
                                value="{{ $destination->id }}"
                                class="sr-only"
                                @checked($isActive)
                            >
                            <span>{{ $destination->city }}</span>
                        </label>
                    @empty
                        <p class="text-sm text-slate-400">No hay destinos disponibles.</p>
                    @endforelse
                </div>
            </div>

            <button
                type="submit"
                class="max-w-96 h-16 bg-green-400 text-white text-2xl font-semibold font-inter rounded-sm px-4 py-2 hover:bg-green-500 transition-colors"
            >
                Filtrar
            </button>
        </form>
    </div>
</div>

@props([
    'destinations' => collect(),
    'hotelGroups' => collect(),
    'accommodationTypes' => collect(),
])

@php
    $activeType = request('accommodation_type');
    $activeGroup = request('hotel_group_id');
    $activeDestination = request('destination_id');
@endphp

<div>
    <x-animate-in>
    <form
        method="GET"
        action="{{ route('hotels') }}"
        class="mb-12 w-full rounded-2xl bg-white p-6 shadow-xl">
        @if ($activeGroup)
            <input type="hidden" name="hotel_group_id" value="{{ $activeGroup }}">
        @endif
        @if ($activeDestination)
            <input type="hidden" name="destination_id" value="{{ $activeDestination }}">
        @endif
        @if ($activeType)
            <input type="hidden" name="accommodation_type" value="{{ $activeType }}">
        @endif

        <div class="flex flex-col gap-3 sm:flex-row sm:items-stretch">
            <div class="relative min-w-0 flex-1">
                <label for="name" class="sr-only">Buscar hotel</label>
                <x-lucide-search class="pointer-events-none absolute left-3 top-1/2 size-4 -translate-y-1/2 text-gray-500" />
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ request('name') }}"
                    placeholder="Buscar hotel"
                    class="h-11 w-full rounded-lg border border-gray-200 bg-gray-50 py-2.5 pl-10 pr-3 text-indigo-950 placeholder-gray-500 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200" />
            </div>

            <div class="flex shrink-0 gap-2">
                <button
                    type="submit"
                    class="h-11 flex-1 rounded-lg bg-green-300 px-8 font-semibold text-white transition-colors duration-200 hover:bg-green-400 sm:flex-none">
                    Buscar
                </button>
                <button
                    type="button"
                    data-modal-target="hotels-filters"
                    class="flex h-11 flex-1 items-center justify-center gap-2 rounded-lg border-2 border-gray-200 px-4 font-semibold text-black transition-colors duration-200 hover:bg-green-100 sm:flex-none"
                >
                    Filtros
                    <x-lucide-sliders-horizontal class="size-4 text-gray-500" />
                </button>
            </div>
        </div>

        <div class="mt-4 flex flex-wrap gap-2">
            <a
                href="{{ route('hotels', request()->except(['accommodation_type', 'page'])) }}"
                @class([
                    'inline-flex items-center justify-center rounded-lg border-2 px-4 py-2.5 font-semibold transition-colors duration-200',
                    'border-green-400 bg-green-100 text-black' => blank($activeType),
                    'border-gray-200 text-black hover:bg-green-100' => filled($activeType),
                ])
            >
                Todos
            </a>

            @foreach ($accommodationTypes as $type)
                @php
                    $typeName = $type->translations->first()?->name ?? 'Tipo';
                    $isActive = (string) $activeType === (string) $type->id;
                @endphp
                <button
                    type="submit"
                    name="accommodation_type"
                    value="{{ $type->id }}"
                    @class([
                        'inline-flex items-center rounded-lg border-2 px-4 py-2.5 font-semibold transition-colors duration-200',
                        'border-green-400 bg-green-100 text-black' => $isActive,
                        'border-gray-200 text-black hover:bg-green-100' => ! $isActive,
                    ])
                >
                    {{ $typeName }}
                </button>
            @endforeach
        </div>
    </form>
    </x-animate-in>

    <x-hotels-filters-modal
        :hotel-groups="$hotelGroups"
        :accommodation-types="$accommodationTypes"
        :destinations="$destinations"
    />
</div>

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
    <form
        method="GET"
        action="{{ route('hotels') }}"
        class="w-full bg-white rounded-2xl shadow-xl p-6 mb-12">
        @if ($activeGroup)
            <input type="hidden" name="hotel_group_id" value="{{ $activeGroup }}">
        @endif
        @if ($activeDestination)
            <input type="hidden" name="destination_id" value="{{ $activeDestination }}">
        @endif
        @if ($activeType)
            <input type="hidden" name="accommodation_type" value="{{ $activeType }}">
        @endif

        <div class="flex flex-col gap-4 md:flex-row md:items-end md:gap-5">
            <button
                type="button"
                data-modal-target="hotels-filters"
                class="flex items-center gap-2 w-full border-2 border-gray-200 shrink-0 rounded-lg px-4 py-2.5 font-semibold text-black transition-colors duration-200 hover:bg-green-100 md:w-auto"
            >
                Filtros
                <x-lucide-sliders-horizontal class="size-4 text-gray-500" />
            </button>

            <a
                href="{{ route('hotels', request()->except(['accommodation_type', 'page'])) }}"
                @class([
                    'flex items-center justify-center gap-2 w-full border-2 shrink-0 rounded-lg px-8 py-2.5 font-semibold transition-colors duration-200 md:w-auto',
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
                        'flex items-center gap-2 w-full border-2 shrink-0 rounded-lg px-8 py-2.5 font-semibold transition-colors duration-200 md:w-auto',
                        'border-green-400 bg-green-100 text-black' => $isActive,
                        'border-gray-200 text-black hover:bg-green-100' => ! $isActive,
                    ])
                >
                    {{ $typeName }}
                </button>
            @endforeach

            <div class="flex w-full flex-col gap-1.5">
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ request('name') }}"
                    placeholder="Buscar hotel"
                    class="w-full rounded-lg border border-gray-200 bg-gray-50 p-2.5 text-indigo-950 placeholder-gray-500 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200" />
            </div>

            <button
                type="submit"
                class="w-full shrink-0 rounded-lg bg-green-300 px-8 py-2.5 font-semibold text-white transition-colors duration-200 hover:bg-green-400 md:w-auto">
                Buscar
            </button>
        </div>
    </form>

    <x-hotels-filters-modal
        :hotel-groups="$hotelGroups"
        :accommodation-types="$accommodationTypes"
        :destinations="$destinations"
    />
</div>

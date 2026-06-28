@props([
    'destinations' => collect(),
])

<form
    method="GET"
    action="{{ route('hotels') }}"
    class="w-full bg-white rounded-2xl shadow-xl p-6 mb-12"
>
    <div class="flex flex-col gap-4 md:flex-row md:items-end md:gap-5">
        {{-- Ciudad / Destino --}}
        <div class="flex w-full flex-col gap-1.5">
            <label for="destination_id" class="text-sm font-medium text-indigo-950">Ciudad</label>
            <select
                name="destination_id"
                id="destination_id"
                class="w-full rounded-2xl border border-gray-200 bg-gray-50 p-2.5 text-indigo-950 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200"
            >
                <option value="">Todas las ciudades</option>
                @foreach ($destinations as $destination)
                    <option
                        value="{{ $destination->id }}"
                        @selected((string) request('destination_id') === (string) $destination->id)
                    >
                        {{ $destination->city }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Estrellas --}}
        <div class="flex w-full flex-col gap-1.5 md:w-48 md:shrink-0">
            <label for="star_category" class="text-sm font-medium text-indigo-950">Estrellas</label>
            <select
                name="star_category"
                id="star_category"
                class="w-full rounded-2xl border border-gray-200 bg-gray-50 p-2.5 text-indigo-950 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200"
            >
                <option value="">Estrellas</option>
                @for ($star = 0; $star <= 5; $star++)
                    <option
                        value="{{ $star }}"
                        @selected(request('star_category') !== null && (string) request('star_category') === (string) $star)
                    >
                        {{ $star }} {{ $star === 1 ? 'estrella' : 'estrellas' }}
                    </option>
                @endfor
            </select>
        </div>

        {{-- Nombre del hotel --}}
        <div class="flex w-full flex-col gap-1.5">
            <label for="name" class="text-sm font-medium text-indigo-950">Nombre del hotel</label>
            <input
                type="text"
                name="name"
                id="name"
                value="{{ request('name') }}"
                placeholder="Buscar hotel"
                class="w-full rounded-2xl border border-gray-200 bg-gray-50 p-2.5 text-indigo-950 placeholder-gray-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200"
            />
        </div>

        {{-- Botón aplicar --}}
        <button
            type="submit"
            class="w-full shrink-0 rounded-2xl bg-indigo-950 px-8 py-2.5 font-semibold text-white transition-colors duration-200 hover:bg-indigo-900 md:w-auto"
        >
            Aplicar filtros
        </button>
    </div>
</form>

@extends('layouts.dashboard')

@section('title', 'Hoteles')
@section('heading', 'Hoteles')

@section('content')
@if (session('success'))
<div class="mb-4 rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="mb-4 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
    {{ session('error') }}
</div>
@endif

<div class="bg-white rounded-lg shadow-sm border border-slate-200">
    <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">
        <h2 class="text-sm font-semibold text-slate-800">Listado</h2>

        <button type="button"
            data-modal-target="hotel-create"
            class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-4 py-2 rounded-md transition">
            <x-lucide-plus class="w-4 h-4" />
            Nuevo
        </button>
    </div>

    <div class="space-y-3 border-b border-slate-200 px-6 py-3">
        <div class="flex flex-wrap items-center justify-between gap-2">
            <p class="text-sm text-slate-500">
                {{ $hotels->total() }} {{ $hotels->total() === 1 ? 'registro' : 'registros' }}
            </p>
            @if (request()->hasAny(['name', 'sort', 'dir', 'without_groups', 'without_types', 'published', 'featured']))
            <a href="{{ route('admin.hotels.index') }}"
                class="text-sm text-slate-500 underline-offset-2 hover:text-slate-700 hover:underline">
                Limpiar filtros
            </a>
            @endif
        </div>

        <form method="GET" action="{{ route('admin.hotels.index') }}"
            class="flex flex-wrap items-end gap-3">
            <div class="flex min-w-[12rem] flex-1 flex-col gap-1">
                <label for="filter-name" class="text-xs font-medium text-slate-500">Nombre</label>
                <input id="filter-name" type="search" name="name" value="{{ request('name') }}"
                    placeholder="Buscar hotel…"
                    class="rounded-md border border-slate-300 px-3 py-1.5 text-sm text-slate-800 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <div class="flex flex-col gap-1">
                <label for="filter-sort" class="text-xs font-medium text-slate-500">Ordenar por</label>
                <select id="filter-sort" name="sort"
                    class="rounded-md border border-slate-300 bg-white px-3 py-1.5 text-sm text-slate-800 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <option value="name" @selected(request('sort', 'name') === 'name')>Nombre</option>
                    <option value="created_at" @selected(request('sort') === 'created_at')>Fecha de creación</option>
                    <option value="updated_at" @selected(request('sort') === 'updated_at')>Última actualización</option>
                    <option value="destination" @selected(request('sort') === 'destination')>Destino</option>
                    <option value="star_category" @selected(request('sort') === 'star_category')>Estrellas</option>
                    <option value="star_rating" @selected(request('sort') === 'star_rating')>Calificación</option>
                    <option value="slug" @selected(request('sort') === 'slug')>Slug</option>
                </select>
            </div>

            <div class="flex flex-col gap-1">
                <label for="filter-dir" class="text-xs font-medium text-slate-500">Dirección</label>
                <select id="filter-dir" name="dir"
                    class="rounded-md border border-slate-300 bg-white px-3 py-1.5 text-sm text-slate-800 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <option value="asc" @selected(request('dir', 'asc') === 'asc')>Ascendente</option>
                    <option value="desc" @selected(request('dir') === 'desc')>Descendente</option>
                </select>
            </div>

            <div class="flex flex-col gap-1">
                <label for="filter-published" class="text-xs font-medium text-slate-500">Publicado</label>
                <select id="filter-published" name="published"
                    class="rounded-md border border-slate-300 bg-white px-3 py-1.5 text-sm text-slate-800 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <option value="" @selected(request('published') === null || request('published') === '')>Todos</option>
                    <option value="1" @selected(request('published') === '1')>Sí</option>
                    <option value="0" @selected(request('published') === '0')>No</option>
                </select>
            </div>

            <div class="flex flex-col gap-1">
                <label for="filter-featured" class="text-xs font-medium text-slate-500">Destacado</label>
                <select id="filter-featured" name="featured"
                    class="rounded-md border border-slate-300 bg-white px-3 py-1.5 text-sm text-slate-800 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <option value="" @selected(request('featured') === null || request('featured') === '')>Todos</option>
                    <option value="1" @selected(request('featured') === '1')>Sí</option>
                    <option value="0" @selected(request('featured') === '0')>No</option>
                </select>
            </div>

            <div class="flex flex-col gap-1.5 pb-1">
                <span class="text-xs font-medium text-slate-500">Faltantes</span>
                <div class="flex flex-wrap items-center gap-3">
                    <label class="inline-flex items-center gap-1.5 text-sm text-slate-700">
                        <input type="checkbox" name="without_groups" value="1"
                            @checked(request()->boolean('without_groups'))
                            class="size-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        Sin grupos
                    </label>
                    <label class="inline-flex items-center gap-1.5 text-sm text-slate-700">
                        <input type="checkbox" name="without_types" value="1"
                            @checked(request()->boolean('without_types'))
                            class="size-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        Sin tipos
                    </label>
                </div>
            </div>

            <button type="submit"
                class="inline-flex items-center gap-1.5 rounded-md border border-slate-300 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                <x-lucide-funnel class="w-4 h-4" />
                Filtrar
            </button>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="bg-slate-50 border-y border-slate-200 text-left">
                    <th class="px-6 py-3 font-medium text-slate-500 w-12">#</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Nombre</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Destino</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Estrellas</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Publicado</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Destacado</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Imagen</th>
                    <th class="px-6 py-3 font-medium text-slate-500 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($hotels as $hotel)
                @php
                    $translation = $hotel->translations->first();
                    $galleryJson = $hotel->gallery
                        ->map(fn ($img) => ['id' => $img->id, 'url' => $img->url])
                        ->values()
                        ->toJson();
                    $groupIds = $hotel->hotelGroups->pluck('id')->implode(',');
                    $typeIds = $hotel->accommodationTypes->pluck('id')->implode(',');
                @endphp
                <tr class="hover:bg-slate-50/80 {{ ! $hotel->active ? 'opacity-50' : '' }}">
                    <td class="px-6 py-3 text-slate-500">{{ $hotel->id }}</td>
                    <td class="px-6 py-3 font-medium text-slate-800">{{ $hotel->name }}</td>
                    <td class="px-6 py-3 text-slate-700">{{ $hotel->destination?->city ?? '—' }}</td>
                    <td class="px-6 py-3 text-slate-700">{{ $hotel->star_category }}</td>
                    <td class="px-6 py-3">
                        @if ($hotel->is_published)
                        <span class="inline-flex rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-700">Sí</span>
                        @else
                        <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-medium text-slate-600">No</span>
                        @endif
                    </td>
                    <td class="px-6 py-3">
                        @if ($hotel->featured)
                        <span class="inline-flex rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-medium text-amber-700">Sí</span>
                        @else
                        <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-medium text-slate-600">No</span>
                        @endif
                    </td>
                    <td class="px-6 py-3">
                        @if ($hotel->principalImage?->url)
                        <img src="{{ $hotel->principalImage->url }}" alt="{{ $hotel->name }}"
                            class="w-14 h-10 object-cover rounded-md">
                        @else
                        <span class="inline-flex items-center justify-center w-14 h-10 bg-slate-100 rounded-md text-slate-400 text-xs">—</span>
                        @endif
                    </td>
                    <td class="px-6 py-3 text-center">
                        <div class="flex items-center justify-center gap-6">
                            <button type="button"
                                data-modal-target="hotel-view"
                                data-id="{{ $hotel->id }}"
                                data-name="{{ $hotel->name }}"
                                data-destination="{{ $hotel->destination?->city ?? '' }}"
                                data-star-category="{{ $hotel->star_category }}"
                                data-published="{{ $hotel->is_published ? '1' : '0' }}"
                                data-featured="{{ $hotel->featured ? '1' : '0' }}"
                                data-active="{{ $hotel->active ? '1' : '0' }}"
                                data-address="{{ $hotel->address }}"
                                data-thumbnail="{{ $hotel->principalImage?->url ?? '' }}"
                                data-gallery="{{ $galleryJson }}"
                                data-short-description="{{ $translation?->short_description ?? '' }}"
                                class="text-slate-500 hover:text-slate-700 hover:scale-110 transition-all duration-300"
                                title="Ver">
                                <x-lucide-eye class="w-5" />
                            </button>

                            <button type="button"
                                data-modal-target="hotel-edit"
                                data-id="{{ $hotel->id }}"
                                data-name="{{ $hotel->name }}"
                                data-destination-id="{{ $hotel->destination_id }}"
                                data-star-category="{{ $hotel->star_category }}"
                                data-address="{{ $hotel->address }}"
                                data-postal-code="{{ $hotel->postal_code }}"
                                data-latitude="{{ $hotel->latitude }}"
                                data-longitude="{{ $hotel->longitude }}"
                                data-phone="{{ $hotel->phone ?? '' }}"
                                data-email="{{ $hotel->email ?? '' }}"
                                data-website="{{ $hotel->website ?? '' }}"
                                data-star-rating="{{ $hotel->star_rating }}"
                                data-price-range="{{ $hotel->price_range ?? '' }}"
                                data-slug="{{ $hotel->slug }}"
                                data-featured="{{ $hotel->featured ? '1' : '0' }}"
                                data-published="{{ $hotel->is_published ? '1' : '0' }}"
                                data-active="{{ $hotel->active ? '1' : '0' }}"
                                data-short-description="{{ $translation?->short_description ?? '' }}"
                                data-description="{{ $translation?->description ?? '' }}"
                                data-amenities="{{ $translation?->amenities ?? '' }}"
                                data-meta-title="{{ $translation?->meta_title ?? '' }}"
                                data-meta-description="{{ $translation?->meta_description ?? '' }}"
                                data-meta-keywords="{{ $translation?->meta_keywords ?? '' }}"
                                data-hotel-groups="{{ $groupIds }}"
                                data-accommodation-types="{{ $typeIds }}"
                                data-thumbnail="{{ $hotel->principalImage?->url ?? '' }}"
                                data-gallery="{{ $galleryJson }}"
                                data-update-url="{{ route('admin.hotels.update', $hotel) }}"
                                class="text-blue-500 hover:text-blue-700 hover:scale-110 transition-all duration-300"
                                title="Editar">
                                <x-lucide-pencil class="w-5" />
                            </button>

                            <button type="button"
                                data-modal-target="hotel-delete"
                                data-id="{{ $hotel->id }}"
                                data-name="{{ $hotel->name }}"
                                data-delete-url="{{ route('admin.hotels.destroy', $hotel) }}"
                                class="text-red-500 hover:text-red-700 hover:scale-110 transition-all duration-300"
                                title="Eliminar">
                                <x-lucide-trash class="w-5" />
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-10 text-center text-slate-400">
                        No hay hoteles registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($hotels->hasPages())
    <div class="px-6 py-4 border-t border-slate-200">
        {{ $hotels->links() }}
    </div>
    @endif
</div>

<x-hotels.create-new-modal :destinations="$destinations" :hotel-groups="$hotelGroups" :accommodation-types="$accommodationTypes" />
<x-hotels.hotel-view-modal />
<x-hotels.hotel-edit-modal :destinations="$destinations" :hotel-groups="$hotelGroups" :accommodation-types="$accommodationTypes" />
<x-hotels.hotel-delete-modal />
@endsection

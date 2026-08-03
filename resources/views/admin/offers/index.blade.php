@extends('layouts.dashboard')

@section('title', 'Gestor de ofertas')
@section('heading', 'Gestor de ofertas')

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
            data-modal-target="offer-create"
            class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-4 py-2 rounded-md transition">
            <x-lucide-plus class="w-4 h-4" />
            Nueva oferta
        </button>
    </div>

    <div class="flex items-center justify-between px-6 py-3">
        <p class="text-sm text-slate-500">
            Mostrando {{ $offers->firstItem() ?? 0 }}–{{ $offers->lastItem() ?? 0 }} de {{ $offers->total() }} elementos.
        </p>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="bg-slate-50 border-y border-slate-200 text-left">
                    <th class="px-6 py-3 font-medium text-slate-500 w-12">#</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Nombre</th>
                    <th class="px-6 py-3 font-medium text-slate-500">Thumbnail</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Enlace</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Orden</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Activo</th>
                    <th class="px-6 py-3 font-medium text-slate-500 text-center">Acciones</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">
                @forelse($offers as $offer)
                <tr class="hover:bg-slate-50 {{ ! $offer->active ? 'opacity-50' : '' }}">
                    <td class="px-6 py-3 text-slate-500">{{ $offers->firstItem() + $loop->index }}</td>
                    <td class="px-6 py-3 text-slate-700">{{ $offer->name }}</td>
                    <td class="px-6 py-3">
                        @if ($offer->thumbnail_url)
                            <img src="{{ $offer->thumbnail_url }}" alt="{{ $offer->name }}"
                                class="w-14 h-10 object-cover rounded-md">
                        @else
                            <span class="inline-flex items-center justify-center w-14 h-10 bg-slate-100 rounded-md text-slate-400 text-xs">—</span>
                        @endif
                    </td>
                    <td class="px-6 py-3 text-slate-700">
                        @if ($offer->link)
                            <a href="{{ $offer->link }}" target="_blank" rel="noopener" class="text-blue-600 hover:underline truncate max-w-xs inline-block">
                                {{ $offer->link }}
                            </a>
                        @else
                            <span class="text-slate-400">—</span>
                        @endif
                    </td>
                    <td class="px-6 py-3 text-slate-700">{{ $offer->sort_order }}</td>
                    <td class="px-6 py-3">
                        @if ($offer->active)
                            <span class="inline-flex rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-700">Sí</span>
                        @else
                            <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-medium text-slate-600">No</span>
                        @endif
                    </td>
                    <td class="px-6 py-3">
                        <div class="flex items-center justify-center gap-6">
                            <button
                                type="button"
                                data-modal-target="offer-edit"
                                data-id="{{ $offer->id }}"
                                data-name="{{ $offer->name }}"
                                data-link="{{ $offer->link ?? '' }}"
                                data-active="{{ $offer->active ? '1' : '0' }}"
                                data-sort-order="{{ $offer->sort_order }}"
                                data-thumbnail="{{ $offer->thumbnail_url ?? '' }}"
                                data-update-url="{{ route('admin.offers.update', $offer) }}"
                                class="text-blue-500 hover:text-blue-700 hover:scale-110 transition-all duration-300"
                                title="Editar">
                                <x-lucide-pencil class="w-5" />
                            </button>

                            <button
                                type="button"
                                data-modal-target="offer-delete"
                                data-id="{{ $offer->id }}"
                                data-name="{{ $offer->name }}"
                                data-delete-url="{{ route('admin.offers.destroy', $offer) }}"
                                class="text-red-500 hover:text-red-700 hover:scale-110 transition-all duration-300"
                                title="Eliminar">
                                <x-lucide-trash class="w-5" />
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-slate-400">
                        No hay ofertas registradas.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($offers->hasPages())
        <div class="px-6 py-4 border-t border-slate-200">
            {{ $offers->links() }}
        </div>
    @endif
</div>

<x-offers.create-new-modal />
<x-offers.offer-edit-modal />
<x-offers.offer-delete-modal />
@endsection

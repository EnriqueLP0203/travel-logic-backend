@extends('layouts.dashboard')

@section('title', 'Destinos')
@section('heading', 'Destinos')

@section('content')
<div class="bg-white rounded-lg shadow-sm border border-slate-200">

    {{-- Header de la card --}}
    <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">
        <h2 class="text-sm font-semibold text-slate-800">Listado</h2>

        <button type="button"
            data-modal-target="destination-create"
            class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-4 py-2 rounded-md transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Nuevo
        </button>
    </div>

    {{-- Barra de acciones --}}
    <div class="flex items-center justify-between px-6 py-3">
        <p class="text-sm text-slate-500">
            Mostrando {{ $destinos->firstItem() ?? 0 }}–{{ $destinos->lastItem() ?? 0 }} de {{ $destinos->total() }} elementos.
        </p>

        <div class="flex items-center gap-2">
            <button type="button"
                class="text-sm text-slate-600 border border-slate-300 rounded-md px-3 py-1.5 hover:bg-slate-50">
                Limpiar filtros
            </button>

            <button type="button"
                class="inline-flex items-center gap-1 text-sm text-slate-600 border border-slate-300 rounded-md px-3 py-1.5 hover:bg-slate-50">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Inactivas
            </button>
        </div>
    </div>

    {{-- Tabla --}}
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="bg-slate-50 border-y border-slate-200 text-left">
                    <th class="px-6 py-3 font-medium text-slate-500 w-12">#</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Ciudad (Destino)</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Estado</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">País</th>
                    <th class="px-6 py-3 font-medium text-slate-500">Thumbnail</th>
                    <th class="px-6 py-3 font-medium text-slate-500 text-center">Acciones</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">
                @forelse($destinos as $destino)
                <tr class="hover:bg-slate-50 {{ ! $destino->active ? 'opacity-50' : '' }}">
                    <td class="px-6 py-3 text-slate-500">{{ $destinos->firstItem() + $loop->index }}</td>
                    <td class="px-6 py-3 text-slate-700">{{ $destino->city }}</td>
                    <td class="px-6 py-3 text-slate-700">{{ $destino->state }}</td>
                    <td class="px-6 py-3 text-slate-700">{{ $destino->country }}</td>
                    <td class="px-6 py-3">
                        @if ($destino->thumbnail_url)
                            <img src="{{ $destino->thumbnail_url }}" alt="{{ $destino->city }}"
                                class="w-14 h-10 object-cover rounded-md">
                        @else
                            <span class="inline-flex items-center justify-center w-14 h-10 bg-slate-100 rounded-md text-slate-400 text-xs">—</span>
                        @endif
                    </td>
                    <td class="px-6 py-3">
                        <div class="flex items-center justify-center gap-6">
                            {{-- Ver --}}
                            <button type="button" class="text-slate-500 hover:text-slate-700 hover:scale-110 transition-all duration-300" title="Ver">
                                <x-lucide-eye class="w-5" />
                            </button>

                            {{-- Editar --}}
                            <button type="button" class="text-blue-500 hover:text-blue-700 hover:scale-110 transition-all duration-300" title="Editar">
                                <x-lucide-pencil class="w-5" />
                            </button>

                            {{-- Eliminar --}}
                            <button type="button" class="text-red-500 hover:text-red-700 hover:scale-110 transition-all duration-300" title="Eliminar">
                                <x-lucide-trash class="w-5" />
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-slate-400">
                        No hay destinos registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($destinos->hasPages())
        <div class="px-6 py-4 border-t border-slate-200">
            {{ $destinos->links() }}
        </div>
    @endif

</div>

<x-destination-create-modal />
@endsection

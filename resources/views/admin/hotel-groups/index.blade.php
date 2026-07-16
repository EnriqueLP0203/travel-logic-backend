@extends('layouts.dashboard')

@section('title', 'Grupos de hotel')
@section('heading', 'Grupos de hotel')

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
    {{-- Header de la card --}}
    <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">
        <h2 class="text-sm font-semibold text-slate-800">Listado</h2>

        <button type="button"
            data-modal-target="hotel-group-create"
            class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-4 py-2 rounded-md transition">
            <x-lucide-plus class="w-4 h-4" />
            Nuevo
        </button>
    </div>

    {{-- Barra de acciones --}}
    <div class="flex items-center justify-between px-6 py-3">
        <p class="text-sm text-slate-500">
            {{ $hotelGroups->total() }} {{ $hotelGroups->total() === 1 ? 'registro' : 'registros' }}
        </p>

        <div class="flex items-center gap-2">
            <button type="button"
                class="inline-flex items-center gap-1 text-sm text-slate-600 border border-slate-300 rounded-md px-3 py-1.5 hover:bg-slate-50">
                <x-lucide-eye-off class="w-4 h-4" />
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
                    <th class="px-6 py-3 font-semibold text-blue-600">Nombre</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Imagen</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Estado</th>
                    <th class="px-6 py-3 font-medium text-slate-500 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($hotelGroups as $group)
                @php
                $groupName = $group->translations->first()?->name ?? '—';
                @endphp
                <tr class="hover:bg-slate-50/80 {{ ! $group->active ? 'opacity-50' : '' }}">
                    <td class="px-6 py-3 text-slate-500">{{ $group->id }}</td>
                    <td class="px-6 py-3 font-medium text-slate-800">{{ $groupName }}</td>
                    <td class="px-6 py-3">
                        @if ($group->thumbnail_url)
                        <img src="{{ $group->thumbnail_url }}" alt="{{ $groupName }}"
                            class="w-14 h-10 object-cover rounded-md">
                        @else
                        <span class="inline-flex items-center justify-center w-14 h-10 bg-slate-100 rounded-md text-slate-400 text-xs">—</span>
                        @endif
                    </td>
                    <td class="px-6 py-3">
                        @if ($group->active)
                        <span class="inline-flex rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-700">Activo</span>
                        @else
                        <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-medium text-slate-600">Inactivo</span>
                        @endif
                    </td>
                    <td class="px-6 py-3 text-center">
                        <div class="flex items-center justify-center gap-6">
                            <button type="button"
                                data-modal-target="hotel-group-view"
                                data-id="{{ $group->id }}"
                                data-name="{{ $groupName }}"
                                data-active="{{ $group->active ? '1' : '0' }}"
                                data-thumbnail="{{ $group->thumbnail_url ?? '' }}"
                                class="text-slate-500 hover:text-slate-700 hover:scale-110 transition-all duration-300"
                                title="Ver">
                                <x-lucide-eye class="w-5" />
                            </button>

                            <button type="button"
                                data-modal-target="hotel-group-edit"
                                data-id="{{ $group->id }}"
                                data-name="{{ $groupName }}"
                                data-active="{{ $group->active ? '1' : '0' }}"
                                data-thumbnail="{{ $group->thumbnail_url ?? '' }}"
                                data-update-url="{{ route('admin.hotel-groups.update', $group) }}"
                                class="text-blue-500 hover:text-blue-700 hover:scale-110 transition-all duration-300"
                                title="Editar">
                                <x-lucide-pencil class="w-5" />
                            </button>

                            <button type="button"
                                data-modal-target="hotel-group-delete"
                                data-id="{{ $group->id }}"
                                data-name="{{ $groupName }}"
                                data-delete-url="{{ route('admin.hotel-groups.destroy', $group) }}"
                                class="text-red-500 hover:text-red-700 hover:scale-110 transition-all duration-300"
                                title="Eliminar">
                                <x-lucide-trash class="w-5" />
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-slate-400">
                        No hay grupos de hotel registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($hotelGroups->hasPages())
    <div class="px-6 py-4 border-t border-slate-200">
        {{ $hotelGroups->links() }}
    </div>
    @endif
</div>

<x-hotel-groups.create-new-modal />
<x-hotel-groups.hotel-group-view-modal />
<x-hotel-groups.hotel-group-edit-modal />
<x-hotel-groups.hotel-group-delete-modal />
@endsection

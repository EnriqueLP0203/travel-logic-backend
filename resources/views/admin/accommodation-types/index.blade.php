@extends('layouts.dashboard')

@section('title', 'Tipos de alojamiento')
@section('heading', 'Tipos de alojamiento')

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
            data-modal-target="accommodation-type-create"
            class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-4 py-2 rounded-md transition">
            <x-lucide-plus class="w-4 h-4" />
            Nuevo
        </button>
    </div>

    {{-- Barra de acciones --}}
    <div class="flex items-center justify-between px-6 py-3">
        <p class="text-sm text-slate-500">
            {{ $types->total() }} {{ $types->total() === 1 ? 'registro' : 'registros' }}
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
                    <th class="px-6 py-3 font-semibold text-blue-600">Tipo de alojamiento</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Icono</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Estado</th>
                    <th class="px-6 py-3 font-medium text-slate-500 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($types as $type)
                @php
                $typeName = $type->translations->first()?->name ?? '—';
                @endphp
                <tr class="hover:bg-slate-50/80">
                    <td class="px-6 py-3 text-slate-500">{{ $type->id }}</td>
                    <td class="px-6 py-3 font-medium text-slate-800">{{ $typeName }}</td>
                    <td class="px-6 py-3 text-slate-700">
                        @if ($type->icon_class)
                        <span class="inline-flex items-center gap-2">
                            <x-dynamic-component :component="$type->icon_class" class="size-4 shrink-0" />
                            <span class="text-xs text-slate-500">{{ $type->icon_class }}</span>
                        </span>
                        @else
                        <span class="text-slate-400">—</span>
                        @endif
                    </td>
                    <td class="px-6 py-3">
                        @if ($type->active)
                        <span class="inline-flex rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-700">Activo</span>
                        @else
                        <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-medium text-slate-600">Inactivo</span>
                        @endif
                    </td>
                    <td class="px-6 py-3 text-center">
                        <div class="flex items-center justify-center gap-6">
                            <button type="button"
                                data-modal-target="accommodation-type-view"
                                data-id="{{ $type->id }}"
                                data-name="{{ $typeName }}"
                                data-icon="{{ $type->icon_class }}"
                                data-active="{{ $type->active ? '1' : '0' }}"
                                class="text-slate-500 hover:text-slate-700 hover:scale-110 transition-all duration-300"
                                title="Ver">
                                <x-lucide-eye class="w-5" />
                            </button>

                            <button type="button"
                                data-modal-target="accommodation-type-edit"
                                data-id="{{ $type->id }}"
                                data-name="{{ $typeName }}"
                                data-icon="{{ $type->icon_class }}"
                                data-active="{{ $type->active ? '1' : '0' }}"
                                data-update-url="{{ route('admin.accommodation-types.update', $type) }}"
                                class="text-blue-500 hover:text-blue-700 hover:scale-110 transition-all duration-300"
                                title="Editar">
                                <x-lucide-pencil class="w-5" />
                            </button>

                            <button type="button"
                                data-modal-target="accommodation-type-delete"
                                data-id="{{ $type->id }}"
                                data-name="{{ $typeName }}"
                                data-delete-url="{{ route('admin.accommodation-types.destroy', $type) }}"
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
                        No hay tipos de alojamiento registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($types->hasPages())
    <div class="px-6 py-4 border-t border-slate-200">
        {{ $types->links() }}
    </div>
    @endif
</div>

<x-accommodation-types.create-new-modal />
<x-accommodation-types.accommodation-view-modal />
<x-accommodation-types.accommodation-edit-modal />
<x-accommodation-types.accommodation-delete-modal />
@endsection
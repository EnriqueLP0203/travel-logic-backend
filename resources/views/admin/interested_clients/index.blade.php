@extends('layouts.dashboard')

@section('title', 'Clientes interesados')
@section('heading', 'Clientes interesados')

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

<div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
    <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
        <p class="text-sm text-slate-500">Total de clientes interesados</p>
        <p class="mt-1 text-2xl font-bold text-slate-800">{{ $total }}</p>
    </div>
    <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
        <p class="text-sm text-slate-500">Pendientes de atención</p>
        <p class="mt-1 text-2xl font-bold text-amber-600">{{ $pendingCount }}</p>
    </div>
    <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
        <p class="text-sm text-slate-500">Atendidos</p>
        <p class="mt-1 text-2xl font-bold text-green-600">{{ $attendedCount }}</p>
    </div>
</div>

<div class="rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-200 px-6 py-4">
        <h2 class="text-sm font-semibold text-slate-800">Listado de clientes</h2>

        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('admin.interested-clients.index') }}"
                @class([
                    'rounded-md px-3 py-1.5 text-xs font-medium transition',
                    'bg-green-600 text-white' => ! $status,
                    'border border-slate-300 text-slate-600 hover:bg-slate-50' => $status,
                ])>
                Todos
            </a>
            <a href="{{ route('admin.interested-clients.index', ['status' => 'pending']) }}"
                @class([
                    'rounded-md px-3 py-1.5 text-xs font-medium transition',
                    'bg-amber-500 text-white' => $status === 'pending',
                    'border border-slate-300 text-slate-600 hover:bg-slate-50' => $status !== 'pending',
                ])>
                Pendientes
            </a>
            <a href="{{ route('admin.interested-clients.index', ['status' => 'attended']) }}"
                @class([
                    'rounded-md px-3 py-1.5 text-xs font-medium transition',
                    'bg-green-600 text-white' => $status === 'attended',
                    'border border-slate-300 text-slate-600 hover:bg-slate-50' => $status !== 'attended',
                ])>
                Atendidos
            </a>
        </div>
    </div>

    <div class="px-6 py-3">
        <p class="text-sm text-slate-500">
            Mostrando {{ $registros->firstItem() ?? 0 }}–{{ $registros->lastItem() ?? 0 }} de {{ $registros->total() }} elementos.
        </p>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="border-y border-slate-200 bg-slate-50 text-left">
                    <th class="w-12 px-6 py-3 font-medium text-slate-500">#</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Agencia</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Agente</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Correo</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Teléfono</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Ubicación</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Servicio</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Fecha</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Estado</th>
                    <th class="px-6 py-3 text-center font-medium text-slate-500">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($registros as $registro)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-3 text-slate-500">{{ $registros->firstItem() + $loop->index }}</td>
                        <td class="px-6 py-3 font-medium text-slate-800">{{ $registro->agency_name }}</td>
                        <td class="px-6 py-3 text-slate-700">{{ $registro->agent_name }}</td>
                        <td class="px-6 py-3 text-slate-700">{{ $registro->email }}</td>
                        <td class="px-6 py-3 text-slate-700">{{ $registro->phone }}</td>
                        <td class="px-6 py-3 text-slate-500">{{ $registro->city }}, {{ $registro->country }}</td>
                        <td class="px-6 py-3 text-slate-500">{{ $registro->service_type }}</td>
                        <td class="px-6 py-3 text-slate-500">{{ $registro->created_at?->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-3">
                            @if ($registro->is_attended)
                                <span class="inline-flex rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-700">Atendido</span>
                            @else
                                <span class="inline-flex rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-medium text-amber-700">Pendiente</span>
                            @endif
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex items-center justify-center gap-4">
                                <button
                                    type="button"
                                    data-modal-target="interested-client-attend"
                                    data-id="{{ $registro->id }}"
                                    data-client-name="{{ $registro->agent_name }}"
                                    data-is-attended="{{ $registro->is_attended ? '1' : '0' }}"
                                    data-update-url="{{ route('admin.interested-clients.update', $registro) }}"
                                    class="text-blue-500 transition-all duration-300 hover:scale-110 hover:text-blue-700"
                                    title="Actualizar atención">
                                    <x-lucide-clipboard-check class="w-5" />
                                </button>

                                <button
                                    type="button"
                                    data-modal-target="interested-client-delete"
                                    data-id="{{ $registro->id }}"
                                    data-client-name="{{ $registro->agent_name }}"
                                    data-delete-url="{{ route('admin.interested-clients.destroy', $registro) }}{{ $status ? '?status='.$status : '' }}"
                                    class="text-red-500 transition-all duration-300 hover:scale-110 hover:text-red-700"
                                    title="Eliminar">
                                    <x-lucide-trash class="w-5" />
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="px-6 py-8 text-center text-slate-400">
                            No hay clientes interesados registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($registros->hasPages())
        <div class="border-t border-slate-200 px-6 py-4">
            {{ $registros->links() }}
        </div>
    @endif
</div>

<x-interested-client-attend-modal :status="$status" />
<x-interested-client-delete-modal />
@endsection

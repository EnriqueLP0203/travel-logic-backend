@extends('layouts.dashboard')

@section('title', 'Información de clientes')
@section('heading', 'Información de clientes')

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

<div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
    <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
        <p class="text-sm text-slate-500">Total de solicitudes</p>
        <p class="mt-1 text-2xl font-bold text-slate-800">{{ $total }}</p>
    </div>
    <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
        <p class="text-sm text-slate-500">Pendientes de revisión</p>
        <p class="mt-1 text-2xl font-bold text-amber-600">{{ $pendingCount }}</p>
    </div>
    <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
        <p class="text-sm text-slate-500">Aceptadas</p>
        <p class="mt-1 text-2xl font-bold text-green-600">{{ $acceptedCount }}</p>
    </div>
    <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
        <p class="text-sm text-slate-500">Rechazadas</p>
        <p class="mt-1 text-2xl font-bold text-red-600">{{ $rejectedCount }}</p>
    </div>
</div>

<div class="rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-200 px-6 py-4">
        <h2 class="text-sm font-semibold text-slate-800">Listado de solicitudes</h2>

        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('admin.customer-information.index') }}"
                @class([
                    'rounded-md px-3 py-1.5 text-xs font-medium transition',
                    'bg-green-600 text-white' => ! $status,
                    'border border-slate-300 text-slate-600 hover:bg-slate-50' => $status,
                ])>
                Todas
            </a>
            <a href="{{ route('admin.customer-information.index', ['status' => 'pending']) }}"
                @class([
                    'rounded-md px-3 py-1.5 text-xs font-medium transition',
                    'bg-amber-500 text-white' => $status === 'pending',
                    'border border-slate-300 text-slate-600 hover:bg-slate-50' => $status !== 'pending',
                ])>
                Pendientes
            </a>
            <a href="{{ route('admin.customer-information.index', ['status' => 'accepted']) }}"
                @class([
                    'rounded-md px-3 py-1.5 text-xs font-medium transition',
                    'bg-green-600 text-white' => $status === 'accepted',
                    'border border-slate-300 text-slate-600 hover:bg-slate-50' => $status !== 'accepted',
                ])>
                Aceptadas
            </a>
            <a href="{{ route('admin.customer-information.index', ['status' => 'rejected']) }}"
                @class([
                    'rounded-md px-3 py-1.5 text-xs font-medium transition',
                    'bg-red-600 text-white' => $status === 'rejected',
                    'border border-slate-300 text-slate-600 hover:bg-slate-50' => $status !== 'rejected',
                ])>
                Rechazadas
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
                    <th class="px-6 py-3 font-semibold text-blue-600">Contacto</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Correo</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Fecha</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Estado</th>
                    <th class="px-6 py-3 text-center font-medium text-slate-500">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($registros as $registro)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-3 text-slate-500">{{ $registros->firstItem() + $loop->index }}</td>
                        <td class="px-6 py-3 text-slate-700">{{ $registro->agency_name }}</td>
                        <td class="px-6 py-3 text-slate-700">{{ $registro->contact_person }}</td>
                        <td class="px-6 py-3 text-slate-700">{{ $registro->email }}</td>
                        <td class="px-6 py-3 text-slate-500">{{ $registro->created_at?->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-3">
                            @if (! $registro->is_reviewed)
                                <span class="inline-flex rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-medium text-amber-700">Pendiente</span>
                            @elseif ($registro->is_accepted === true)
                                <span class="inline-flex rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-700">Aceptado</span>
                            @elseif ($registro->is_accepted === false)
                                <span class="inline-flex rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-700">Rechazado</span>
                            @else
                                <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-medium text-slate-700">Revisado</span>
                            @endif
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex items-center justify-center gap-4">
                                <button
                                    type="button"
                                    data-modal-target="customer-information-view"
                                    data-id="{{ $registro->id }}"
                                    data-username="{{ $registro->username }}"
                                    data-agency-name="{{ $registro->agency_name }}"
                                    data-legal-name="{{ $registro->legal_name }}"
                                    data-logo-url="{{ $registro->logo_url ?? '' }}"
                                    data-contact-person="{{ $registro->contact_person }}"
                                    data-email="{{ $registro->email }}"
                                    data-country="{{ $registro->country }}"
                                    data-state="{{ $registro->state }}"
                                    data-city="{{ $registro->city }}"
                                    data-phone="{{ $registro->phone ?? '' }}"
                                    data-mobile="{{ $registro->mobile ?? '' }}"
                                    data-billing-manager="{{ $registro->billing_manager ?? '' }}"
                                    data-billing-email="{{ $registro->billing_email ?? '' }}"
                                    data-billing-address="{{ $registro->billing_address }}"
                                    data-billing-country="{{ $registro->billing_country ?? '' }}"
                                    data-billing-state="{{ $registro->billing_state ?? '' }}"
                                    data-billing-city="{{ $registro->billing_city ?? '' }}"
                                    data-billing-zip-code="{{ $registro->billing_zip_code }}"
                                    data-billing-phone="{{ $registro->billing_phone ?? '' }}"
                                    data-billing-phone-2="{{ $registro->billing_phone_2 ?? '' }}"
                                    data-billing-mobile="{{ $registro->billing_mobile ?? '' }}"
                                    data-billing-tax-id="{{ $registro->billing_tax_id }}"
                                    data-billing-same-as-contact="{{ $registro->billing_same_as_contact ? '1' : '0' }}"
                                    data-status-label="{{ $registro->status_label }}"
                                    data-created-at="{{ $registro->created_at?->format('d/m/Y H:i') ?? '' }}"
                                    class="text-slate-500 transition-all duration-300 hover:scale-110 hover:text-slate-700"
                                    title="Ver">
                                    <x-lucide-eye class="w-5" />
                                </button>

                                <button
                                    type="button"
                                    data-modal-target="customer-information-review"
                                    data-id="{{ $registro->id }}"
                                    data-agency-name="{{ $registro->agency_name }}"
                                    data-is-reviewed="{{ $registro->is_reviewed ? '1' : '0' }}"
                                    data-is-accepted="{{ $registro->is_accepted === null ? '' : ($registro->is_accepted ? '1' : '0') }}"
                                    data-update-url="{{ route('admin.customer-information.update', $registro) }}"
                                    class="text-blue-500 transition-all duration-300 hover:scale-110 hover:text-blue-700"
                                    title="Revisar">
                                    <x-lucide-clipboard-check class="w-5" />
                                </button>

                                <button
                                    type="button"
                                    data-modal-target="customer-information-delete"
                                    data-id="{{ $registro->id }}"
                                    data-agency-name="{{ $registro->agency_name }}"
                                    data-delete-url="{{ route('admin.customer-information.destroy', $registro) }}{{ $status ? '?status='.$status : '' }}"
                                    class="text-red-500 transition-all duration-300 hover:scale-110 hover:text-red-700"
                                    title="Eliminar">
                                    <x-lucide-trash class="w-5" />
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-slate-400">
                            No hay solicitudes registradas.
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

<x-customer-information-view-modal />
<x-customer-information-review-modal :status="$status" />
<x-customer-information-delete-modal />
@endsection

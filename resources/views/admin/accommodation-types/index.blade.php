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
                    <th class="px-6 py-3 font-semibold text-blue-600">Tipo de alojamiento</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Icono</th>
                    <th class="px-6 py-3 font-semibold text-blue-600">Estado</th>
                    <th class="px-6 py-3 font-medium text-slate-500 text-center">Acciones</th>
                </tr>
            </thead>
</div>

<x-accommodation-types.create-new-modal />
@endsection
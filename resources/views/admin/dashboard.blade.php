@extends('layouts.dashboard')

@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="flex w-full flex-col items-start justify-between gap-2 rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-sm text-slate-500">Total de hoteles</p>
            <p class="text-2xl font-bold text-slate-800">{{ number_format($stats['hotels']) }}</p>
        </div>
        <div class="flex w-full flex-col items-start justify-between gap-2 rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-sm text-slate-500">Total de destinos</p>
            <p class="text-2xl font-bold text-slate-800">{{ number_format($stats['destinations']) }}</p>
        </div>
        <div class="flex w-full flex-col items-start justify-between gap-2 rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-sm text-slate-500">Grupos de hotel</p>
            <p class="text-2xl font-bold text-slate-800">{{ number_format($stats['hotel_groups']) }}</p>
        </div>
        <div class="flex w-full flex-col items-start justify-between gap-2 rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-sm text-slate-500">Tipos de alojamiento</p>
            <p class="text-2xl font-bold text-slate-800">{{ number_format($stats['accommodation_types']) }}</p>
        </div>
    </div>

    <div>
        <h2 class="mb-3 text-sm font-semibold text-slate-800">Estado de hoteles</h2>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <div class="flex w-full flex-col items-start justify-between gap-2 rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                <p class="text-sm text-slate-500">Publicados</p>
                <p class="text-2xl font-bold text-slate-800">{{ number_format($stats['hotels_published']) }}</p>
            </div>
            <div class="flex w-full flex-col items-start justify-between gap-2 rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                <p class="text-sm text-slate-500">Destacados</p>
                <p class="text-2xl font-bold text-slate-800">{{ number_format($stats['hotels_featured']) }}</p>
            </div>
            <div class="flex w-full flex-col items-start justify-between gap-2 rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                <p class="text-sm text-slate-500">Activos</p>
                <p class="text-2xl font-bold text-slate-800">{{ number_format($stats['hotels_active']) }}</p>
            </div>
        </div>
    </div>

    <div>
        <h2 class="mb-3 text-sm font-semibold text-slate-800">Requieren atención</h2>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <a href="{{ route('admin.hotels.index', ['without_groups' => 1]) }}"
                class="flex w-full flex-col items-start justify-between gap-2 rounded-lg border border-slate-200 bg-white p-4 shadow-sm transition hover:border-blue-300 hover:bg-slate-50">
                <p class="text-sm text-slate-500">Sin grupo</p>
                <p class="text-2xl font-bold text-slate-800">{{ number_format($stats['hotels_without_groups']) }}</p>
            </a>
            <a href="{{ route('admin.hotels.index', ['without_types' => 1]) }}"
                class="flex w-full flex-col items-start justify-between gap-2 rounded-lg border border-slate-200 bg-white p-4 shadow-sm transition hover:border-blue-300 hover:bg-slate-50">
                <p class="text-sm text-slate-500">Sin tipo de alojamiento</p>
                <p class="text-2xl font-bold text-slate-800">{{ number_format($stats['hotels_without_types']) }}</p>
            </a>
            <a href="{{ route('admin.hotels.index', ['published' => 0]) }}"
                class="flex w-full flex-col items-start justify-between gap-2 rounded-lg border border-slate-200 bg-white p-4 shadow-sm transition hover:border-blue-300 hover:bg-slate-50">
                <p class="text-sm text-slate-500">No publicados</p>
                <p class="text-2xl font-bold text-slate-800">{{ number_format($stats['hotels_unpublished']) }}</p>
            </a>
        </div>
    </div>
</div>
@endsection

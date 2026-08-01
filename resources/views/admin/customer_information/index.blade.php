@extends('layouts.dashboard')

@section('title', 'Información de clientes')
@section('heading', 'Información de clientes')

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="flex w-full flex-col items-start justify-between gap-2 rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-sm text-slate-500">Total de clientes</p>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@php
    $form = request('form') === 'register' ? 'register' : 'login';
@endphp

@section('title', $form === 'register' ? 'Registro - Travel Logic' : 'Iniciar sesión - Travel Logic')

@section('content')
<div class="mx-auto w-full max-w-[1600px] px-2 py-12 sm:px-3 md:px-4 lg:px-6 lg:py-20">
    <x-animate-in>
        <div class="mx-auto w-full max-w-xl">
            {{-- Pestañas --}}
            <div class="mb-8 grid grid-cols-2 gap-2 rounded-full bg-stone-100 p-1.5">
                <a href="{{ route('auth-traveler', ['form' => 'login']) }}"
                    @class([
                        'flex h-11 items-center justify-center rounded-full text-sm font-semibold transition-colors duration-200',
                        'bg-green-1 text-white shadow' => $form === 'login',
                        'text-stone-600 hover:text-stone-900' => $form !== 'login',
                    ])>
                    Iniciar sesión
                </a>
                <a href="{{ route('auth-traveler', ['form' => 'register']) }}"
                    @class([
                        'flex h-11 items-center justify-center rounded-full text-sm font-semibold transition-colors duration-200',
                        'bg-blue-1 text-white shadow' => $form === 'register',
                        'text-stone-600 hover:text-stone-900' => $form !== 'register',
                    ])>
                    Registrarse
                </a>
            </div>

            {{-- Formulario correspondiente --}}
            @if ($form === 'register')
                <x-register-traveler-form :action="route('traveler.register')" />
            @else
                <x-login-traveler-form :action="route('traveler.login')" />
            @endif
        </div>
    </x-animate-in>
</div>
@endsection

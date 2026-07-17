@extends('layouts.admin-auth')

@section('title', 'Iniciar sesión')

@section('content')
<div class="flex min-h-screen">
    {{-- Panel de marca (desktop) --}}
    <aside class="hidden w-1/2 flex-col justify-between bg-blue-400 px-10 py-12 text-white lg:flex">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo.webp') }}" alt="Travel Logic" class="w-14" />
            <div>
                <p class="font-montserrat text-base font-bold tracking-wide">Travel Logic</p>
                <p class="font-lato text-sm text-blue-100">Panel admin</p>
            </div>
        </div>

        <div class="max-w-md">
            <h1 class="font-montserrat text-3xl font-bold leading-tight">
                Administra la pagina web de Travel Logic
            </h1>
            <p class="mt-4 font-lato text-sm leading-relaxed text-blue-100">
                Accede al panel para gestionar hoteles, destinos, grupos y tipos de alojamiento.
            </p>
        </div>

        <p class="font-lato text-xs text-blue-100/70">
            &copy; {{ date('Y') }} Travel Logic
        </p>
    </aside>

    {{-- Formulario --}}
    <div class="flex w-full flex-1 flex-col items-center justify-center px-6 py-12 lg:w-1/2 lg:px-12">
        {{-- Marca (mobile) --}}
        <div class="mb-8 flex items-center gap-3 lg:hidden">
            <img src="{{ asset('images/logo.webp') }}" alt="Travel Logic" class="w-12" />
            <div>
                <p class="font-montserrat text-sm font-bold tracking-wide text-blue-400">Travel Logic</p>
                <p class="font-lato text-xs text-slate-500">Panel admin</p>
            </div>
        </div>

        <div class="w-full max-w-md rounded-lg border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            <h2 class="font-montserrat text-xl font-bold text-slate-800">
                Iniciar sesión
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Ingresa tus credenciales para continuar.
            </p>

            @if (session('status'))
                <div class="mt-4 rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mt-4 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="mt-6 flex flex-col gap-5">
                @csrf

                <div class="flex flex-col gap-1.5">
                    <label for="username" class="text-sm font-medium text-slate-700">Usuario</label>
                    <input
                        id="username"
                        type="text"
                        name="username"
                        value="{{ old('username') }}"
                        placeholder="Tu usuario"
                        maxlength="255"
                        required
                        autocomplete="username"
                        @class([
                            'h-11 w-full rounded-md border px-3 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-green-400/40',
                            'border-slate-300' => ! $errors->has('username'),
                            'border-red-500' => $errors->has('username'),
                        ])
                    />
                    @error('username')
                        <p class="text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="password" class="text-sm font-medium text-slate-700">Contraseña</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Tu contraseña"
                        required
                        autocomplete="current-password"
                        @class([
                            'h-11 w-full rounded-md border px-3 text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-green-400/40',
                            'border-slate-300' => ! $errors->has('password'),
                            'border-red-500' => $errors->has('password'),
                        ])
                    />
                    @error('password')
                        <p class="text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <label class="flex cursor-pointer items-center gap-2.5">
                    <input
                        type="checkbox"
                        name="remember"
                        class="size-4 shrink-0 rounded border border-slate-300 accent-green-400"
                    />
                    <span class="text-sm text-slate-600">Recordarme</span>
                </label>

                <button
                    type="submit"
                    class="mt-1 inline-flex h-11 w-full items-center justify-center rounded-md bg-green-600 text-sm font-medium text-white transition hover:bg-green-700"
                >
                    Iniciar sesión
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

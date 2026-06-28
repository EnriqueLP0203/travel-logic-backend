@props([
    'action' => '#',
])

<section
    aria-label="Formulario de registro de viajero"
    class="w-full rounded-lg border border-indigo-950/20 bg-white p-6 shadow-xl sm:p-8 md:p-10"
>
    <h2 class="mb-2 text-3xl font-bold leading-tight text-indigo-950 md:text-4xl">
        Crear cuenta
    </h2>
    <p class="mb-8 text-sm text-gray-500">
        Regístrate para dejar reseñas de los hoteles que visites.
    </p>

    @if (session('status'))
        <div class="mb-6 rounded-lg border border-emerald-500 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ $action }}" class="flex flex-col gap-5">
        @csrf

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            {{-- Nombre --}}
            <div class="flex flex-col gap-1.5">
                <label for="register_first_name" class="text-sm font-medium text-indigo-950">Nombre</label>
                <input
                    id="register_first_name"
                    type="text"
                    name="first_name"
                    value="{{ old('first_name') }}"
                    placeholder="Tu nombre"
                    maxlength="100"
                    required
                    autocomplete="given-name"
                    @class([
                        'h-12 w-full rounded-lg border px-4 text-base text-stone-900 placeholder:text-stone-900/40 focus:outline-none focus:ring-2 focus:ring-blue-1/30',
                        'border-stone-300' => ! $errors->has('first_name'),
                        'border-red-500' => $errors->has('first_name'),
                    ])
                />
                @error('first_name')
                    <p class="text-xs font-medium text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Apellido --}}
            <div class="flex flex-col gap-1.5">
                <label for="register_last_name" class="text-sm font-medium text-indigo-950">Apellido</label>
                <input
                    id="register_last_name"
                    type="text"
                    name="last_name"
                    value="{{ old('last_name') }}"
                    placeholder="Tu apellido"
                    maxlength="100"
                    required
                    autocomplete="family-name"
                    @class([
                        'h-12 w-full rounded-lg border px-4 text-base text-stone-900 placeholder:text-stone-900/40 focus:outline-none focus:ring-2 focus:ring-blue-1/30',
                        'border-stone-300' => ! $errors->has('last_name'),
                        'border-red-500' => $errors->has('last_name'),
                    ])
                />
                @error('last_name')
                    <p class="text-xs font-medium text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Email --}}
        <div class="flex flex-col gap-1.5">
            <label for="register_email" class="text-sm font-medium text-indigo-950">Correo electrónico</label>
            <input
                id="register_email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="tucorreo@ejemplo.com"
                maxlength="255"
                required
                autocomplete="email"
                @class([
                    'h-12 w-full rounded-lg border px-4 text-base text-stone-900 placeholder:text-stone-900/40 focus:outline-none focus:ring-2 focus:ring-blue-1/30',
                    'border-stone-300' => ! $errors->has('email'),
                    'border-red-500' => $errors->has('email'),
                ])
            />
            @error('email')
                <p class="text-xs font-medium text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Contraseña --}}
        <div class="flex flex-col gap-1.5">
            <label for="register_password" class="text-sm font-medium text-indigo-950">Contraseña</label>
            <input
                id="register_password"
                type="password"
                name="password"
                placeholder="Mínimo 8 caracteres"
                required
                autocomplete="new-password"
                @class([
                    'h-12 w-full rounded-lg border px-4 text-base text-stone-900 placeholder:text-stone-900/40 focus:outline-none focus:ring-2 focus:ring-blue-1/30',
                    'border-stone-300' => ! $errors->has('password'),
                    'border-red-500' => $errors->has('password'),
                ])
            />
            @error('password')
                <p class="text-xs font-medium text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirmar contraseña --}}
        <div class="flex flex-col gap-1.5">
            <label for="register_password_confirmation" class="text-sm font-medium text-indigo-950">Confirmar contraseña</label>
            <input
                id="register_password_confirmation"
                type="password"
                name="password_confirmation"
                placeholder="Repite tu contraseña"
                required
                autocomplete="new-password"
                class="h-12 w-full rounded-lg border border-stone-300 px-4 text-base text-stone-900 placeholder:text-stone-900/40 focus:outline-none focus:ring-2 focus:ring-blue-1/30"
            />
        </div>

        <button
            type="submit"
            class="mt-2 h-12 w-full rounded-lg bg-blue-1 text-base font-semibold text-white transition-opacity duration-200 hover:opacity-90"
        >
            Registrarme
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-stone-600">
        ¿Ya tienes cuenta?
        <a href="{{ route('auth-traveler', ['form' => 'login']) }}"
            class="font-semibold text-green-1 hover:underline">
            Inicia sesión
        </a>
    </p>
</section>

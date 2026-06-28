@props([
    'action' => '#',
])

<section
    aria-label="Formulario de inicio de sesión"
    class="w-full rounded-lg border border-indigo-950/20 bg-white p-6 shadow-xl sm:p-8 md:p-10"
>
    <h2 class="mb-2 text-3xl font-bold leading-tight text-indigo-950 md:text-4xl">
        Iniciar sesión
    </h2>
    <p class="mb-8 text-sm text-gray-500">
        Bienvenido de nuevo. Ingresa tus datos para continuar.
    </p>

    @if (session('status'))
        <div class="mb-6 rounded-lg border border-emerald-500 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ $action }}" class="flex flex-col gap-5">
        @csrf

        {{-- Email --}}
        <div class="flex flex-col gap-1.5">
            <label for="login_email" class="text-sm font-medium text-indigo-950">Correo electrónico</label>
            <input
                id="login_email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="tucorreo@ejemplo.com"
                maxlength="255"
                required
                autocomplete="email"
                @class([
                    'h-12 w-full rounded-lg border px-4 text-base text-stone-900 placeholder:text-stone-900/40 focus:outline-none focus:ring-2 focus:ring-green-1/30',
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
            <label for="login_password" class="text-sm font-medium text-indigo-950">Contraseña</label>
            <input
                id="login_password"
                type="password"
                name="password"
                placeholder="Tu contraseña"
                required
                autocomplete="current-password"
                @class([
                    'h-12 w-full rounded-lg border px-4 text-base text-stone-900 placeholder:text-stone-900/40 focus:outline-none focus:ring-2 focus:ring-green-1/30',
                    'border-stone-300' => ! $errors->has('password'),
                    'border-red-500' => $errors->has('password'),
                ])
            />
            @error('password')
                <p class="text-xs font-medium text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Recordarme --}}
        <label class="flex cursor-pointer items-center gap-2.5">
            <input
                type="checkbox"
                name="remember"
                class="size-4 shrink-0 rounded-[3px] border border-stone-400 accent-green-1"
            />
            <span class="text-sm text-stone-700">Recordarme</span>
        </label>

        <button
            type="submit"
            class="mt-2 h-12 w-full rounded-lg bg-green-1 text-base font-semibold text-white transition-opacity duration-200 hover:opacity-90"
        >
            Iniciar sesión
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-stone-600">
        ¿No tienes cuenta?
        <a href="{{ route('auth-traveler', ['form' => 'register']) }}"
            class="font-semibold text-blue-1 hover:underline">
            Regístrate
        </a>
    </p>
</section>

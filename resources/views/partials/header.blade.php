@php
$navItems = [
    ['route' => 'home', 'label' => 'Inicio'],
    ['route' => 'about', 'label' => 'Nosotros'],
    ['route' => 'contact', 'label' => 'Contacto'],
    ['route' => 'offers', 'label' => 'Ofertas'],
    ['route' => 'hotels', 'label' => 'Hospedajes'],
];
@endphp

<header class="sticky top-0 z-50 bg-white shadow-md">
    <div class="flex h-9 items-center justify-between bg-blue-400 px-14">
        <p class="text-xs font-normal font-lato text-white">🌍 Operadora Mayorista · México y el Caribe</p>

        <div class="flex items-center gap-6">
            <a class="text-xs font-normal font-inter text-white">Soporte 24/7</a>
            <div class="flex items-center gap-2">
                <a class="text-xs font-semibold font-inter text-green-400">Ingresa al Portal</a>
                <x-lucide-arrow-right class="h-4 w-4 text-green-400" />
            </div>
        </div>
    </div>

    <div class="flex items-center justify-between px-14 py-6">
        <div class="flex items-center gap-8 md:gap-12">
            <a href="{{ route('home') }}" aria-label="Ir al inicio">
                <img src="{{ asset('images/logo.webp') }}" alt="Travel Logic" class="w-20" />
            </a>

            <nav class="flex items-center gap-4 md:gap-8">
                @foreach ($navItems as $item)
                    <a
                        href="{{ route($item['route']) }}"
                        class="text-sm font-semibold transition-colors duration-200 hover:text-green-1 md:text-xl {{ request()->routeIs($item['route']) ? 'text-green-1' : 'text-stone-900' }}"
                    >
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>
        </div>

        <div class="flex items-center gap-2">
            @guest
                <a
                    href="{{ route('auth-traveler', ['form' => 'register']) }}"
                    class="px-4 py-2 text-lg font-semibold text-stone-900 transition-opacity duration-200 hover:opacity-90"
                >
                    Registrarse
                </a>
                <a
                    href="{{ route('auth-traveler', ['form' => 'login']) }}"
                    class="rounded-lg bg-green-400 px-4 py-2 text-lg font-semibold text-white transition-opacity duration-200 hover:opacity-90"
                >
                    Iniciar sesión
                </a>
            @else
                <div class="relative" data-profile-menu-container>
                    <button
                        type="button"
                        data-profile-toggle
                        aria-label="Abrir menú de perfil"
                        aria-expanded="false"
                        class="flex h-11 w-11 items-center justify-center rounded-full border border-stone-200 bg-stone-50 text-stone-700 transition-colors duration-200 hover:border-green-1 hover:bg-green-1/10 hover:text-green-1"
                    >
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </button>

                    <div
                        data-profile-menu
                        class="absolute right-0 top-full z-50 mt-2 hidden w-56 overflow-hidden rounded-lg border border-stone-200 bg-white shadow-xl"
                    >
                        <div class="border-b border-stone-100 px-4 py-3">
                            <p class="text-sm font-semibold text-stone-900">
                                {{ auth()->user()->traveler?->first_name ?? 'Viajero' }}
                            </p>
                        </div>

                        <div class="p-2">
                            <form method="POST" action="{{ route('traveler.logout') }}">
                                @csrf
                                <button
                                    type="submit"
                                    class="flex w-full items-center justify-center rounded-lg px-4 py-2.5 text-sm font-semibold text-stone-700 transition-colors duration-200 hover:bg-stone-100"
                                >
                                    Cerrar sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endguest
        </div>
    </div>
</header>

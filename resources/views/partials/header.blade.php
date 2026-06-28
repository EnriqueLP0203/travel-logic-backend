@php
$navItems = [
['route' => 'home', 'label' => 'Inicio', 'end' => true],
['route' => 'about', 'label' => 'Nosotros'],
['route' => 'blog', 'label' => 'Blog'],
['route' => 'destinations', 'label' => 'Destinos'],
['route' => 'quoter', 'label' => 'Cotizador'],
];
@endphp

<header class="sticky top-0 left-0 right-0 z-50 bg-white shadow-md">
    <div class="flex justify-between items-center h-auto w-full px-14 py-6 mt-4">
        <img src="{{ asset('images/logo.webp') }}" alt="Travel Logic" class="w-32 h-auto" />

        <nav class="flex items-center gap-4 md:gap-16">
            @foreach ($navItems as $item)
            <a
                href="{{ route($item['route']) }}"
                class="font-semibold text-sm md:text-xl transition-colors duration-200 hover:text-green-1 {{ request()->routeIs($item['route']) ? 'text-green-1' : 'text-stone-900' }}">
                {{ $item['label'] }}
            </a>
            @endforeach

            @guest
                <a href="{{ route('auth-traveler', ['form' => 'login']) }}"
                    class="bg-green-1 text-white px-4 py-2 rounded-full transition-opacity duration-200 hover:opacity-90">
                    <span class="text-white text-lg font-semibold px-2">Iniciar sesion</span>
                </a>
                <a href="{{ route('auth-traveler', ['form' => 'register']) }}"
                    class="bg-blue-1 text-white px-4 py-2 rounded-full transition-opacity duration-200 hover:opacity-90">
                    <span class="text-white text-lg font-semibold px-2">Registrarse</span>
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
        </nav>
    </div>
</header>
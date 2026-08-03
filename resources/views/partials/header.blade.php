@php
$navItems = [
    ['route' => 'home', 'label' => 'Inicio'],
    ['route' => 'about', 'label' => 'Nosotros'],
    ['route' => 'contact', 'label' => 'Contacto'],
    ['route' => 'offers', 'label' => 'Ofertas'],
    ['route' => 'hotels', 'label' => 'Hospedajes'],
];
@endphp

<header class="sticky top-0 z-50 bg-white shadow-md" x-data="{ mobileMenuOpen: false }">
    <div class="flex h-9 items-center justify-between bg-blue-400 px-4 sm:px-6 lg:px-14">
        <p class="hidden text-xs font-normal font-lato text-white sm:block">🌍 Operadora Mayorista · México y el Caribe</p>

        <div class="flex items-center gap-6">
            <a class="text-xs font-normal font-inter text-white">Soporte 24/7</a>
        </div>
    </div>

    <div class="flex items-center justify-between px-4 py-4 sm:px-6 sm:py-5 lg:px-14 lg:py-6">
        <div class="flex items-center gap-4 md:gap-8 lg:gap-12">
            <a href="{{ route('home') }}" aria-label="Ir al inicio">
                <img src="{{ asset('images/logo.webp') }}" alt="Travel Logic" class="w-16 sm:w-20" />
            </a>

            <nav class="hidden items-center gap-4 lg:flex md:gap-8">
                @foreach ($navItems as $item)
                    <a
                        href="{{ route($item['route']) }}"
                        class="text-sm font-semibold transition-colors duration-200 hover:text-green-300 md:text-xl {{ request()->routeIs($item['route']) ? 'text-green-300' : 'text-stone-900' }}"
                    >
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>
        </div>

        <div class="flex items-center gap-2">
            {{-- Desktop auth buttons --}}
            <div class="hidden items-center gap-2 lg:flex">
                @guest('web')
                    <a
                        href="{{ route('register-agency') }}"
                        class="px-4 py-2 text-lg font-semibold text-stone-900 transition-all duration-200 hover:-translate-y-0.5 hover:opacity-90"
                    >
                        Registrarse
                    </a>
                    <a
                        href="https://www.partners.travel-logic.com/site/login"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="rounded-lg bg-green-400 px-4 py-2 text-lg font-semibold text-white transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md"
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
                            class="flex h-11 w-11 items-center justify-center rounded-full border border-stone-200 bg-stone-50 text-stone-700 transition-colors duration-200 hover:border-green-300 hover:bg-green-300/10 hover:text-green-300"
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
                                    {{ auth('web')->user()->traveler?->first_name ?? 'Viajero' }}
                                </p>
                            </div>

                            <div class="p-2">
                                @if (Route::has('traveler.logout'))
                                    <form method="POST" action="{{ route('traveler.logout') }}">
                                        @csrf
                                        <button
                                            type="submit"
                                            class="flex w-full items-center justify-center rounded-lg px-4 py-2.5 text-sm font-semibold text-stone-700 transition-colors duration-200 hover:bg-stone-100"
                                        >
                                            Cerrar sesión
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endguest
            </div>

            {{-- Mobile hamburger button --}}
            <button
                type="button"
                class="flex h-10 w-10 items-center justify-center rounded-lg text-stone-900 transition-colors duration-200 hover:bg-stone-100 lg:hidden"
                aria-label="Abrir menú de navegación"
                :aria-expanded="mobileMenuOpen"
                @click="mobileMenuOpen = !mobileMenuOpen"
            >
                <svg x-show="!mobileMenuOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="mobileMenuOpen" x-cloak class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile menu panel --}}
    <div
        x-show="mobileMenuOpen"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="border-t border-stone-100 bg-white px-4 py-4 lg:hidden"
        @click.outside="mobileMenuOpen = false"
    >
        <nav class="flex flex-col gap-1">
            @foreach ($navItems as $item)
                <a
                    href="{{ route($item['route']) }}"
                    @click="mobileMenuOpen = false"
                    class="rounded-lg px-4 py-3 text-base font-semibold transition-colors duration-200 hover:bg-stone-50 {{ request()->routeIs($item['route']) ? 'text-green-300' : 'text-stone-900' }}"
                >
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        @guest('web')
            <div class="mt-4 flex flex-col gap-2 border-t border-stone-100 pt-4">
                <a
                    href="{{ route('register-agency') }}"
                    @click="mobileMenuOpen = false"
                    class="rounded-lg px-4 py-3 text-center text-base font-semibold text-stone-900 transition-colors duration-200 hover:bg-stone-50"
                >
                    Registrarse
                </a>
                <a
                    href="https://www.partners.travel-logic.com/site/login"
                    target="_blank"
                    rel="noopener noreferrer"
                    @click="mobileMenuOpen = false"
                    class="rounded-lg bg-green-400 px-4 py-3 text-center text-base font-semibold text-white transition-all duration-200 hover:bg-green-300"
                >
                    Iniciar sesión
                </a>
            </div>
        @else
            <div class="mt-4 border-t border-stone-100 pt-4">
                <p class="mb-2 px-4 text-sm font-semibold text-stone-900">
                    {{ auth('web')->user()->traveler?->first_name ?? 'Viajero' }}
                </p>
                @if (Route::has('traveler.logout'))
                    <form method="POST" action="{{ route('traveler.logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="w-full rounded-lg px-4 py-3 text-left text-base font-semibold text-stone-700 transition-colors duration-200 hover:bg-stone-50"
                        >
                            Cerrar sesión
                        </button>
                    </form>
                @endif
            </div>
        @endguest
    </div>
</header>

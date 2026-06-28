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

            <a href="{{ route('auth-traveler', ['form' => 'login']) }}"
                class="bg-green-1 text-white px-4 py-2 rounded-full transition-opacity duration-200 hover:opacity-90">
                <span class="text-white text-lg font-semibold px-2">Iniciar sesion</span>
            </a>
            <a href="{{ route('auth-traveler', ['form' => 'register']) }}"
                class="bg-blue-1 text-white px-4 py-2 rounded-full transition-opacity duration-200 hover:opacity-90">
                <span class="text-white text-lg font-semibold px-2">Registrarse</span>
            </a>
        </nav>
    </div>
</header>
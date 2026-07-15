@php
$navItems = [
    [
        'route' => 'admin.dashboard',
        'active' => 'admin.dashboard',
        'label' => 'Dashboard',
        'icon' => 'lucide-layout-dashboard',
    ],
    [
        'route' => 'admin.hotels.index',
        'active' => 'admin.hotels.*',
        'label' => 'Hoteles',
        'icon' => 'lucide-building-2',
    ],
    [
        'route' => 'admin.destinations.index',
        'active' => 'admin.destinations.*',
        'label' => 'Destinos',
        'icon' => 'lucide-map-pin',
    ],
    [
        'route' => 'admin.hotel-groups.index',
        'active' => 'admin.hotel-groups.*',
        'label' => 'Grupos de hotel',
        'icon' => 'lucide-tags',
    ],
    [
        'route' => 'admin.accommodation-types.index',
        'active' => 'admin.accommodation-types.*',
        'label' => 'Tipos de alojamiento',
        'icon' => 'lucide-bed-double',
    ],
    [
        'route' => 'admin.agencies.index',
        'active' => 'admin.agencies.*',
        'label' => 'Agencias',
        'icon' => 'lucide-briefcase',
    ],
    [
        'route' => 'admin.reviews.index',
        'active' => 'admin.reviews.*',
        'label' => 'Reseñas',
        'icon' => 'lucide-star',
    ],
];
@endphp

<aside class="sticky top-0 flex h-screen w-64 shrink-0 flex-col bg-blue-400 text-white">
    <div class="flex items-center gap-3 border-b border-white/10 px-5 py-6">
        <img src="{{ asset('images/logo.webp') }}" alt="Travel Logic" class="w-12" />
        <div>
            <p class="font-montserrat text-sm font-bold tracking-wide">Travel Logic</p>
            <p class="font-lato text-xs text-blue-100">Panel admin</p>
        </div>
    </div>

    <nav class="flex flex-1 flex-col gap-1 px-3 py-4">
        @foreach ($navItems as $item)
            @php
                $isActive = request()->routeIs($item['active']);
            @endphp
            <a
                href="{{ route($item['route']) }}"
                @class([
                    'flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold transition-colors duration-150',
                    'bg-green-400 text-blue-400' => $isActive,
                    'text-white/80 hover:bg-white/10 hover:text-white' => ! $isActive,
                ])
            >
                <x-dynamic-component :component="$item['icon']" class="size-4 shrink-0" />
                {{ $item['label'] }}
            </a>
        @endforeach
    </nav>

    <div class="border-t border-white/10 px-5 py-4">
        <a
            href="{{ route('home') }}"
            class="flex items-center gap-2 text-xs font-medium text-blue-100 transition-colors hover:text-white"
        >
            <x-lucide-external-link class="size-3.5" />
            Ver sitio público
        </a>
    </div>
</aside>

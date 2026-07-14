@props(['name', 'location' => null, 'image' => null, 'url' => '#'])

<div class="w-full overflow-hidden rounded-3xl bg-white shadow-[10px_18px_44px_0_rgba(0,0,0,0.06)] transition-transform duration-200 hover:scale-[1.02]">
    <div class="h-[276px] w-full overflow-hidden bg-[#D9D9D9]">
        @if ($image)
            <img src="{{ $image }}" alt="{{ $name }}" class="h-full w-full object-cover transition-transform duration-300 hover:scale-105" />
        @else
            <div class="flex h-full w-full items-center justify-center">
                <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9.75L12 3l9 6.75V21a.75.75 0 01-.75.75H3.75A.75.75 0 013 21V9.75z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 21V12h6v9" />
                </svg>
            </div>
        @endif
    </div>
    <div class="p-6">
        <p class="text-lg font-bold leading-snug text-indigo-950">{{ $name }}</p>
        @if ($location)
            <div class="mt-2 flex items-center gap-1 text-base font-bold text-[#888]">
                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                </svg>
                <span>{{ $location }}</span>
            </div>
        @endif
        <a href="{{ $url }}" class="mt-4 inline-flex items-center justify-center gap-2 rounded-[10px] bg-[#4CAF20] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#409c1b]">
            Ver más
        </a>
    </div>
</div>
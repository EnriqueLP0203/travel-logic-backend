@extends('layouts.app')

@section('title', 'Ofertas - Travel Logic')

@section('content')
<div class="mx-auto w-full max-w-[1600px] px-2 pb-10 sm:px-3 md:px-4 lg:px-6 lg:pb-16 mt-24">
    <x-animate-in>
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-indigo-950 sm:text-4xl lg:text-5xl">Ofertas</h1>
            <div class="mt-2 h-1 w-16 rounded-full bg-[#4CAF20]"></div>
        </div>

        @if ($featuredHotels->isNotEmpty())
            @if ($featuredHotels->count() > 4)
                <div class="relative py-4">
                    <div id="offers-viewport" class="overflow-hidden bg-transparent px-2 pt-4 pb-12 sm:px-4">
                        <div id="offers-track" class="flex transition-transform duration-500 ease-in-out">
                            @foreach ($featuredHotels as $hotel)
                                <div class="shrink-0 px-4 sm:px-5 md:px-6">
                                    <x-hotel-card :hotel="$hotel" />
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button id="offers-prev" type="button" class="absolute left-2 top-[calc(50%-1rem)] z-10 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-[#EAFFE1] shadow-[2px_8px_28px_0_rgba(0,0,0,0.16)] transition-all duration-200 hover:-translate-y-0.5 hover:bg-[#ddf7d4] sm:left-4">
                        <svg class="h-4 w-4" fill="none" stroke="#4CAF20" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button id="offers-next" type="button" class="absolute right-2 top-[calc(50%-1rem)] z-10 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-[#EAFFE1] shadow-[2px_8px_28px_0_rgba(0,0,0,0.16)] transition-all duration-200 hover:-translate-y-0.5 hover:bg-[#ddf7d4] sm:right-4">
                        <svg class="h-4 w-4" fill="none" stroke="#4CAF20" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            @else
                <div class="grid grid-cols-1 gap-8 py-2 sm:grid-cols-2 xl:grid-cols-3 justify-items-center">
                    @foreach ($featuredHotels as $hotel)
                        <x-animate-in delay="{{ $loop->index * 80 }}" variant="subtle">
                            <x-hotel-card :hotel="$hotel" />
                        </x-animate-in>
                    @endforeach
                </div>
            @endif
        @else
            <div class="flex flex-col items-center justify-center py-20 text-gray-400">
                <svg class="mb-4 h-16 w-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 9.75L12 3l9 6.75V21a.75.75 0 01-.75.75H3.75A.75.75 0 013 21V9.75z" />
                </svg>
                <p class="text-lg font-medium">No hay hoteles destacados por el momento.</p>
            </div>
        @endif
    </x-animate-in>
</div>

@if ($promotionalOffers->isNotEmpty())
    @foreach ($promotionalOffers as $offer)
        <x-animate-in variant="subtle">
            <section class="relative w-full" aria-label="{{ $offer->name }}">
                @if ($offer->image_url)
                    <img
                        src="{{ $offer->image_url }}"
                        alt="{{ $offer->name }}"
                        class="block h-auto w-full"
                    />
                @endif

                @if ($offer->link)
                    <a
                        href="{{ $offer->link }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="absolute bottom-4 right-4 inline-flex items-center gap-2 rounded-lg bg-green-300 px-4 py-2 text-base font-bold font-inter text-white transition-all duration-200 hover:-translate-y-0.5 hover:bg-green-400 hover:shadow-md sm:bottom-8 sm:right-8"
                    >
                        Ver más
                    </a>
                @endif
            </section>
        </x-animate-in>
    @endforeach
@endif

@if ($featuredHotels->count() > 4)
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const track = document.getElementById('offers-track');
        if (!track) return;

        const slides = [...track.children];
        const total = slides.length;
        const clones = Math.min(total, 4);
        let index = clones;
        let animating = false;

        for (let i = 0; i < clones; i++) {
            track.appendChild(slides[i].cloneNode(true));
            track.insertBefore(slides[total - 1 - i].cloneNode(true), track.firstChild);
        }

        const width = () => track.children[0].getBoundingClientRect().width;
        const goTo = (i, animate = true) => {
            track.style.transition = animate ? 'transform 0.5s ease-in-out' : 'none';
            track.style.transform = `translateX(-${i * width()}px)`;
        };
        goTo(index, false);

        const move = (dir) => {
            if (animating) return;
            animating = true;
            goTo(index += dir);
        };

        document.getElementById('offers-prev')?.addEventListener('click', () => move(-1));
        document.getElementById('offers-next')?.addEventListener('click', () => move(1));

        track.addEventListener('transitionend', (e) => {
            if (e.target !== track || e.propertyName !== 'transform') return;
            if (index >= total + clones) goTo(index = clones, false);
            else if (index < clones) goTo(index = total + clones - 1, false);
            animating = false;
        });

        window.addEventListener('resize', () => goTo(index, false));
    });
</script>
@endif
@endsection

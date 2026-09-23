@extends('layouts.app')

@section('title', 'Ofertas - Travel Logic')

@section('content')
<div class="mx-auto w-full max-w-[1600px] px-3 pb-10 sm:px-4 md:px-6 lg:px-8 lg:pb-16 mt-16 sm:mt-20 md:mt-24">
    <x-animate-in>
        <div class="mb-6 sm:mb-8">
            <h1 class="text-3xl font-bold text-indigo-950 sm:text-4xl lg:text-5xl">Ofertas</h1>
            <div class="mt-2 h-1 w-16 rounded-full bg-[#4CAF20]"></div>
        </div>
    </x-animate-in>

    @if ($promotionalOffers->isNotEmpty())
        @if ($promotionalOffers->count() > 4)
            <div class="relative py-2 sm:py-4">
                <div id="offers-viewport" class="overflow-hidden bg-transparent px-1 pt-4 pb-10 sm:px-3 sm:pb-12">
                    <div id="offers-track" class="flex transition-transform duration-500 ease-in-out">
                        @foreach ($promotionalOffers as $offer)
                            <div class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 shrink-0 px-2 sm:px-3 md:px-4">
                                <x-offer-card :offer="$offer" />
                            </div>
                        @endforeach
                    </div>
                </div>

                <button id="offers-prev" type="button" aria-label="Oferta anterior" class="absolute left-1 sm:left-2 md:left-4 top-[calc(50%-1rem)] z-10 flex h-9 w-9 sm:h-10 sm:w-10 -translate-y-1/2 items-center justify-center rounded-full bg-[#EAFFE1] shadow-[2px_8px_28px_0_rgba(0,0,0,0.16)] transition-all duration-200 hover:-translate-y-0.5 hover:bg-[#ddf7d4]">
                    <svg class="h-4 w-4" fill="none" stroke="#4CAF20" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="offers-next" type="button" aria-label="Siguiente oferta" class="absolute right-1 sm:right-2 md:right-4 top-[calc(50%-1rem)] z-10 flex h-9 w-9 sm:h-10 sm:w-10 -translate-y-1/2 items-center justify-center rounded-full bg-[#EAFFE1] shadow-[2px_8px_28px_0_rgba(0,0,0,0.16)] transition-all duration-200 hover:-translate-y-0.5 hover:bg-[#ddf7d4]">
                    <svg class="h-4 w-4" fill="none" stroke="#4CAF20" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        @else
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 py-2 justify-items-center">
                @foreach ($promotionalOffers as $offer)
                    <x-animate-in delay="{{ $loop->index * 80 }}" variant="subtle" class="w-full">
                        <x-offer-card :offer="$offer" />
                    </x-animate-in>
                @endforeach
            </div>
        @endif
    @else
        <div class="flex flex-col items-center justify-center py-20 text-gray-400">
            <x-lucide-tag class="mb-4 h-16 w-16" />
            <p class="text-lg font-medium">No hay ofertas disponibles por el momento.</p>
        </div>
    @endif
</div>

@if ($promotionalOffers->count() > 4)
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const track = document.getElementById('offers-track');
        const viewport = document.getElementById('offers-viewport');
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

        // Soporte táctil / touch swipe en móvil
        let startX = 0;
        let diffX = 0;
        viewport?.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
            diffX = 0;
        }, { passive: true });

        viewport?.addEventListener('touchmove', (e) => {
            diffX = e.touches[0].clientX - startX;
        }, { passive: true });

        viewport?.addEventListener('touchend', () => {
            if (Math.abs(diffX) > 40) {
                move(diffX > 0 ? -1 : 1);
            }
        });
    });
</script>
@endif

@endsection

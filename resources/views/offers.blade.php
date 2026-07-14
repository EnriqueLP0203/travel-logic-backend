@extends('layouts.app')

@section('title', 'Ofertas - Travel Logic')

@section('content')
<div class="mx-auto w-full max-w-[1600px] px-2 pb-10 sm:px-3 md:px-4 lg:px-6 lg:pb-16 mt-24">
    <x-animate-in>
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-indigo-950 sm:text-4xl lg:text-5xl">Ofertas</h1>
            <div class="mt-2 h-1 w-16 rounded-full bg-[#4CAF20]"></div>
        </div>

        {{-- DUMMY: quitar cuando conectemos hoteles reales --}}
        @php
            $dummyOffers = [
                ['name' => 'Hotel Los Cabos', 'location' => 'Los Cabos, México', 'image' => 'https://picsum.photos/seed/loscabos/600/400'],
                ['name' => 'Hotel Cancún', 'location' => 'Cancún, México', 'image' => 'https://picsum.photos/seed/cancun/600/400'],
                ['name' => 'Hotel CDMX', 'location' => 'CDMX, México', 'image' => 'https://picsum.photos/seed/cdmx/600/400'],
                ['name' => 'Hotel Puerto Vallarta', 'location' => 'Puerto Vallarta, México', 'image' => 'https://picsum.photos/seed/pv/600/400'],
                ['name' => 'Hotel Playa del Carmen', 'location' => 'Playa del Carmen, México', 'image' => 'https://picsum.photos/seed/pdc/600/400'],
            ];
        @endphp

        <div class="relative">
            <div id="offers-viewport" class="overflow-hidden">
                <div id="offers-track" class="flex transition-transform duration-500 ease-in-out">
                    @foreach ($dummyOffers as $offer)
                        <div class="shrink-0 w-full px-3 sm:w-1/2 lg:w-1/3 xl:w-1/4">
                            <x-offer-card :name="$offer['name']" :location="$offer['location']" :image="$offer['image']" />
                        </div>
                    @endforeach
                </div>
            </div>

            <button id="offers-prev" type="button" class="absolute left-0 top-1/2 -translate-x-1/2 -translate-y-1/2 z-10 flex h-9 w-9 items-center justify-center rounded-full bg-[#EAFFE1] shadow-[2px_8px_28px_0_rgba(0,0,0,0.16)] hover:bg-[#ddf7d4]">
                <svg class="h-4 w-4" fill="none" stroke="#4CAF20" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" /></svg>
            </button>
            <button id="offers-next" type="button" class="absolute right-0 top-1/2 -translate-x-1/2 -translate-y-1/2 z-10 flex h-9 w-9 items-center justify-center rounded-full bg-[#EAFFE1] shadow-[2px_8px_28px_0_rgba(0,0,0,0.16)] hover:bg-[#ddf7d4]">
                <svg class="h-4 w-4" fill="none" stroke="#4CAF20" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
            </button>
        </div>
    </x-animate-in>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const track = document.getElementById('offers-track');
    const slides = [...track.children];
    const total = slides.length;
    const clones = Math.min(total, 4);
    let index = clones, animating = false;

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

    document.getElementById('offers-next').addEventListener('click', () => move(1));
    document.getElementById('offers-prev').addEventListener('click', () => move(-1));

    track.addEventListener('transitionend', (e) => {
        if (e.target !== track || e.propertyName !== 'transform') return;
        if (index >= total + clones) goTo(index = clones, false);
        else if (index < clones) goTo(index = total + clones - 1, false);
        animating = false;
    });

    window.addEventListener('resize', () => goTo(index, false));
});
</script>
@endsection
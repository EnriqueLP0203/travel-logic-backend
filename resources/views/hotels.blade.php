@extends('layouts.app')

@section('title', 'Hoteles - Travel Logic')

@section('content')
<div class="mx-auto w-full max-w-[1600px] px-3 pb-10 sm:px-4 md:px-6 lg:px-8 lg:pb-16 mt-16 sm:mt-20 md:mt-24">
    {{-- search bar (modal fuera del animate-in para evitar problemas de z-index) --}}
    <x-hotels-search-bar
        :destinations="$destinations"
        :hotel-groups="$hotelGroups"
        :accommodation-types="$accommodationTypes"
    />

    {{-- Grid de hoteles --}}
    @if ($hotels->isNotEmpty())
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 justify-items-center">
            @foreach ($hotels as $hotel)
                <x-animate-in delay="{{ $loop->index * 10 }}" variant="subtle" class="w-full flex justify-center">
                    <x-hotel-card :hotel="$hotel" />
                </x-animate-in>
            @endforeach
        </div>

        <x-animate-in delay="200">
            <x-pagination :paginator="$hotels" />
        </x-animate-in>
    @else
        <x-animate-in>
            <div class="flex flex-col items-center justify-center py-20 text-gray-400">
                <svg class="mb-4 h-16 w-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 9.75L12 3l9 6.75V21a.75.75 0 01-.75.75H3.75A.75.75 0 013 21V9.75z" />
                </svg>
                <p class="text-lg font-medium">No hay hoteles disponibles por el momento.</p>
            </div>
        </x-animate-in>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('title', 'Hoteles - Travel Logic')

@section('content')
<div class="mx-auto w-full max-w-[1600px] px-2 pb-10 sm:px-3 md:px-4 lg:px-6 lg:pb-16">
    {{-- Banner --}}
    <x-animate-in>
        <div class="mb-8 overflow-hidden rounded-lg sm:mb-10 md:mb-12">
            <div class="h-48 w-full bg-gray-300 sm:h-56 md:h-64 lg:h-80"></div>
        </div>
    </x-animate-in>

    {{-- Grid de hoteles --}}
    <x-animate-in>
        @if ($hotels->isNotEmpty())
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($hotels as $hotel)
                    <x-hotel-card :hotel="$hotel" />
                @endforeach
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-20 text-gray-400">
                <svg class="mb-4 h-16 w-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 9.75L12 3l9 6.75V21a.75.75 0 01-.75.75H3.75A.75.75 0 013 21V9.75z" />
                </svg>
                <p class="text-lg font-medium">No hay hoteles disponibles por el momento.</p>
            </div>
        @endif
    </x-animate-in>
</div>
@endsection
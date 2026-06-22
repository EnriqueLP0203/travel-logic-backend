@extends('layouts.app')

@section('title', 'Hoteles - Travel Logic')

@section('content')
<div class="mx-auto w-full max-w-[1600px] px-2 pb-10 sm:px-3 md:px-4 lg:px-6 lg:pb-16">
    {{-- Banner --}}
    <x-animate-in>
        <div class="mb-8 overflow-hidden rounded-lg sm:mb-10 md:mb-12">
            <div class="h-48 w-full bg-gray-300 sm:h-56 md:h-64 lg:h-80"></div>
        </div>

        <div class="grid grid-cols-4">
            <div class="w-full h-md overflow-hidden bg-white shadow-xl transition-all duration-200 hover:scale-102 rounded-lg">
                <div class="w-full h-48 bg-gray-300">
                </div>
                <div class="py-12 px-4">
                    <p class="text-xl font-bold leading-6 text-indigo-950">Hotel 1</p>
                    <p class="text-sm font-normal leading-5 text-indigo-950">0 reseñas</p>
                </div>
            </div>

        </div>
    </x-animate-in>
</div>
@endsection
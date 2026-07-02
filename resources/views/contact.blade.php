@extends('layouts.app')

@section('title', 'Contacto - Travel Logic')

@section('content')
<div class="mx-auto w-full max-w-[1600px] px-2 sm:px-3 md:px-4 lg:px-6">
    <x-animate-in>
        <h1 class="mb-10 text-center text-3xl font-bold text-indigo-950 sm:text-4xl lg:mb-14 lg:text-5xl">
            CONTACTO
        </h1>
    </x-animate-in>

    <x-contact-form />
</div>
@endsection

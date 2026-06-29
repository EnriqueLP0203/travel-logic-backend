@extends('layouts.app')

@section('title', 'Quoter Travel Logic Backend')

@section('content')
`
<div class="mx-auto w-full max-w-[1600px] px-2 pb-10 sm:px-3 md:px-4 lg:px-6 lg:pb-16">
    <x-animate-in delay="100">
        <div>
            <h1 class="mb-4 text-center text-3xl font-bold text-indigo-950 sm:mb-6 sm:text-4xl lg:text-5xl">Quoter Page</h1>
        </div>
    </x-animate-in>

    <x-animate-in delay="200">
        <div class="mt-8 px-10">
            <x-destination-menu />
        </div>
    </x-animate-in>

    <div class="flex justify-center py-24">
        <button type="button" data-modal-target="create-agency" class="bg-green-1 text-white px-4 py-2 rounded-full transition-opacity duration-200 hover:opacity-90">
            <span class="text-white text-lg font-semibold px-2">Registrar Agencia</span>
        </button>
    </div>

    <x-create-agency-modal name="create-agency" />

    <div class="flex justify-center py-24">
        <button type="button" data-modal-target="contact-info" class="bg-green-1 text-white px-4 py-2 rounded-full transition-opacity duration-200 hover:opacity-90">
            <span class="text-white text-lg font-semibold px-2">Informacion de contacto</span>
        </button>
    </div>

    <x-contact-info-modal name="contact-info" />

    <div class="flex justify-center py-24">
        <button type="button" data-modal-target="facturation" class="bg-green-1 text-white px-4 py-2 rounded-full transition-opacity duration-200 hover:opacity-90">
            <span class="text-white text-lg font-semibold px-2">Informacion de facturacion</span>
        </button>
    </div>

    <x-facturation-form-modal name="facturation" />

</div>


@endsection
@extends('layouts.app')

@section('title', 'Contacto - Travel Logic')

@section('content')
<div class="mx-auto w-full max-w-[1600px] px-2 sm:px-3 md:px-4 lg:px-6">
    <div class="grid grid-cols-2 gap-12 py-24">
        <div class="flex w-3xl flex-col items-start text-left">
            <h1 class="mb-10 text-6xl font-black text-indigo-950">
                ¿Listo para hacer crecer tu agencia con nosotros?
            </h1>

            <p class="w-lg text-xl font-light font-inter text-indigo-950">
                Únete a más de 200 agencias que ya disfrutan de tarifas exclusivas y herramientas profesionales bajo el modelo One Stop Shop.
            </p>
            <div class="mt-8 w-lg">
                <form action="#" method="POST" class="flex flex-col gap-4">
                    <div class="flex flex-col gap-2">
                        <label for="name" class="text-sm font-medium font-lato text-indigo-950">Nombre</label>
                        <input type="text" id="name" name="name" class="w-full h-12 rounded-lg border border-indigo-950/20 p-2 text-sm font-light font-lato text-indigo-950" />
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="email" class="text-sm font-medium font-lato text-indigo-950">Nombre</label>
                        <input type="email" id="email" name="email" class="w-full h-12 rounded-lg border border-indigo-950/20 p-2 text-sm font-light font-lato text-indigo-950" />
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="phone" class="text-sm font-medium font-lato text-indigo-950">Nombre</label>
                        <input type="text" id="phone" name="phone" class="w-full h-12 rounded-lg border border-indigo-950/20 p-2 text-sm font-light font-lato text-indigo-950" />
                    </div>
                    <!-- aceptar terminos y condiciones -->
                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="terms" name="terms" class="w-4 h-4" />
                        <label for="terms" class="text-sm font-light font-lato text-indigo-950">Acepto los <a href="#" class="text-sm font-medium font-lato text-indigo-950">términos y condiciones</a></label>
                    </div>
                    <button type="submit" class="w-full h-12 rounded-lg bg-green-300 text-white p-2 text-sm font-medium font-lato">Enviar</button>
                </form>
            </div>
        </div>
        <div class="flex h-full items-center justify-center">
            <img src="{{ asset('images/mapa.png') }}" alt="Contacto" class="w-[720px] h-auto" />
        </div>

    </div>


</div>
@endsection
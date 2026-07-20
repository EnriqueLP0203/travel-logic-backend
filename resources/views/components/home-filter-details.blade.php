{{-- Los 5 bloques comparten la misma celda del grid (col-start-1 row-start-1)
     para que al cambiar de categoria el que sale y el que entra se crucen
     encimados, sin empujarse ni saltar. --}}
<div class="mx-auto grid w-full max-w-[1600px] px-2 sm:px-3 md:px-4 lg:px-6">
    @foreach ($categorias as $clave => $categoria)
        <div
            x-show="activo === '{{ $clave }}'"
            x-transition:enter="transition-opacity ease-out duration-500"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-in duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            x-cloak
            class="col-start-1 row-start-1"
        >
            <h3 class="text-2xl font-black font-montserrat text-indigo-950">
                {{ $categoria['title'] }}
            </h3>
            <div class="mt-2 h-1 w-12 bg-green-300" aria-hidden="true"></div>
            <p class="mt-4 max-w-3xl text-base font-normal font-montserrat text-slate-500">
                {{ $categoria['text'] }}
            </p>
        </div>
    @endforeach
</div>
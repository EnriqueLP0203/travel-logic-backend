<div class="mx-auto w-full max-w-[1600px] px-2 sm:px-3 md:px-4 lg:px-6">
    @foreach ($categorias as $clave => $categoria)
        <div
            x-show="activo === '{{ $clave }}'"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            x-cloak
            class=""
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
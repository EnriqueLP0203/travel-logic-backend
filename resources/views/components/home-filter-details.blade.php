{{-- Contenedor: clip en X (no genera scroll en Y) y columna que puede encogerse --}}
<div class="mx-auto grid w-full max-w-[1600px] grid-cols-[minmax(0,1fr)] overflow-x-clip px-4 sm:px-6 md:px-4 lg:px-6">
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
            class="col-start-1 row-start-1 min-w-0"
        >
            <div class="flex flex-col gap-6 mt-6 sm:mt-8 lg:mt-12 lg:flex-row lg:items-center lg:justify-between lg:gap-12">

                {{-- Texto --}}
                <div class="w-full min-w-0 flex-1 flex flex-col items-center justify-center lg:items-start">
                    <h3 class="w-full text-lg font-black font-montserrat text-indigo-950 text-center sm:text-2xl lg:text-4xl lg:text-left">
                        {{ $categoria['title'] }}
                    </h3>
                    <div class="mt-2 h-1 w-12 bg-green-300 mx-auto lg:mx-0" aria-hidden="true"></div>
                    <p class="mt-3 w-full text-xs font-normal font-montserrat text-slate-700 leading-6 text-center sm:text-sm sm:leading-7 lg:text-base lg:leading-8 lg:text-left">
                        {{ $categoria['text'] }}
                    </p>
                </div>

                {{-- Cards: el wrapper tiene el tamaño VISUAL real + margen para sombras.
                     Mobile/sm: left calculado para centrar el grupo visual (no el bounding box).
                     Desktop: wrapper ampliado para que la sombra no se recorte. --}}
                <div class="flex shrink-0 justify-center lg:block">
                    <div class="relative
                                h-[200px] w-[260px]
                                sm:h-[240px] sm:w-[320px]
                                lg:h-[420px] lg:w-[600px]">
                        <div class="absolute top-0
                                    left-[42px] scale-[0.58] origin-top-left
                                    sm:left-[51px] sm:scale-[0.72]
                                    lg:left-[80px] lg:scale-100">
                            <x-stacked-cards :items="$categoria['cards']" />
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endforeach
</div>

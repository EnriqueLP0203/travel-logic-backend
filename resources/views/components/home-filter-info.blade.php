<div class="flex w-full flex-col rounded-xl border border-green-300 bg-white p-6 shadow-xl">
        <!-- botones filtros de informacion -->
        <div class="flex items-center gap-8 overflow-x-auto pb-1 [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
            <a x-on:click="activo = (activo === 'todo-incluido' ? null : 'todo-incluido')"
                :class="activo === 'hoteles' ? 'text-green-400' : 'text-slate-700'"
                class="shrink-0 cursor-pointer whitespace-nowrap text-md font-bold font-montserrat transition-colors duration-200 hover:text-green-400">
                Todo incluido
            </a>
            <a x-on:click="activo = (activo === 'plan-europeo' ? null : 'plan-europeo')"
                :class="activo === 'vuelos' ? 'text-green-400' : 'text-slate-700'"
                class="shrink-0 cursor-pointer whitespace-nowrap text-md font-bold font-montserrat transition-colors duration-200 hover:text-green-400">
                Plan Europeo
            </a>
            <a x-on:click="activo = (activo === 'glamping' ? null : 'glamping')"
                :class="activo === 'paquetes' ? 'text-green-400' : 'text-slate-700'"
                class="shrink-0 cursor-pointer whitespace-nowrap text-md font-bold font-montserrat transition-colors duration-200 hover:text-green-400">
                Glamping
            </a>
            <a x-on:click="activo = (activo === 'cruceros' ? null : 'cruceros')"
                :class="activo === 'tours' ? 'text-green-400' : 'text-slate-700'"
                class="shrink-0 cursor-pointer whitespace-nowrap text-md font-bold font-montserrat transition-colors duration-200 hover:text-green-400">
                Cruceros
            </a>
            <a x-on:click="activo = (activo === 'long-stay' ? null : 'long-stay')"
                :class="activo === 'bodas' ? 'text-green-400' : 'text-slate-700'"
                class="shrink-0 cursor-pointer whitespace-nowrap text-md font-bold font-montserrat transition-colors duration-200 hover:text-green-400">
                Long Stay
            </a>
        </div>
        {{-- Sección representativa de búsqueda (sin funcionalidad) --}}
        <div class="mt-6 flex w-full flex-col gap-4 lg:flex-row lg:items-end lg:gap-4">
            <div class="flex min-w-0 flex-1 flex-col gap-1.5">
                <label for="filtro-destino" class="text-sm font-bold font-montserrat text-slate-500">Destinos</label>
                <select
                    id="filtro-destino"
                    class="w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm font-montserrat text-slate-700"
                >
                    <option value="" selected disabled>Selecciona un destino</option>
                    <option value="cancun">Cancún</option>
                    <option value="merida">Mérida</option>
                    <option value="playa-del-carmen">Playa del Carmen</option>
                    <option value="tulum">Tulum</option>
                </select>
            </div>

            <div class="flex min-w-0 flex-1 flex-col gap-1.5">
                <label for="filtro-checkin" class="text-sm font-bold font-montserrat text-slate-500">Check-in</label>
                <input
                    type="date"
                    id="filtro-checkin"
                    class="w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm font-montserrat text-slate-700"
                />
            </div>

            <div class="flex min-w-0 flex-1 flex-col gap-1.5">
                <label for="filtro-checkout" class="text-sm font-bold font-montserrat text-slate-500">Check-out</label>
                <input
                    type="date"
                    id="filtro-checkout"
                    class="w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm font-montserrat text-slate-700"
                />
            </div>

            <div class="flex min-w-0 flex-1 flex-col gap-1.5">
                <label for="filtro-huespedes" class="text-sm font-bold font-montserrat text-slate-500">Huéspedes</label>
                <select
                    id="filtro-huespedes"
                    class="w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm font-montserrat text-slate-700"
                >
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" @selected($i === 1)>{{ $i }}</option>
                    @endfor
                    <option value="10+">10+</option>
                </select>
            </div>

            <button
                type="button"
                x-on:click="activo = activo ? null : 'todo-incluido'"
                x-text="activo ? 'Ocultar' : 'Ver más'"
                class="w-full shrink-0 rounded-lg bg-green-300 px-8 py-2.5 text-sm font-bold font-montserrat text-white transition-all duration-200 hover:-translate-y-0.5 hover:opacity-90 hover:shadow-md lg:w-auto"
            >
                Ver más
            </button>
        </div>
</div>
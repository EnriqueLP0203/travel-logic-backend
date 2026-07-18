<div class="flex w-full flex-col rounded-xl border border-green-300 bg-white p-6 shadow-xl">
        <!-- botones filtros de informacion -->
        <div class="flex items-center gap-12">
            <a x-on:click="activo = (activo === 'hoteles' ? null : 'hoteles')"
                :class="activo === 'hoteles' ? 'text-green-400' : 'text-slate-500'"
                class="cursor-pointer text-sm font-bold font-montserrat hover:text-green-400 transition-colors">
                🏨 Hoteles
            </a>
            <a x-on:click="activo = (activo === 'vuelos' ? null : 'vuelos')"
                :class="activo === 'vuelos' ? 'text-green-400' : 'text-slate-500'"
                class="cursor-pointer text-sm font-bold font-montserrat hover:text-green-400 transition-colors">
                ✈️ Vuelos
            </a>
            <a x-on:click="activo = (activo === 'paquetes' ? null : 'paquetes')"
                :class="activo === 'paquetes' ? 'text-green-400' : 'text-slate-500'"
                class="cursor-pointer text-sm font-bold font-montserrat hover:text-green-400 transition-colors">
                🎒 Paquetes
            </a>
            <a x-on:click="activo = (activo === 'tours' ? null : 'tours')"
                :class="activo === 'tours' ? 'text-green-400' : 'text-slate-500'"
                class="cursor-pointer text-sm font-bold font-montserrat hover:text-green-400 transition-colors">
                🎯 Tours
            </a>
            <a x-on:click="activo = (activo === 'bodas' ? null : 'bodas')"
                :class="activo === 'bodas' ? 'text-green-400' : 'text-slate-500'"
                class="cursor-pointer text-sm font-bold font-montserrat hover:text-green-400 transition-colors">
                💍 Grupos & Bodas
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
                class="w-full shrink-0 rounded-lg bg-green-300 px-8 py-2.5 text-sm font-bold font-montserrat text-white transition-opacity hover:opacity-90 lg:w-auto"
            >
                Ver más
            </button>
        </div>
</div>
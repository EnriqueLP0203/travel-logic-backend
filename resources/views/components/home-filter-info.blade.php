@props([
    'destinations' => collect(),
])

<div class="flex w-full flex-col rounded-xl border border-green-300 bg-white p-6 shadow-xl">
    <!-- botones filtros de informacion -->
    <div class="flex items-center gap-8 overflow-x-auto pb-1 [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
        <button
            type="button"
            x-on:click="activo = (activo === 'todo-incluido' ? null : 'todo-incluido')"
            :class="activo === 'todo-incluido' ? 'text-green-400' : 'text-slate-700'"
            class="shrink-0 cursor-pointer whitespace-nowrap text-md font-bold font-montserrat transition-colors duration-200 hover:text-green-400">
            Todo incluido
        </button>
        <button
            type="button"
            x-on:click="activo = (activo === 'plan-europeo' ? null : 'plan-europeo')"
            :class="activo === 'plan-europeo' ? 'text-green-400' : 'text-slate-700'"
            class="shrink-0 cursor-pointer whitespace-nowrap text-md font-bold font-montserrat transition-colors duration-200 hover:text-green-400">
            Plan Europeo
        </button>
        <button
            type="button"
            x-on:click="activo = (activo === 'glamping' ? null : 'glamping')"
            :class="activo === 'glamping' ? 'text-green-400' : 'text-slate-700'"
            class="shrink-0 cursor-pointer whitespace-nowrap text-md font-bold font-montserrat transition-colors duration-200 hover:text-green-400">
            Glamping
        </button>
        <button
            type="button"
            x-on:click="activo = (activo === 'cruceros' ? null : 'cruceros')"
            :class="activo === 'cruceros' ? 'text-green-400' : 'text-slate-700'"
            class="shrink-0 cursor-pointer whitespace-nowrap text-md font-bold font-montserrat transition-colors duration-200 hover:text-green-400">
            Cruceros
        </button>
        <button
            type="button"
            x-on:click="activo = (activo === 'long-stay' ? null : 'long-stay')"
            :class="activo === 'long-stay' ? 'text-green-400' : 'text-slate-700'"
            class="shrink-0 cursor-pointer whitespace-nowrap text-md font-bold font-montserrat transition-colors duration-200 hover:text-green-400">
            Long Stay
        </button>
    </div>

    {{-- Formulario de búsqueda rápida a hospedajes --}}
    <form
        x-data="{
            destino: '',
            checkin: '',
            checkout: '',
            huespedes: '',
            get formValido() {
                return Boolean(this.destino && this.checkin && this.checkout && this.huespedes);
            },
            submit() {
                if (this.formValido) {
                    window.location.href = '{{ route('hotels') }}';
                }
            }
        }"
        x-on:submit.prevent="submit"
        class="mt-6 flex w-full flex-col gap-4 lg:flex-row lg:items-end lg:gap-4"
    >
        <div class="flex min-w-0 flex-1 flex-col gap-1.5">
            <label for="filtro-destino" class="text-sm font-bold font-montserrat text-slate-500">Destinos</label>
            <select
                id="filtro-destino"
                x-model="destino"
                class="w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm font-montserrat text-slate-700 focus:border-green-300 focus:outline-none focus:ring-1 focus:ring-green-300"
            >
                <option value="" selected disabled>Selecciona un destino</option>
                @if (isset($destinations) && count($destinations) > 0)
                    @foreach ($destinations as $destination)
                        <option value="{{ $destination->id }}">{{ $destination->city }}</option>
                    @endforeach
                @else
                    <option value="cancun">Cancún</option>
                    <option value="merida">Mérida</option>
                    <option value="playa-del-carmen">Playa del Carmen</option>
                    <option value="tulum">Tulum</option>
                @endif
            </select>
        </div>

        <div class="flex min-w-0 flex-1 flex-col gap-1.5">
            <label for="filtro-checkin" class="text-sm font-bold font-montserrat text-slate-500">Check-in</label>
            <input
                type="date"
                id="filtro-checkin"
                x-model="checkin"
                x-on:change="if (checkout && checkout < checkin) checkout = ''"
                class="w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm font-montserrat text-slate-700 focus:border-green-300 focus:outline-none focus:ring-1 focus:ring-green-300"
            />
        </div>

        <div class="flex min-w-0 flex-1 flex-col gap-1.5">
            <label for="filtro-checkout" class="text-sm font-bold font-montserrat text-slate-500">Check-out</label>
            <input
                type="date"
                id="filtro-checkout"
                x-model="checkout"
                :min="checkin"
                class="w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm font-montserrat text-slate-700 focus:border-green-300 focus:outline-none focus:ring-1 focus:ring-green-300"
            />
        </div>

        <div class="flex min-w-0 flex-1 flex-col gap-1.5">
            <label for="filtro-huespedes" class="text-sm font-bold font-montserrat text-slate-500">Huéspedes</label>
            <select
                id="filtro-huespedes"
                x-model="huespedes"
                class="w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm font-montserrat text-slate-700 focus:border-green-300 focus:outline-none focus:ring-1 focus:ring-green-300"
            >
                <option value="" selected disabled>Selecciona huéspedes</option>
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
                <option value="10+">10+</option>
            </select>
        </div>

        <button
            type="submit"
            :disabled="!formValido"
            :class="formValido
                ? 'bg-green-300 text-white cursor-pointer hover:-translate-y-0.5 hover:opacity-90 hover:shadow-md'
                : 'bg-gray-300 text-gray-500 cursor-not-allowed opacity-60 shadow-none hover:translate-y-0'"
            class="w-full shrink-0 rounded-lg px-8 py-2.5 text-sm font-bold font-montserrat transition-all duration-200 lg:w-auto"
        >
            Ver más
        </button>
    </form>
</div>
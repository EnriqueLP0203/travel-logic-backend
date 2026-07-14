@props([
    'name' => 'destination-create',
])

<div
    data-modal="{{ $name }}"
    role="dialog"
    aria-modal="true"
    aria-labelledby="{{ $name }}-title"
    class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    {{-- Overlay --}}
    <div data-modal-close class="absolute inset-0 bg-slate-900/50"></div>

    {{-- Contenedor del modal --}}
    <div class="relative z-10 flex w-full max-w-3xl flex-col rounded-lg bg-white shadow-xl">
        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
            <h2 id="{{ $name }}-title" class="text-base font-semibold text-slate-800">
                Nuevo destino
            </h2>

            <button
                type="button"
                data-modal-close
                aria-label="Cerrar"
                class="flex h-8 w-8 items-center justify-center rounded-md text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                <x-lucide-x class="size-5" />
            </button>
        </div>

        <form action="#" method="POST" enctype="multipart/form-data" class="flex flex-col">
            @csrf

            <div class="grid grid-cols-1 gap-8 px-6 py-6 md:grid-cols-2">
                {{-- Columna izquierda: datos --}}
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col gap-1.5">
                        <label for="{{ $name }}-city" class="text-sm font-medium text-slate-700">
                            Ciudad (Destino)
                        </label>
                        <input
                            id="{{ $name }}-city"
                            type="text"
                            name="city"
                            required
                            placeholder="Ej. Cancún"
                            class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm text-slate-800 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    </div>

                    @php
                        $estadosMexico = [
                            'Aguascalientes',
                            'Baja California',
                            'Baja California Sur',
                            'Campeche',
                            'Chiapas',
                            'Chihuahua',
                            'Ciudad de México',
                            'Coahuila',
                            'Colima',
                            'Durango',
                            'Estado de México',
                            'Guanajuato',
                            'Guerrero',
                            'Hidalgo',
                            'Jalisco',
                            'Michoacán',
                            'Morelos',
                            'Nayarit',
                            'Nuevo León',
                            'Oaxaca',
                            'Puebla',
                            'Querétaro',
                            'Quintana Roo',
                            'San Luis Potosí',
                            'Sinaloa',
                            'Sonora',
                            'Tabasco',
                            'Tamaulipas',
                            'Tlaxcala',
                            'Veracruz',
                            'Yucatán',
                            'Zacatecas',
                        ];
                    @endphp

                    <div class="flex flex-col gap-1.5">
                        <label for="{{ $name }}-country" class="text-sm font-medium text-slate-700">
                            País
                        </label>
                        <select
                            id="{{ $name }}-country"
                            name="country"
                            required
                            class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-800 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <option value="México" selected>México</option>
                        </select>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="{{ $name }}-state" class="text-sm font-medium text-slate-700">
                            Estado
                        </label>
                        <select
                            id="{{ $name }}-state"
                            name="state"
                            required
                            class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-800 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <option value="" disabled selected>Selecciona un estado</option>
                            @foreach ($estadosMexico as $estado)
                                <option value="{{ $estado }}">{{ $estado }}</option>
                            @endforeach
                        </select>
                    </div>

                    <label class="mt-1 flex cursor-pointer items-center gap-2">
                        <input
                            type="checkbox"
                            name="active"
                            value="1"
                            checked
                            class="size-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span class="text-sm text-slate-700">Activo</span>
                    </label>
                </div>

                {{-- Columna derecha: imagen --}}
                <div class="flex flex-col gap-1.5">
                    <label for="{{ $name }}-image" class="text-sm font-medium text-slate-700">
                        Imagen
                    </label>

                    <label
                        for="{{ $name }}-image"
                        class="group relative flex min-h-56 flex-1 cursor-pointer flex-col items-center justify-center gap-3 overflow-hidden rounded-lg border-2 border-slate-300 bg-slate-50 px-4 py-6 text-center transition hover:border-blue-400 hover:bg-blue-50/40">
                        <input
                            id="{{ $name }}-image"
                            type="file"
                            name="image"
                            accept="image/jpeg,image/png,image/webp"
                            class="sr-only"
                            onchange="
                                const preview = this.closest('label').querySelector('[data-image-preview]');
                                const placeholder = this.closest('label').querySelector('[data-image-placeholder]');
                                const fileName = this.closest('label').querySelector('[data-image-name]');
                                const file = this.files?.[0];
                                if (!file) return;
                                preview.src = URL.createObjectURL(file);
                                preview.classList.remove('hidden');
                                placeholder.classList.add('hidden');
                                fileName.textContent = file.name;
                            ">

                        <img
                            data-image-preview
                            alt="Vista previa"
                            class="absolute inset-0 hidden h-full w-full object-cover">

                        <div data-image-placeholder class="flex flex-col items-center gap-3">
                            <span class="flex h-12 w-12 items-center justify-center rounded-full bg-white text-slate-400 shadow-sm ring-1 ring-slate-200 group-hover:text-blue-500">
                                <x-lucide-image-plus class="size-6" />
                            </span>
                            <div>
                                <p class="text-sm font-medium text-slate-700">
                                    Subir imagen
                                </p>
                                <p class="mt-1 text-xs text-slate-500">
                                    JPG, PNG o WEBP
                                </p>
                            </div>
                        </div>

                        <span
                            data-image-name
                            class="pointer-events-none absolute bottom-0 left-0 right-0 truncate bg-slate-900/70 px-3 py-1.5 text-xs text-white empty:hidden">
                        </span>
                    </label>
                </div>
            </div>

            {{-- Footer --}}
            <div class="flex items-center justify-end gap-3 border-t border-slate-200 px-6 py-4">
                <button
                    type="button"
                    data-modal-close
                    class="rounded-md border border-slate-300 px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                    Cancelar
                </button>
                <button
                    type="submit"
                    class="rounded-md bg-green-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-green-700">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>

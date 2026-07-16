@props([
    'name' => 'accommodation-type-create',
])

<div
    data-modal="{{ $name }}"
    role="dialog"
    aria-modal="true"
    aria-labelledby="{{ $name }}-title"
    @if ($errors->any() && old('_method') !== 'PUT') data-open-on-load @endif
    class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    {{-- Overlay --}}
    <div data-modal-close class="absolute inset-0 bg-slate-900/50"></div>

    {{-- Contenedor del modal --}}
    <div class="relative z-10 flex w-full max-w-lg flex-col rounded-lg bg-white shadow-xl">
        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
            <h2 id="{{ $name }}-title" class="text-base font-semibold text-slate-800">
                Nuevo tipo de alojamiento
            </h2>

            <button
                type="button"
                data-modal-close
                aria-label="Cerrar"
                class="flex h-8 w-8 items-center justify-center rounded-md text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                <x-lucide-x class="size-5" />
            </button>
        </div>

        <form method="POST" action="#" class="flex flex-col">
            @csrf

            {{-- Cuerpo --}}
            <div class="flex flex-col gap-4 px-6 py-6">
                <div class="flex flex-col gap-1.5">
                    <label for="{{ $name }}-name" class="text-sm font-medium text-slate-700">
                        Nombre
                    </label>
                    <input
                        id="{{ $name }}-name"
                        type="text"
                        name="name"
                        required
                        value="{{ old('name') }}"
                        placeholder="Ej. Todo Incluido"
                        class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm text-slate-800 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 @error('name') border-red-400 @enderror">
                    @error('name')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="{{ $name }}-icon" class="text-sm font-medium text-slate-700">
                        Icono
                    </label>
                    <input
                        id="{{ $name }}-icon"
                        type="text"
                        name="icon_class"
                        value="{{ old('icon_class') }}"
                        placeholder="Ej. lucide-bed-double"
                        class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm text-slate-800 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 @error('icon_class') border-red-400 @enderror">
                    @error('icon_class')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="{{ $name }}-active" class="text-sm font-medium text-slate-700">
                        Estado
                    </label>
                    <select
                        id="{{ $name }}-active"
                        name="active"
                        class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-800 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 @error('active') border-red-400 @enderror">
                        <option value="1" @selected(old('active', '1') == '1')>Activo</option>
                        <option value="0" @selected(old('active') == '0')>Inactivo</option>
                    </select>
                    @error('active')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
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

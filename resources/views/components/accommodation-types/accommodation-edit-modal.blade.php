@props([
    'name' => 'accommodation-type-edit',
])

@php
    $isEditError = $errors->any() && old('_method') === 'PUT';
    $editId = old('accommodation_type_id');
@endphp

<div
    data-modal="{{ $name }}"
    role="dialog"
    aria-modal="true"
    aria-labelledby="{{ $name }}-title"
    @if ($isEditError) data-open-on-load @endif
    class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <div data-modal-close class="absolute inset-0 bg-slate-900/50"></div>

    <div class="relative z-10 flex w-full max-w-4xl flex-col rounded-lg bg-white shadow-xl">
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
            <h2 id="{{ $name }}-title" class="text-base font-semibold text-slate-800">
                Editar tipo de alojamiento
            </h2>
            <button
                type="button"
                data-modal-close
                aria-label="Cerrar"
                class="flex h-8 w-8 items-center justify-center rounded-md text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                <x-lucide-x class="size-5" />
            </button>
        </div>

        <form
            data-edit-form
            method="POST"
            action="{{ $editId ? route('admin.accommodation-types.update', $editId) : '#' }}"
            class="flex flex-col"
            data-icon-picker-root
            data-icon-catalog-url="{{ route('admin.icons.catalog') }}"
            data-icon-preview-url="{{ route('admin.icons.preview') }}"
            data-icon-previews-url="{{ route('admin.icons.previews') }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="accommodation_type_id" data-edit-id value="{{ $editId }}">

            <div class="grid grid-cols-1 gap-8 px-6 py-6 md:grid-cols-2">
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col gap-1.5">
                        <label for="{{ $name }}-name" class="text-sm font-medium text-slate-700">
                            Nombre
                        </label>
                        <input
                            id="{{ $name }}-name"
                            type="text"
                            name="name"
                            data-edit-name
                            required
                            value="{{ old('name') }}"
                            placeholder="Ej. Todo Incluido"
                            class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm text-slate-800 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 @error('name') border-red-400 @enderror">
                        @error('name')
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
                            data-edit-active
                            class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-800 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 @error('active') border-red-400 @enderror">
                            <option value="1" @selected(old('active', '1') == '1' || old('active') === true || old('active') === 1)>Activo</option>
                            <option value="0" @selected(old('active') === '0' || old('active') === false || old('active') === 0)>Inactivo</option>
                        </select>
                        @error('active')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="{{ $name }}-icon" class="text-sm font-medium text-slate-700">
                        Icono
                    </label>

                    <div class="flex items-center gap-2">
                        <div
                            data-icon-preview
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-md border border-slate-300 bg-slate-50 text-slate-700">
                            <x-lucide-image class="size-5 text-slate-300" />
                        </div>

                        <input
                            id="{{ $name }}-icon"
                            type="text"
                            name="icon_class"
                            data-icon-input
                            data-edit-icon
                            value="{{ old('icon_class') }}"
                            placeholder="Ej. bed-double"
                            autocomplete="off"
                            class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm text-slate-800 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 @error('icon_class') border-red-400 @enderror">

                        <button
                            type="button"
                            data-icon-picker-open
                            class="shrink-0 rounded-md border border-slate-300 px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                            Buscar
                        </button>
                    </div>

                    <p data-icon-status class="text-xs text-slate-500">
                        Escribe el nombre Lucide o busca en el catálogo.
                        <a href="https://lucide.dev/icons" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline">lucide.dev/icons</a>
                    </p>

                    @error('icon_class')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror

                    <div data-icon-picker-panel class="mt-2 hidden rounded-md border border-slate-200 bg-slate-50 p-3">
                        <div class="mb-3 flex items-center gap-2">
                            <input
                                type="search"
                                data-icon-picker-filter
                                placeholder="Filtrar iconos…"
                                class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-800 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <button
                                type="button"
                                data-icon-picker-close
                                class="shrink-0 rounded-md px-2 py-2 text-sm text-slate-500 hover:bg-slate-200 hover:text-slate-700">
                                Cerrar
                            </button>
                        </div>
                        <div
                            data-icon-picker-grid
                            class="grid max-h-72 grid-cols-4 gap-1 overflow-y-auto sm:grid-cols-5">
                            <p class="col-span-full py-6 text-center text-xs text-slate-400" data-icon-picker-loading>
                                Cargando catálogo…
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-slate-200 px-6 py-4">
                <button
                    type="button"
                    data-modal-close
                    class="rounded-md border border-slate-300 px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                    Cancelar
                </button>
                <button
                    type="submit"
                    class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-700">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</div>

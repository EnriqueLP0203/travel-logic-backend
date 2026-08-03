@props([
    'name' => 'offer-create',
])

<div
    data-modal="{{ $name }}"
    role="dialog"
    aria-modal="true"
    aria-labelledby="{{ $name }}-title"
    @if ($errors->any() && old('_method') !== 'PUT') data-open-on-load @endif
    class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <div data-modal-close class="absolute inset-0 bg-slate-900/50"></div>

    <div class="relative z-10 flex w-full max-w-3xl flex-col rounded-lg bg-white shadow-xl">
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
            <h2 id="{{ $name }}-title" class="text-base font-semibold text-slate-800">
                Nueva oferta
            </h2>

            <button
                type="button"
                data-modal-close
                aria-label="Cerrar"
                class="flex h-8 w-8 items-center justify-center rounded-md text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                <x-lucide-x class="size-5" />
            </button>
        </div>

        <form action="{{ route('admin.offers.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col">
            @csrf

            <div class="grid grid-cols-1 gap-8 px-6 py-6 md:grid-cols-2">
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col gap-1.5">
                        <label for="{{ $name }}-name" class="text-sm font-medium text-slate-700">
                            Nombre de la oferta
                        </label>
                        <input
                            id="{{ $name }}-name"
                            type="text"
                            name="name"
                            required
                            value="{{ old('name') }}"
                            placeholder="Ej. Verano en Cancún"
                            class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm text-slate-800 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 @error('name') border-red-400 @enderror">
                        @error('name')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="{{ $name }}-link" class="text-sm font-medium text-slate-700">
                            Enlace (opcional)
                        </label>
                        <input
                            id="{{ $name }}-link"
                            type="url"
                            name="link"
                            value="{{ old('link') }}"
                            placeholder="https://ejemplo.com/promo"
                            class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm text-slate-800 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 @error('link') border-red-400 @enderror">
                        @error('link')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="{{ $name }}-sort-order" class="text-sm font-medium text-slate-700">
                            Orden de aparición
                        </label>
                        <input
                            id="{{ $name }}-sort-order"
                            type="number"
                            name="sort_order"
                            min="0"
                            value="{{ old('sort_order', 0) }}"
                            class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm text-slate-800 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 @error('sort_order') border-red-400 @enderror">
                        @error('sort_order')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <label class="mt-1 flex cursor-pointer items-center gap-2">
                        <input
                            type="checkbox"
                            name="active"
                            value="1"
                            @checked(old('active', true))
                            class="size-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span class="text-sm text-slate-700">Activo</span>
                    </label>
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="{{ $name }}-image" class="text-sm font-medium text-slate-700">
                        Imagen del banner
                    </label>

                    <p class="text-xs text-amber-700 bg-amber-50 border border-amber-200 rounded-md px-3 py-2">
                        Usa una imagen de alta resolución (recomendado 1920px o más de ancho) para que el banner se vea nítido en pantallas grandes.
                    </p>

                    <label
                        for="{{ $name }}-image"
                        class="group relative flex min-h-56 flex-1 cursor-pointer flex-col items-center justify-center gap-3 overflow-hidden rounded-lg border-2 border-dashed border-slate-300 bg-slate-50 px-4 py-6 text-center transition hover:border-blue-400 hover:bg-blue-50/40 @error('image') border-red-400 @enderror">
                        <input
                            id="{{ $name }}-image"
                            type="file"
                            name="image"
                            accept="image/jpeg,image/png,image/webp"
                            required
                            data-image-input
                            class="sr-only">

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
                                    JPG, PNG o WEBP (máx. 10 MB)
                                </p>
                            </div>
                        </div>

                        <span
                            data-image-name
                            class="pointer-events-none absolute bottom-0 left-0 right-0 truncate bg-slate-900/70 px-3 py-1.5 text-xs text-white empty:hidden">
                        </span>
                    </label>
                    @error('image')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
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
                    class="rounded-md bg-green-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-green-700">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>

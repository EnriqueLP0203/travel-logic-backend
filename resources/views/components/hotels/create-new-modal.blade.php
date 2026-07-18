@props([
    'name' => 'hotel-create',
    'destinations' => collect(),
    'hotelGroups' => collect(),
    'accommodationTypes' => collect(),
])

<div
    data-modal="{{ $name }}"
    role="dialog"
    aria-modal="true"
    aria-labelledby="{{ $name }}-title"
    @if ($errors->any() && old('_method') !== 'PUT') data-open-on-load @endif
    class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <div data-modal-close class="absolute inset-0 bg-slate-900/50"></div>

    <div class="relative z-10 flex max-h-[90vh] w-full max-w-5xl flex-col rounded-lg bg-white shadow-xl">
        <div class="flex shrink-0 items-center justify-between border-b border-slate-200 px-6 py-4">
            <h2 id="{{ $name }}-title" class="text-base font-semibold text-slate-800">
                Nuevo hotel
            </h2>
            <button type="button" data-modal-close aria-label="Cerrar"
                class="flex h-8 w-8 items-center justify-center rounded-md text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                <x-lucide-x class="size-5" />
            </button>
        </div>

        <form method="POST" action="{{ route('admin.hotels.store') }}" enctype="multipart/form-data"
            class="flex min-h-0 flex-1 flex-col">
            @csrf

            <div class="flex-1 space-y-8 overflow-y-auto px-6 py-6">
                {{-- Datos --}}
                <section>
                    <h3 class="mb-3 text-sm font-semibold text-slate-800">Datos generales</h3>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="flex flex-col gap-1.5 md:col-span-2">
                            <label for="{{ $name }}-name" class="text-sm font-medium text-slate-700">Nombre</label>
                            <input id="{{ $name }}-name" type="text" name="name" required value="{{ old('name') }}"
                                placeholder="Ej. Hyatt Ziva Cancún"
                                class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 @error('name') border-red-400 @enderror">
                            @error('name')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="{{ $name }}-destination" class="text-sm font-medium text-slate-700">Destino</label>
                            <select id="{{ $name }}-destination" name="destination_id"
                                class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 @error('destination_id') border-red-400 @enderror">
                                <option value="" @selected(! old('destination_id'))>Selecciona un destino</option>
                                @foreach ($destinations as $destination)
                                    <option value="{{ $destination->id }}" @selected(old('destination_id') == $destination->id)>
                                        {{ $destination->city }}
                                    </option>
                                @endforeach
                            </select>
                            @error('destination_id')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="{{ $name }}-stars" class="text-sm font-medium text-slate-700">Estrellas</label>
                            <select id="{{ $name }}-stars" name="star_category"
                                class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" @selected(old('star_category', 3) == $i)>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="{{ $name }}-price" class="text-sm font-medium text-slate-700">Rango de precio</label>
                            <input id="{{ $name }}-price" type="text" name="price_range" value="{{ old('price_range') }}"
                                placeholder="Ej. $$$"
                                class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="{{ $name }}-rating" class="text-sm font-medium text-slate-700">Calificación</label>
                            <input id="{{ $name }}-rating" type="number" name="star_rating" step="0.1" min="0" max="9.9"
                                value="{{ old('star_rating', '0.0') }}"
                                class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>
                    </div>
                </section>

                {{-- Ubicación --}}
                <section>
                    <h3 class="mb-3 text-sm font-semibold text-slate-800">Ubicación</h3>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="flex flex-col gap-1.5 md:col-span-2">
                            <label for="{{ $name }}-address" class="text-sm font-medium text-slate-700">Dirección</label>
                            <input id="{{ $name }}-address" type="text" name="address" value="{{ old('address') }}"
                                class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 @error('address') border-red-400 @enderror">
                            @error('address')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label for="{{ $name }}-postal" class="text-sm font-medium text-slate-700">Código postal</label>
                            <input id="{{ $name }}-postal" type="text" name="postal_code" value="{{ old('postal_code') }}"
                                class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 @error('postal_code') border-red-400 @enderror">
                            @error('postal_code')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label for="{{ $name }}-lat" class="text-sm font-medium text-slate-700">Latitud</label>
                            <input id="{{ $name }}-lat" type="number" name="latitude" step="any" value="{{ old('latitude') }}"
                                class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 @error('latitude') border-red-400 @enderror">
                            @error('latitude')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label for="{{ $name }}-lng" class="text-sm font-medium text-slate-700">Longitud</label>
                            <input id="{{ $name }}-lng" type="number" name="longitude" step="any" value="{{ old('longitude') }}"
                                class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 @error('longitude') border-red-400 @enderror">
                            @error('longitude')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </section>

                {{-- Contacto --}}
                <section>
                    <h3 class="mb-3 text-sm font-semibold text-slate-800">Contacto</h3>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div class="flex flex-col gap-1.5">
                            <label for="{{ $name }}-phone" class="text-sm font-medium text-slate-700">Teléfono</label>
                            <input id="{{ $name }}-phone" type="text" name="phone" value="{{ old('phone') }}"
                                class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label for="{{ $name }}-email" class="text-sm font-medium text-slate-700">Email</label>
                            <input id="{{ $name }}-email" type="email" name="email" value="{{ old('email') }}"
                                class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label for="{{ $name }}-website" class="text-sm font-medium text-slate-700">Sitio web</label>
                            <input id="{{ $name }}-website" type="text" name="website" value="{{ old('website') }}"
                                class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        </div>
                    </div>
                </section>

                {{-- Publicación --}}
                <section>
                    <h3 class="mb-3 text-sm font-semibold text-slate-800">Publicación</h3>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div class="flex flex-col gap-1.5">
                            <label for="{{ $name }}-active" class="text-sm font-medium text-slate-700">Estado</label>
                            <select id="{{ $name }}-active" name="active"
                                class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
                                <option value="1" @selected(old('active', '1') == '1')>Activo</option>
                                <option value="0" @selected(old('active') === '0')>Inactivo</option>
                            </select>
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label for="{{ $name }}-published" class="text-sm font-medium text-slate-700">Publicado</label>
                            <select id="{{ $name }}-published" name="is_published"
                                class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
                                <option value="0" @selected(old('is_published', '0') == '0')>No</option>
                                <option value="1" @selected(old('is_published') == '1')>Sí</option>
                            </select>
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label for="{{ $name }}-featured" class="text-sm font-medium text-slate-700">Destacado</label>
                            <select id="{{ $name }}-featured" name="featured"
                                class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
                                <option value="0" @selected(old('featured', '0') == '0')>No</option>
                                <option value="1" @selected(old('featured') == '1')>Sí</option>
                            </select>
                        </div>
                    </div>
                </section>

                {{-- Relaciones --}}
                <section>
                    <h3 class="mb-3 text-sm font-semibold text-slate-800">Grupos y tipos</h3>
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <p class="mb-2 text-sm font-medium text-slate-700">Grupos de hotel</p>
                            <div class="max-h-40 space-y-2 overflow-y-auto rounded-md border border-slate-200 p-3">
                                @forelse ($hotelGroups as $group)
                                    @php $gName = $group->translations->first()?->name ?? "#{$group->id}"; @endphp
                                    <label class="flex items-center gap-2 text-sm text-slate-700">
                                        <input type="checkbox" name="hotel_group_ids[]" value="{{ $group->id }}"
                                            @checked(collect(old('hotel_group_ids', []))->contains($group->id))
                                            class="size-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                                        {{ $gName }}
                                    </label>
                                @empty
                                    <p class="text-xs text-slate-400">No hay grupos activos.</p>
                                @endforelse
                            </div>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-slate-700">Tipos de alojamiento</p>
                            <div class="max-h-40 space-y-2 overflow-y-auto rounded-md border border-slate-200 p-3">
                                @forelse ($accommodationTypes as $type)
                                    @php $tName = $type->translations->first()?->name ?? "#{$type->id}"; @endphp
                                    <label class="flex items-center gap-2 text-sm text-slate-700">
                                        <input type="checkbox" name="accommodation_type_ids[]" value="{{ $type->id }}"
                                            @checked(collect(old('accommodation_type_ids', []))->contains($type->id))
                                            class="size-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                                        {{ $tName }}
                                    </label>
                                @empty
                                    <p class="text-xs text-slate-400">No hay tipos activos.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Descripción --}}
                <section>
                    <h3 class="mb-3 text-sm font-semibold text-slate-800">Descripción (es-MX)</h3>
                    <div class="grid grid-cols-1 gap-4">
                        <div class="flex flex-col gap-1.5">
                            <label for="{{ $name }}-short" class="text-sm font-medium text-slate-700">Descripción corta</label>
                            <textarea id="{{ $name }}-short" name="short_description" rows="2"
                                class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">{{ old('short_description') }}</textarea>
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label for="{{ $name }}-desc" class="text-sm font-medium text-slate-700">Descripción</label>
                            <textarea id="{{ $name }}-desc" name="description" rows="4"
                                class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">{{ old('description') }}</textarea>
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label for="{{ $name }}-amenities" class="text-sm font-medium text-slate-700">Amenidades</label>
                            <textarea id="{{ $name }}-amenities" name="amenities" rows="2"
                                class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">{{ old('amenities') }}</textarea>
                        </div>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                            <div class="flex flex-col gap-1.5">
                                <label for="{{ $name }}-meta-title" class="text-sm font-medium text-slate-700">Meta title</label>
                                <input id="{{ $name }}-meta-title" type="text" name="meta_title" value="{{ old('meta_title') }}"
                                    class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            </div>
                            <div class="flex flex-col gap-1.5 md:col-span-2">
                                <label for="{{ $name }}-meta-desc" class="text-sm font-medium text-slate-700">Meta description</label>
                                <input id="{{ $name }}-meta-desc" type="text" name="meta_description" value="{{ old('meta_description') }}"
                                    class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            </div>
                            <div class="flex flex-col gap-1.5 md:col-span-3">
                                <label for="{{ $name }}-meta-kw" class="text-sm font-medium text-slate-700">Meta keywords</label>
                                <input id="{{ $name }}-meta-kw" type="text" name="meta_keywords" value="{{ old('meta_keywords') }}"
                                    class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Imágenes --}}
                <section>
                    <h3 class="mb-3 text-sm font-semibold text-slate-800">Imágenes</h3>
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div class="flex flex-col gap-1.5">
                            <label for="{{ $name }}-image" class="text-sm font-medium text-slate-700">Imagen principal</label>
                            <label for="{{ $name }}-image"
                                class="group relative flex min-h-44 cursor-pointer flex-col items-center justify-center gap-3 overflow-hidden rounded-lg border-2 border-dashed border-slate-300 bg-slate-50 px-4 py-6 text-center transition hover:border-blue-400 hover:bg-blue-50/40 @error('image') border-red-400 @enderror">
                                <input id="{{ $name }}-image" type="file" name="image" accept="image/jpeg,image/png,image/webp"
                                    data-image-input class="sr-only">
                                <img data-image-preview alt="Vista previa" class="absolute inset-0 hidden h-full w-full object-cover">
                                <div data-image-placeholder class="flex flex-col items-center gap-3">
                                    <span class="flex h-12 w-12 items-center justify-center rounded-full bg-white text-slate-400 shadow-sm ring-1 ring-slate-200">
                                        <x-lucide-image-plus class="size-6" />
                                    </span>
                                    <p class="text-sm font-medium text-slate-700">Subir imagen principal</p>
                                    <p class="text-xs text-slate-500">JPG, PNG o WEBP</p>
                                </div>
                                <span data-image-name class="pointer-events-none absolute bottom-0 left-0 right-0 truncate bg-slate-900/70 px-3 py-1.5 text-xs text-white empty:hidden"></span>
                            </label>
                            @error('image')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="{{ $name }}-gallery" class="text-sm font-medium text-slate-700">Imágenes secundarias</label>
                            <label for="{{ $name }}-gallery"
                                class="group relative flex min-h-44 cursor-pointer flex-col items-center justify-center gap-3 overflow-hidden rounded-lg border-2 border-dashed border-slate-300 bg-slate-50 px-4 py-6 text-center transition hover:border-blue-400 hover:bg-blue-50/40">
                                <input id="{{ $name }}-gallery" type="file" name="gallery[]" accept="image/jpeg,image/png,image/webp"
                                    multiple data-gallery-input class="sr-only">
                                <div class="flex flex-col items-center gap-3">
                                    <span class="flex h-12 w-12 items-center justify-center rounded-full bg-white text-slate-400 shadow-sm ring-1 ring-slate-200">
                                        <x-lucide-images class="size-6" />
                                    </span>
                                    <p class="text-sm font-medium text-slate-700">Subir galería</p>
                                    <p class="text-xs text-slate-500">Puedes seleccionar varias</p>
                                </div>
                            </label>
                            <div data-gallery-preview class="mt-2 grid grid-cols-3 gap-2"></div>
                            @error('gallery')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                            @error('gallery.*')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </section>
            </div>

            <div class="flex shrink-0 items-center justify-end gap-3 border-t border-slate-200 px-6 py-4">
                <button type="button" data-modal-close
                    class="rounded-md border border-slate-300 px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                    Cancelar
                </button>
                <button type="submit"
                    class="rounded-md bg-green-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-green-700">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>

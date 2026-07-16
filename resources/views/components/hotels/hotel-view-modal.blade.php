@props([
    'name' => 'hotel-view',
])

<div
    data-modal="{{ $name }}"
    role="dialog"
    aria-modal="true"
    aria-labelledby="{{ $name }}-title"
    class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <div data-modal-close class="absolute inset-0 bg-slate-900/50"></div>

    <div class="relative z-10 flex max-h-[90vh] w-full max-w-2xl flex-col rounded-lg bg-white shadow-xl">
        <div class="flex shrink-0 items-center justify-between border-b border-slate-200 px-6 py-4">
            <h2 id="{{ $name }}-title" class="text-base font-semibold text-slate-800">
                Ver hotel
            </h2>
            <button type="button" data-modal-close aria-label="Cerrar"
                class="flex h-8 w-8 items-center justify-center rounded-md text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                <x-lucide-x class="size-5" />
            </button>
        </div>

        <div class="flex-1 space-y-6 overflow-y-auto px-6 py-6">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div class="space-y-4">
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Nombre</p>
                        <p data-view-name class="mt-1 text-sm text-slate-800">—</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Destino</p>
                        <p data-view-destination class="mt-1 text-sm text-slate-800">—</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Estrellas</p>
                        <p data-view-star-category class="mt-1 text-sm text-slate-800">—</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Dirección</p>
                        <p data-view-address class="mt-1 text-sm text-slate-800">—</p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span data-view-published class="inline-flex rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-medium text-slate-600">—</span>
                        <span data-view-featured class="inline-flex rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-medium text-slate-600">—</span>
                        <span data-view-active class="inline-flex rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-medium text-slate-600">—</span>
                    </div>
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Descripción corta</p>
                        <p data-view-short-description class="mt-1 text-sm text-slate-800">—</p>
                    </div>
                </div>

                <div class="flex flex-col gap-1.5">
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Imagen principal</p>
                    <div class="relative flex min-h-40 items-center justify-center overflow-hidden rounded-lg border border-slate-200 bg-slate-50">
                        <img data-view-image alt="" class="hidden h-full w-full object-cover">
                        <div data-view-image-empty class="flex flex-col items-center gap-2 text-slate-400">
                            <x-lucide-image class="size-12 text-slate-300" />
                            <span class="text-xs">Sin imagen</span>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <p class="mb-2 text-xs font-medium uppercase tracking-wide text-slate-400">Galería secundaria</p>
                <div data-view-gallery class="grid grid-cols-3 gap-2 sm:grid-cols-4">
                    <p data-view-gallery-empty class="col-span-full text-sm text-slate-400">Sin imágenes secundarias.</p>
                </div>
            </div>
        </div>

        <div class="flex shrink-0 justify-end border-t border-slate-200 px-6 py-4">
            <button type="button" data-modal-close
                class="rounded-md border border-slate-300 px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                Cerrar
            </button>
        </div>
    </div>
</div>

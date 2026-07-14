@props([
    'name' => 'destination-view',
])

<div
    data-modal="{{ $name }}"
    role="dialog"
    aria-modal="true"
    aria-labelledby="{{ $name }}-title"
    class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <div data-modal-close class="absolute inset-0 bg-slate-900/50"></div>

    <div class="relative z-10 flex w-full max-w-lg flex-col rounded-lg bg-white shadow-xl">
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
            <h2 id="{{ $name }}-title" class="text-base font-semibold text-slate-800">
                Ver destino
            </h2>
            <button
                type="button"
                data-modal-close
                aria-label="Cerrar"
                class="flex h-8 w-8 items-center justify-center rounded-md text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                <x-lucide-x class="size-5" />
            </button>
        </div>

        <div class="grid grid-cols-1 gap-6 px-6 py-6 sm:grid-cols-2">
            <div class="flex flex-col gap-4">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Ciudad</p>
                    <p data-view-city class="mt-1 text-sm text-slate-800">—</p>
                </div>
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">País</p>
                    <p data-view-country class="mt-1 text-sm text-slate-800">—</p>
                </div>
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Estado</p>
                    <p data-view-state class="mt-1 text-sm text-slate-800">—</p>
                </div>
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Estado del registro</p>
                    <p data-view-active class="mt-1 text-sm text-slate-800">—</p>
                </div>
            </div>

            <div class="flex flex-col gap-1.5">
                <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Imagen</p>
                <div class="relative flex min-h-40 items-center justify-center overflow-hidden rounded-lg border border-slate-200 bg-slate-50">
                    <img
                        data-view-image
                        alt=""
                        class="absolute inset-0 hidden h-full w-full object-cover">
                    <span data-view-image-empty class="text-sm text-slate-400">Sin imagen</span>
                </div>
            </div>
        </div>

        <div class="flex justify-end border-t border-slate-200 px-6 py-4">
            <button
                type="button"
                data-modal-close
                class="rounded-md border border-slate-300 px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                Cerrar
            </button>
        </div>
    </div>
</div>

@props([
    'name' => 'hotel-delete',
])

<div
    data-modal="{{ $name }}"
    role="dialog"
    aria-modal="true"
    aria-labelledby="{{ $name }}-title"
    class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <div data-modal-close class="absolute inset-0 bg-slate-900/50"></div>

    <div class="relative z-10 flex w-full max-w-md flex-col rounded-lg bg-white shadow-xl">
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
            <h2 id="{{ $name }}-title" class="text-base font-semibold text-slate-800">
                Eliminar hotel
            </h2>
            <button type="button" data-modal-close aria-label="Cerrar"
                class="flex h-8 w-8 items-center justify-center rounded-md text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                <x-lucide-x class="size-5" />
            </button>
        </div>

        <form data-delete-form action="#" method="POST" class="flex flex-col">
            @csrf
            @method('DELETE')

            <div class="px-6 py-6">
                <p class="text-sm text-slate-600">
                    ¿Seguro que deseas eliminar el hotel
                    <span data-delete-name class="font-semibold text-slate-800">—</span>?
                    Esta acción no se puede deshacer.
                </p>
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-slate-200 px-6 py-4">
                <button type="button" data-modal-close
                    class="rounded-md border border-slate-300 px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                    Cancelar
                </button>
                <button type="submit"
                    class="rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-red-700">
                    Eliminar
                </button>
            </div>
        </form>
    </div>
</div>

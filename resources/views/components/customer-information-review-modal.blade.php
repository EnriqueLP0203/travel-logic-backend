@props([
    'name' => 'customer-information-review',
    'status' => null,
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
                Revisar solicitud
            </h2>
            <button
                type="button"
                data-modal-close
                aria-label="Cerrar"
                class="flex h-8 w-8 items-center justify-center rounded-md text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                <x-lucide-x class="size-5" />
            </button>
        </div>

        <form data-review-form action="#" method="POST" class="flex flex-col">
            @csrf
            @method('PUT')

            @if ($status)
                <input type="hidden" name="status" value="{{ $status }}">
            @endif

            <div class="space-y-4 px-6 py-6">
                <p class="text-sm text-slate-600">
                    Agencia: <span data-review-agency-name class="font-semibold text-slate-800">—</span>
                </p>

                <fieldset data-review-acceptance-fieldset class="space-y-2">
                    <legend class="text-sm font-medium text-slate-700">Decisión</legend>
                    <label class="flex items-center gap-2 text-sm text-slate-700">
                        <input type="radio" name="is_accepted" value="1" data-review-is-accepted-true
                            class="size-4 border-slate-300 text-green-600 focus:ring-green-500">
                        Aceptar solicitud
                    </label>
                    <label class="flex items-center gap-2 text-sm text-slate-700">
                        <input type="radio" name="is_accepted" value="0" data-review-is-accepted-false
                            class="size-4 border-slate-300 text-red-600 focus:ring-red-500">
                        Rechazar solicitud
                    </label>
                    <p class="text-xs text-slate-500">
                        Haz clic de nuevo en una opción seleccionada para dejar la solicitud pendiente.
                    </p>
                </fieldset>
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

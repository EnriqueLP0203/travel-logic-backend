@props([
    'name' => 'customer-information-view',
])

<div
    data-modal="{{ $name }}"
    role="dialog"
    aria-modal="true"
    aria-labelledby="{{ $name }}-title"
    class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <div data-modal-close class="absolute inset-0 bg-slate-900/50"></div>

    <div class="relative z-10 flex max-h-[90vh] w-full max-w-3xl flex-col overflow-hidden rounded-lg bg-white shadow-xl">
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
            <h2 id="{{ $name }}-title" class="text-base font-semibold text-slate-800">
                Detalle de solicitud
            </h2>
            <button
                type="button"
                data-modal-close
                aria-label="Cerrar"
                class="flex h-8 w-8 items-center justify-center rounded-md text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                <x-lucide-x class="size-5" />
            </button>
        </div>

        <div class="overflow-y-auto px-6 py-6">
            <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-2">
                <div class="space-y-4">
                    <h3 class="text-sm font-semibold text-slate-800">Cuenta</h3>
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Usuario</p>
                        <p data-view-username class="mt-1 text-sm text-slate-800">—</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Agencia</p>
                        <p data-view-agency-name class="mt-1 text-sm text-slate-800">—</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Nombre fiscal</p>
                        <p data-view-legal-name class="mt-1 text-sm text-slate-800">—</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Logotipo</p>
                        <a data-view-logo-link href="#" target="_blank" rel="noopener noreferrer"
                            class="mt-1 inline-flex items-center gap-1 text-sm text-blue-600 hover:underline hidden">
                            Ver logotipo
                            <x-lucide-external-link class="size-3.5" />
                        </a>
                        <p data-view-logo-empty class="mt-1 text-sm text-slate-400">Sin enlace</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <h3 class="text-sm font-semibold text-slate-800">Contacto</h3>
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Persona</p>
                        <p data-view-contact-person class="mt-1 text-sm text-slate-800">—</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Correo</p>
                        <p data-view-email class="mt-1 text-sm text-slate-800">—</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Ubicación</p>
                        <p data-view-location class="mt-1 text-sm text-slate-800">—</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Teléfonos</p>
                        <p data-view-phones class="mt-1 text-sm text-slate-800">—</p>
                    </div>
                </div>
            </div>

            <div class="space-y-4 border-t border-slate-200 pt-6">
                <h3 class="text-sm font-semibold text-slate-800">Facturación</h3>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Encargado</p>
                        <p data-view-billing-manager class="mt-1 text-sm text-slate-800">—</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Correo</p>
                        <p data-view-billing-email class="mt-1 text-sm text-slate-800">—</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Dirección</p>
                        <p data-view-billing-address class="mt-1 text-sm text-slate-800">—</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Ubicación</p>
                        <p data-view-billing-location class="mt-1 text-sm text-slate-800">—</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Código postal</p>
                        <p data-view-billing-zip-code class="mt-1 text-sm text-slate-800">—</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Teléfonos</p>
                        <p data-view-billing-phones class="mt-1 text-sm text-slate-800">—</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Código fiscal</p>
                        <p data-view-billing-tax-id class="mt-1 text-sm text-slate-800">—</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Mismos datos de contacto</p>
                        <p data-view-billing-same-as-contact class="mt-1 text-sm text-slate-800">—</p>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex flex-wrap gap-4 border-t border-slate-200 pt-6 text-sm text-slate-600">
                <span>Estado: <strong data-view-status-label class="text-slate-800">—</strong></span>
                <span>Registrado: <strong data-view-created-at class="text-slate-800">—</strong></span>
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

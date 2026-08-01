@props([
    'name' => 'register-agency-success',
])

<div
    data-modal="{{ $name }}"
    data-redirect-on-close="{{ route('home') }}"
    role="dialog"
    aria-modal="true"
    aria-labelledby="{{ $name }}-title"
    @if (session('success')) data-open-on-load @endif
    class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <div data-modal-close class="absolute inset-0 bg-stone-900/50"></div>

    <div class="relative z-10 flex w-full max-w-md flex-col rounded-lg bg-white p-8 shadow-xl">
        <div class="flex flex-col items-center gap-4 text-center">
            <div class="flex size-16 items-center justify-center rounded-full bg-green-100">
                <x-lucide-circle-check class="size-8 text-green-500" />
            </div>

            <h2 id="{{ $name }}-title" class="text-xl font-bold font-montserrat text-indigo-950">
                ¡Registro enviado!
            </h2>

            <p class="text-sm font-montserrat text-stone-600">
                {{ session('success', 'Tu solicitud de registro fue enviada correctamente. Te contactaremos cuando sea revisada.') }}
            </p>
        </div>

        <button
            type="button"
            data-modal-close
            class="mt-6 h-12 w-full rounded-lg bg-green-300 text-base font-bold font-montserrat text-white transition-opacity hover:opacity-90">
            Cerrar
        </button>
    </div>
</div>

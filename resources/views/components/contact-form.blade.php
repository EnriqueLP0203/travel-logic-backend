<section
    id="contacto"
    aria-label="Formulario de contacto"
    class="mb-20 bg-white py-16 md:py-24"
>
    <form
        class="mx-auto flex w-full max-w-[1385px] flex-col gap-8"
        method="POST"
        action="#"
    >
        @csrf

        <h2 class="text-center text-5xl font-bold leading-tight text-indigo-950 md:text-6xl">
            Formulario
        </h2>

        <div class="grid grid-cols-1 gap-4 lg:grid-cols-[545fr_384fr_384fr] lg:gap-6">
            <input
                type="text"
                name="nombre"
                placeholder="Nombre"
                class="h-20 w-full rounded-lg border-[1.5px] border-stone-900 px-6 text-base text-stone-900 placeholder:text-stone-900/50 focus:outline-none focus:ring-2 focus:ring-green-1/30"
                required
            />
            <input
                type="tel"
                name="telefono"
                placeholder="Teléfono"
                class="h-20 w-full rounded-lg border-[1.5px] border-stone-900 px-6 text-base text-stone-900 placeholder:text-stone-900/50 focus:outline-none focus:ring-2 focus:ring-green-1/30"
                required
            />
            <input
                type="email"
                name="correo"
                placeholder="Correo"
                class="h-20 w-full rounded-lg border-[1.5px] border-stone-900 px-6 text-base text-stone-900 placeholder:text-stone-900/50 focus:outline-none focus:ring-2 focus:ring-green-1/30"
                required
            />
        </div>

        <textarea
            name="mensaje"
            placeholder="Mensaje"
            rows="8"
            class="min-h-72 w-full resize-y rounded-lg border-[1.5px] border-stone-900 p-6 text-base text-stone-900 placeholder:text-stone-900/50 focus:outline-none focus:ring-2 focus:ring-green-1/30"
            required
        ></textarea>

        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <label class="flex cursor-pointer items-start gap-3">
                <input
                    type="checkbox"
                    name="privacidad"
                    class="mt-1 size-4 shrink-0 rounded-[3px] border border-stone-900 accent-green-1"
                    required
                />
                <span class="text-base leading-7 text-stone-900">
                    He leído el
                    <a href="#" class="underline hover:text-green-1 transition-colors">Aviso de Privacidad</a>
                    antes de enviar el formulario.
                </span>
            </label>

            <button
                type="submit"
                class="h-16 w-full shrink-0 rounded-[46px] bg-green-1 px-20 text-2xl font-bold text-white transition-opacity hover:opacity-90 lg:w-96"
            >
                Enviar
            </button>
        </div>
    </form>
</section>

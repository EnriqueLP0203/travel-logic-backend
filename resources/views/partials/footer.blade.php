<footer class="bg-blue-400">
    <div class="flex items-start justify-between gap-12 px-14 py-8 pt-24">
        <div class="flex max-w-64 flex-col gap-6">
            <img src="{{ asset('images/logo.webp') }}" alt="Travel Logic" class="w-24 shrink-0" />
            <p class="text-base font-light font-lato text-white">
                Tour operador especializado en el mercado B2B. Tu socio estratégico para crecer en turismo.
            </p>
        </div>

        <div class="flex flex-col gap-6">
            <p class="text-sm font-bold font-montserrat text-white">DESTINOS</p>
            <a href="#" class="text-sm font-light font-lato text-white transition-colors hover:text-green-300">Familiar</a>
            <a href="#" class="text-sm font-light font-lato text-white transition-colors hover:text-green-300">Deporte</a>
            <a href="#" class="text-sm font-light font-lato text-white transition-colors hover:text-green-300">Eventos</a>
            <a href="#" class="text-sm font-light font-lato text-white transition-colors hover:text-green-300">Lifestyle & Wellness</a>
            <a href="#" class="text-sm font-light font-lato text-white transition-colors hover:text-green-300">Cultural</a>
        </div>

        <div class="flex flex-col gap-6">
            <p class="text-sm font-bold font-montserrat text-white">EMPRESA</p>
            <a href="{{ route('about') }}" class="text-sm font-light font-lato text-white transition-colors hover:text-green-300">Quienes somos</a>
            <a href="#" class="text-sm font-light font-lato text-white transition-colors hover:text-green-300">Unete como agencia</a>
        </div>

        <div class="flex flex-col gap-6">
            <p class="text-sm font-bold font-montserrat text-white">SOPORTE</p>
            <a href="#" class="text-sm font-light font-lato text-white transition-colors hover:text-green-300">Centro de ayuda</a>
            <a href="#" class="text-sm font-light font-lato text-white transition-colors hover:text-green-300">Terminos y Condiciones</a>
            <a href="#" class="text-sm font-light font-lato text-white transition-colors hover:text-green-300">Aviso de privacidad</a>
            <a href="#" class="text-sm font-light font-lato text-white transition-colors hover:text-green-300">Contacto</a>
        </div>
    </div>

    <div class="px-14 pb-12 pt-12 ">
        <div class="flex items-center justify-between">
            <p class="text-sm text-white">
                © {{ date('Y') }} Travel Logic. Todos los derechos reservados.
            </p>

            <div class="flex gap-4">
                <a href="#" aria-label="Facebook" class="flex size-8 items-center justify-center rounded-lg bg-white/50 text-white transition-opacity hover:opacity-80">
                    <x-si-facebook class="size-4" />
                </a>
                <a href="#" aria-label="Instagram" class="flex size-8 items-center justify-center rounded-lg bg-white/50 text-white transition-opacity hover:opacity-80">
                    <x-si-instagram class="size-4" />
                </a>
                <a href="#" aria-label="X" class="flex size-8 items-center justify-center rounded-lg bg-white/50 text-white transition-opacity hover:opacity-80">
                    <x-si-x class="size-4" />
                </a>
                <a href="#" aria-label="LinkedIn" class="flex size-8 items-center justify-center rounded-lg bg-white/50 text-white transition-opacity hover:opacity-80">
                    <x-lucide-linkedin class="size-4" />
                </a>
            </div>
        </div>
    </div>
</footer>

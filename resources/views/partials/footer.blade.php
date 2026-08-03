<footer class="bg-blue-400">
    <div class="grid grid-cols-1 gap-10 px-4 py-12 pt-16 sm:grid-cols-2 sm:px-6 lg:grid-cols-4 lg:gap-12 lg:px-14 lg:pt-24">
        <div class="flex max-w-sm flex-col gap-6 sm:col-span-2 lg:col-span-1">
            <img src="{{ asset('images/logo_white.png') }}" alt="Travel Logic" class="w-32 shrink-0" />
            <p class="text-base font-light font-lato text-white">
                Tour operador especializado en el mercado B2B. Tu socio estratégico para crecer en turismo.
            </p>
        </div>

        <div class="flex flex-col gap-4 sm:gap-6">
            <p class="text-sm font-bold font-montserrat text-white">GRUPOS</p>
            @forelse ($footerHotelGroups as $group)
                @php
                    $groupName = $group->translations->first()?->name ?? 'Grupo';
                @endphp
                <a
                    href="{{ route('hotels', ['hotel_group_id' => $group->id]) }}"
                    class="text-sm font-light font-lato text-white transition-colors duration-200 hover:text-green-300"
                >
                    {{ $groupName }}
                </a>
            @empty
                <p class="text-sm font-light font-lato text-white/70">Sin grupos disponibles</p>
            @endforelse
        </div>

        <div class="flex flex-col gap-4 sm:gap-6">
            <p class="text-sm font-bold font-montserrat text-white">EMPRESA</p>
            <a href="{{ route('about') }}" class="text-sm font-light font-lato text-white transition-colors duration-200 hover:text-green-300">Quienes somos</a>
            <a href="{{ route('register-agency') }}" class="text-sm font-light font-lato text-white transition-colors duration-200 hover:text-green-300">Unete como agencia</a>
        </div>

        <div class="flex flex-col gap-4 sm:gap-6">
            <p class="text-sm font-bold font-montserrat text-white">SOPORTE</p>
            <a href="#" class="text-sm font-light font-lato text-white transition-colors duration-200 hover:text-green-300">Terminos y Condiciones</a>
            <a href="#" class="text-sm font-light font-lato text-white transition-colors duration-200 hover:text-green-300">Aviso de privacidad</a>
            <a href="{{ route('contact') }}" class="text-sm font-light font-lato text-white transition-colors duration-200 hover:text-green-300">Contacto</a>
        </div>
    </div>

    <div class="px-4 pb-8 pt-8 sm:px-6 lg:px-14 lg:pb-12">
        <div class="flex flex-col items-center gap-4 sm:flex-row sm:justify-between">
            <p class="text-center text-sm text-white sm:text-left">
                © {{ date('Y') }} Travel Logic. Todos los derechos reservados.
            </p>

            <div class="flex gap-4">
                <a href="#" aria-label="Facebook" class="flex size-8 items-center justify-center rounded-lg bg-white/50 text-white transition-opacity duration-200 hover:opacity-80">
                    <x-si-facebook class="size-4" />
                </a>
                <a href="#" aria-label="Instagram" class="flex size-8 items-center justify-center rounded-lg bg-white/50 text-white transition-opacity duration-200 hover:opacity-80">
                    <x-si-instagram class="size-4" />
                </a>
                <a href="#" aria-label="X" class="flex size-8 items-center justify-center rounded-lg bg-white/50 text-white transition-opacity duration-200 hover:opacity-80">
                    <x-si-x class="size-4" />
                </a>
                <a href="#" aria-label="LinkedIn" class="flex size-8 items-center justify-center rounded-lg bg-white/50 text-white transition-opacity duration-200 hover:opacity-80">
                    <x-lucide-linkedin class="size-4" />
                </a>
            </div>
        </div>
    </div>
</footer>

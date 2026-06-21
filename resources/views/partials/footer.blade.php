<div>
    {{-- Top section --}}
    <div class="flex justify-between items-center mx-18 py-12">

        {{-- Menu + Social --}}
        <div class="flex flex-col gap-1">
            <p class="text-base font-bold text-indigo-950">MENU</p>
            <a href="{{ route('home') }}"   class="text-base font-medium text-indigo-950 hover:text-green-1 transition-colors">INICIO</a>
            <a href="{{ route('about') }}"  class="text-base font-medium text-indigo-950 hover:text-green-1 transition-colors">NOSOTROS</a>
            <a href="#"                     class="text-base font-medium text-indigo-950 hover:text-green-1 transition-colors">DESTINOS</a>
            <a href="{{ route('blog') }}"   class="text-base font-medium text-indigo-950 hover:text-green-1 transition-colors">BLOG</a>
            <a href="{{ route('quoter') }}" class="text-base font-medium text-indigo-950 hover:text-green-1 transition-colors">COTIZADOR</a>

            {{-- Social icons --}}
            <div class="flex gap-2 mt-4 items-center">
                {{-- Facebook --}}
                <a href="#" aria-label="Facebook" class="text-indigo-950 hover:text-green-1 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-6" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                    </svg>
                </a>
                {{-- Instagram --}}
                <a href="#" aria-label="Instagram" class="text-indigo-950 hover:text-green-1 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                        <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
                    </svg>
                </a>
                {{-- Twitter / X --}}
                <a href="#" aria-label="Twitter" class="text-indigo-950 hover:text-green-1 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L1.254 2.25H8.08l4.253 5.622 5.911-5.622Zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Description text --}}
        <div>
            <p class="w-80 text-indigo-950 text-lg font-normal">
                Lorem Ipsum is simply dummy text of the printing and typesetting
                industry. Lorem Ipsum has been the industry's standard dummy text
                ever since the 1500s been the industry's standard dummy text ever
                since the 1500s. Lorem Ipsum is simply dummy text of
            </p>
        </div>

        {{-- Logo --}}
        <div>
            <img src="{{ asset('images/logo.webp') }}" alt="Travel Logic" class="w-80 h-auto" />
        </div>
    </div>

    {{-- Bottom section --}}
    <div class="mx-18 pb-12">
        <div class="flex justify-center">
            <div class="w-full border-t-2 border-indigo-950"></div>
        </div>

        <div class="flex justify-between items-center mt-6">
            <p class="text-sm text-emerald-500">
                © {{ date('Y') }} Travel Logic. Todos los derechos reservados.
            </p>
            <div class="flex gap-6">
                <a href="#" class="text-sm font-medium text-emerald-500 hover:text-indigo-950 transition-colors">
                    Política de privacidad
                </a>
                <a href="#" class="text-sm font-medium text-emerald-500 hover:text-indigo-950 transition-colors">
                    Términos y condiciones
                </a>
            </div>
        </div>
    </div>
</div>
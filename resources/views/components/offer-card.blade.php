@props([
    'offer',
])

<div class="group relative flex h-[460px] w-full max-w-sm overflow-hidden rounded-3xl bg-gray-200 shadow-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl">
    {{-- Imagen que rellena toda la card --}}
    @if ($offer->image_url)
        <img
            src="{{ $offer->image_url }}"
            alt="{{ $offer->name }}"
            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
        />
    @else
        <div class="flex h-full w-full items-center justify-center bg-gray-300">
            <x-lucide-image class="h-16 w-16 text-gray-400" />
        </div>
    @endif

    {{-- Gradiente inferior para legibilidad del botón --}}
    <div class="absolute inset-x-0 bottom-0 h-32 bg-gradient-to-t from-black/60 to-transparent" aria-hidden="true"></div>

    {{-- Nombre de la oferta --}}
    <div class="absolute bottom-14 left-5 right-5">
        <p class="line-clamp-2 text-base font-bold font-inter text-white drop-shadow">{{ $offer->name }}</p>
    </div>

    {{-- Botón Pedir info → WhatsApp --}}
    <div class="absolute bottom-4 right-4">
        <a
            href="https://wa.me/529982339545?text={{ urlencode('Quiero pedir información sobre la oferta de "' . $offer->name . '"') }}"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex items-center gap-2 rounded-xl bg-green-500 px-4 py-2 text-sm font-bold font-inter text-white shadow-md transition-all duration-200 hover:-translate-y-0.5 hover:bg-green-600 hover:shadow-lg"
        >
            <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
            </svg>
            Pedir info
        </a>
    </div>
</div>

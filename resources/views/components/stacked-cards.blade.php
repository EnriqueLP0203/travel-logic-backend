@props(['items' => []])

@php
    $sparkle = <<<'SVG'
<svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
    <path d="M4 14 L10 12" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
    <path d="M6 8 L12 10" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
    <path d="M8 4 L12 8" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
</svg>
SVG;
@endphp

{{-- Contenedor: alto/ancho suficientes para las 3 rotadas --}}
<div {{ $attributes->merge(['class' => 'relative flex h-80 w-[28rem] shrink-0 items-center']) }}>
    @foreach ($items as $index => $item)
        @php
            $config = [
                0 => ['rotate' => '-rotate-[10deg]', 'translate' => '-translate-x-20 translate-y-0', 'z' => 'z-10'],
                1 => ['rotate' => '-rotate-[3deg]',  'translate' => 'translate-x-4 translate-y-0',   'z' => 'z-20'],
                2 => ['rotate' => 'rotate-[7deg]',   'translate' => 'translate-x-32 translate-y-0',  'z' => 'z-30'],
            ][$index] ?? ['rotate' => '', 'translate' => '', 'z' => 'z-10'];

            $isFront = $index === array_key_last($items);
        @endphp

        <div class="absolute left-0 top-0 w-64 h-80 p-4 bg-white rounded-xl shadow-[9px_16px_40px_20px_rgba(0,0,0,0.1)] overflow-hidden origin-top-left {{ $config['rotate'] }} {{ $config['translate'] }} {{ $config['z'] }} transition-transform duration-300 hover:scale-[1.02]">
            <img
                src="{{ $item['image'] }}"
                alt="{{ $item['name'] }}"
                class="w-full h-56 object-cover rounded-lg"
            />

            <div class="p-3">
                <p class="text-zinc-700 text-sm font-extrabold font-montserrat">{{ $item['name'] }}</p>
            </div>

            @if ($isFront)
                <div class="absolute bottom-3 right-3">
                    <button
                        type="button"
                        class="bg-green-300 text-white text-[10px] font-bold font-montserrat px-3 py-1.5 rounded-md transition-opacity hover:opacity-90"
                    >
                        Ver más
                    </button>
                </div>
            @endif
        </div>
    @endforeach


</div>

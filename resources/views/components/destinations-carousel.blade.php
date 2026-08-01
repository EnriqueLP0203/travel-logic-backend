@props([
    'destinations' => collect(),
])

@if ($destinations->isNotEmpty())
    <div class="destinations-marquee mt-10" aria-label="Carrusel de destinos">
        <div class="destinations-marquee__track">
            @foreach ([false, true] as $isDuplicate)
                <div
                    class="destinations-marquee__set"
                    @if ($isDuplicate) aria-hidden="true" @endif
                >
                    @foreach ($destinations as $destination)
                        <a
                            href="{{ route('hotels', ['destination_id' => $destination->id]) }}"
                            class="group relative block h-[28rem] w-80 shrink-0 overflow-hidden rounded-3xl bg-gray-400"
                            @if ($isDuplicate) tabindex="-1" @endif
                        >
                            @if ($destination->thumbnail_url)
                                <img
                                    src="{{ $destination->thumbnail_url }}"
                                    alt="{{ $destination->city }}"
                                    class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                    loading="lazy"
                                />
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent" aria-hidden="true"></div>

                            <div class="absolute inset-x-0 bottom-0 p-6">
                                <p class="text-2xl font-bold font-inter text-white">
                                    {{ $destination->city }}
                                </p>
                                @if ($destination->state || $destination->country)
                                    <p class="mt-1 text-sm font-medium font-inter text-white/80">
                                        {{ collect([$destination->state, $destination->country])->filter()->implode(', ') }}
                                    </p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endif

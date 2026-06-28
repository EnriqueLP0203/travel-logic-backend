@props([
    'paginator',
    'onEachSide' => 1,
])

@if ($paginator->hasPages())
    @php
        $current = $paginator->currentPage();
        $last = $paginator->lastPage();
        $start = max(1, $current - $onEachSide);
        $end = min($last, $current + $onEachSide);
    @endphp

    <nav
        role="navigation"
        aria-label="Paginación de hoteles"
        class="flex items-center justify-center mt-24"
    >
        <ul class="flex items-center gap-1 sm:gap-2">
            {{-- Botón anterior --}}
            <li>
                @if ($paginator->onFirstPage())
                    <span
                        aria-disabled="true"
                        class="flex h-10 w-10 cursor-not-allowed items-center justify-center rounded-lg border border-gray-200 text-gray-300"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </span>
                @else
                    <a
                        href="{{ $paginator->previousPageUrl() }}"
                        rel="prev"
                        aria-label="Página anterior"
                        class="flex h-10 w-10 items-center justify-center rounded-lg border border-gray-200 text-indigo-950 transition-colors duration-200 hover:border-indigo-400 hover:bg-indigo-50"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                @endif
            </li>

            {{-- Primera página + elipsis --}}
            @if ($start > 1)
                <li>
                    <a
                        href="{{ $paginator->url(1) }}"
                        class="flex h-10 min-w-[2.5rem] items-center justify-center rounded-lg border border-gray-200 px-3 text-sm font-medium text-indigo-950 transition-colors duration-200 hover:border-indigo-400 hover:bg-indigo-50"
                    >1</a>
                </li>
                @if ($start > 2)
                    <li>
                        <span class="flex h-10 items-center justify-center px-1 text-sm text-gray-400">…</span>
                    </li>
                @endif
            @endif

            {{-- Rango de páginas --}}
            @for ($page = $start; $page <= $end; $page++)
                <li>
                    @if ($page == $current)
                        <span
                            aria-current="page"
                            class="flex h-10 min-w-[2.5rem] items-center justify-center rounded-lg bg-indigo-950 px-3 text-sm font-semibold text-white"
                        >{{ $page }}</span>
                    @else
                        <a
                            href="{{ $paginator->url($page) }}"
                            class="flex h-10 min-w-[2.5rem] items-center justify-center rounded-lg border border-gray-200 px-3 text-sm font-medium text-indigo-950 transition-colors duration-200 hover:border-indigo-400 hover:bg-indigo-50"
                        >{{ $page }}</a>
                    @endif
                </li>
            @endfor

            {{-- Elipsis + última página --}}
            @if ($end < $last)
                @if ($end < $last - 1)
                    <li>
                        <span class="flex h-10 items-center justify-center px-1 text-sm text-gray-400">…</span>
                    </li>
                @endif
                <li>
                    <a
                        href="{{ $paginator->url($last) }}"
                        class="flex h-10 min-w-[2.5rem] items-center justify-center rounded-lg border border-gray-200 px-3 text-sm font-medium text-indigo-950 transition-colors duration-200 hover:border-indigo-400 hover:bg-indigo-50"
                    >{{ $last }}</a>
                </li>
            @endif

            {{-- Botón siguiente --}}
            <li>
                @if ($paginator->hasMorePages())
                    <a
                        href="{{ $paginator->nextPageUrl() }}"
                        rel="next"
                        aria-label="Página siguiente"
                        class="flex h-10 w-10 items-center justify-center rounded-lg border border-gray-200 text-indigo-950 transition-colors duration-200 hover:border-indigo-400 hover:bg-indigo-50"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @else
                    <span
                        aria-disabled="true"
                        class="flex h-10 w-10 cursor-not-allowed items-center justify-center rounded-lg border border-gray-200 text-gray-300"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                @endif
            </li>
        </ul>
    </nav>
@endif

<header class="sticky top-0 z-10 flex h-16 items-center justify-between border-b border-neutral-200 bg-white px-6 md:px-8">
    <h1 class="font-montserrat text-lg font-bold text-blue-400">
        @yield('heading', 'Admin')
    </h1>

    <div class="flex items-center gap-3">
        @hasSection('actions')
            @yield('actions')
        @endif
    </div>
</header>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>@yield('title', 'Admin') — Travel Logic</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-neutral-100 font-inter text-neutral-400 antialiased">
    <div class="flex min-h-screen">
        @include('partials.dashboard-sidebar')

        <div class="flex min-w-0 flex-1 flex-col">
            @include('partials.dashboard-topbar')

            <main class="flex-1 px-6 py-8 md:px-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>

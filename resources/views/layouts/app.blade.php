<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'MODA') }}</title>

        <!-- шрифти moda -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Syne:wght@400;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-moda-cream text-moda-black antialiased font-sans">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- контент сторінок -->
            <main class="max-w-6xl mx-auto px-6 py-10">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>

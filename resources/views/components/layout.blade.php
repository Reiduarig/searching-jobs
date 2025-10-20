<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-black text-white">
    <div class="px-10">
        <nav class="flex justify-between items-center py-4 border-b border-white/10 mb-10">
            <div>
                <a href="#">
                    <img src="/images/logo.png" alt="Logo">
                </a>
            </div>
            <div class="space-x-6 font-bold">
                <a href="#">Link 1</a>
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
                <a href="#">Link 4</a>
            </div>
            <div>
                <a href="#">Postear</a>
            </div>
        </nav>
        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html

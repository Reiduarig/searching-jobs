<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link 
        href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&display=swap" 
        rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-black text-white font-sans pb-20">
    <div class="px-10">
        <nav class="flex justify-between items-center py-4 border-b border-white/10 mb-10">
            <div>
                <a href="{{ route('jobs') }}">
                    <img src="/images/logo.png" alt="Logo">
                </a>
            </div>
            <div class="space-x-6 font-bold">
                <a href="{{ route('jobs') }}">Trabajos</a>
                <a href="#">Carreras</a>
                <a href="#">Salarios</a>
                <a href="#">Compañias</a>
            </div>
            @auth
                <div class="space-x-6 font-bold flex items-center">
                    <a href="/jobs/create">Postear</a>

                    <form method="POST" action="/logout" >
                        @csrf
                        @method('DELETE')
                        <button type="submit">Cerrar Sesión</button>
                    </form>
                </div>
            @endauth

            @guest
                <div class="space-x-6 font-bold">
                    <a href="{{ route('login') }}">Iniciar Sesión</a>
                    <a href="{{ route('register') }}">Registrarse</a>
                </div>
            @endguest
        </nav>
        <main class="max-w-[986px] mx-auto">
            {{ $slot }}
        </main>
    </div>
</body>
</html

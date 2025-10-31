<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'JobSearch') }}</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="shortcut icon" href="/favicon.ico">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link 
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" 
        rel="stylesheet" />
    {{-- <link 
        href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&display=swap" 
        rel="stylesheet" /> --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white font-sans min-h-screen">
    <!-- Efectos de fondo modernos -->
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.02"%3E%3Ccircle cx="30" cy="30" r="1.5"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-40"></div>
    
    <div class="relative z-10">
        <!-- Header moderno con backdrop blur -->
        <x-header />

        <!-- Menú móvil -->
        <x-menu-responsive />
        <!-- Contenido principal -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <x-footer />
        
        <!-- Modal global de aplicaciones -->
        <x-application-modal />
    </div>

    <!-- Chatbot de atención al cliente -->
    <x-chatbot-advanced />

    <script>
        // Funcionalidad del menú móvil
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');
            let isMenuOpen = false;

            function toggleMenu() {
                isMenuOpen = !isMenuOpen;
                
                if (isMenuOpen) {
                    // Abrir menú
                    mobileMenu.classList.remove('-translate-y-full');
                    mobileMenu.classList.add('translate-y-0');
                    mobileMenuOverlay.classList.remove('opacity-0', 'pointer-events-none');
                    mobileMenuOverlay.classList.add('opacity-100');
                    menuIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                } else {
                    // Cerrar menú
                    mobileMenu.classList.remove('translate-y-0');
                    mobileMenu.classList.add('-translate-y-full');
                    mobileMenuOverlay.classList.remove('opacity-100');
                    mobileMenuOverlay.classList.add('opacity-0', 'pointer-events-none');
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            }

            // Event listeners
            mobileMenuButton.addEventListener('click', toggleMenu);
            mobileMenuOverlay.addEventListener('click', toggleMenu);

            // Cerrar menú al hacer clic en un enlace
            const mobileMenuLinks = mobileMenu.querySelectorAll('a');
            mobileMenuLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (isMenuOpen) {
                        toggleMenu();
                    }
                });
            });

            // Cerrar menú con la tecla Escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && isMenuOpen) {
                    toggleMenu();
                }
            });

            // Manejar cambios de tamaño de pantalla
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768 && isMenuOpen) { // md breakpoint
                    toggleMenu();
                }
            });
        });

        // Animación suave al hacer scroll
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('a[href^="#"]');
            
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href === '#') return;
                    
                    e.preventDefault();
                    
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>

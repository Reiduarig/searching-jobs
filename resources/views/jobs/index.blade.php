<x-layout>
    <div class="space-y-16">
        <!-- Hero Section con diseño moderno -->
        <x-layout.hero-section :tags="$tags" />

        <!-- Trabajos Destacados -->
        <x-layout.featured-jobs :featuredJobs="$featuredJobs" />

        <!-- Trabajos Recientes -->
        <x-layout.recent-jobs :jobs="$jobs" />
    </div>

    <script>
        function scrollFeatured(direction) {
            const container = document.querySelector('.snap-x.snap-mandatory');
            const cardWidth = 320; // w-80 = 320px
            const gap = 24; // gap-6 = 24px
            const scrollAmount = cardWidth + gap;
            
            if (direction === 'left') {
                container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
            } else {
                container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            }
        }

        // Mejorar navegación y visibilidad de botones
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.snap-x.snap-mandatory');
            const leftButton = document.querySelector('button[onclick="scrollFeatured(\'left\')"]');
            const rightButton = document.querySelector('button[onclick="scrollFeatured(\'right\')"]');
            
            if (container) {
                function updateButtons() {
                    const isAtStart = container.scrollLeft <= 10; // Pequeño margen para precision
                    const isAtEnd = container.scrollLeft >= container.scrollWidth - container.clientWidth - 10;
                    
                    if (leftButton) {
                        leftButton.style.display = isAtStart ? 'none' : 'flex';
                        leftButton.style.opacity = isAtStart ? '0' : '1';
                    }
                    if (rightButton) {
                        rightButton.style.display = isAtEnd ? 'none' : 'flex';
                        rightButton.style.opacity = isAtEnd ? '0' : '1';
                    }
                }
                
                // Actualizar botones en scroll
                container.addEventListener('scroll', updateButtons);
                
                // Actualizar botones al redimensionar ventana
                window.addEventListener('resize', updateButtons);
                
                // Configuración inicial
                updateButtons();
                
                // Asegurar que las cards sean completamente visibles al cargar
                setTimeout(() => {
                    if (container.scrollLeft > 0) {
                        container.scrollTo({ left: 0, behavior: 'smooth' });
                    }
                }, 100);
            }
        });
    </script>
</x-layout>

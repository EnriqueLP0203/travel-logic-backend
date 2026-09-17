import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

/**
 * Inicializa las animaciones de scroll para elementos con el atributo data-animate
 * en el módulo Home.
 */
export function initHomeAnimations() {
    const animatedElements = document.querySelectorAll('[data-animate]');
    if (!animatedElements.length) return;

    // 1. Respetar preferencia de reducción de movimiento
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) {
        animatedElements.forEach((el) => {
            gsap.set(el, { clearProps: 'all', opacity: 1 });
        });
        return;
    }

    // 2. Configurar animaciones para cada elemento según su atributo data-animate
    animatedElements.forEach((el) => {
        const animationType = (el.dataset.animate || 'fade-up').trim().toLowerCase();
        const duration = parseFloat(el.dataset.animateDuration) || 0.8;
        let delay = parseFloat(el.dataset.animateDelay) || 0;
        // Si el delay viene en milisegundos (ej. 100, 200), convertirlo a segundos
        if (delay > 10) {
            delay = delay / 1000;
        }
        const distance = parseFloat(el.dataset.animateDistance) || 40;
        const ease = el.dataset.animateEase || 'power2.out';
        const start = el.dataset.animateStart || 'top 88%';
        const end = el.dataset.animateEnd || 'bottom top';

        let fromProps = { opacity: 0 };
        let toProps = { opacity: 1 };

        switch (animationType) {
            case 'fade-up':
                fromProps.y = distance;
                toProps.y = 0;
                break;
            case 'fade-down':
                fromProps.y = -distance;
                toProps.y = 0;
                break;
            case 'fade-left':
                // Entra desde la derecha deslizándose hacia la izquierda
                fromProps.x = distance;
                toProps.x = 0;
                break;
            case 'fade-right':
                // Entra desde la izquierda deslizándose hacia la derecha
                fromProps.x = -distance;
                toProps.x = 0;
                break;
            case 'fade':
            default:
                // Solo opacidad
                break;
        }

        gsap.fromTo(
            el,
            fromProps,
            {
                ...toProps,
                duration,
                delay,
                ease,
                scrollTrigger: {
                    trigger: el,
                    start,
                    end,
                    toggleActions: 'play reverse play reverse',
                },
            }
        );
    });

    // 3. Recalcular posiciones cuando todos los recursos (imágenes, fuentes) terminen de cargar
    window.addEventListener('load', () => {
        ScrollTrigger.refresh();
    });
}

// Inicializar cuando el DOM esté listo
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initHomeAnimations);
} else {
    initHomeAnimations();
}

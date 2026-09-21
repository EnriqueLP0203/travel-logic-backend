import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

/**
 * Inicializa las animaciones de scroll para la página About.
 *
 * Patrones usados:
 *   data-animate="fade-left"   → entra desde la izquierda
 *   data-animate="fade-right"  → entra desde la derecha
 *   data-animate="fade-up"     → entra desde abajo
 *   data-animate="fade"        → solo fade-in
 *
 *   data-animate-distance      → distancia de desplazamiento (px). Default 80
 *   data-animate-delay         → delay en segundos o ms (>10 se convierte). Default 0
 *   data-animate-duration      → duración en segundos. Default 0.9
 *   data-animate-ease          → easing GSAP. Default "power3.out"
 *   data-animate-start         → ScrollTrigger start. Default "top 88%"
 *
 * Comportamiento:
 *   - toggleActions: 'play reverse play reverse'
 *     → la animación RETROCEDE al hacer scroll hacia arriba.
 *   - Para secciones con data-pin-section: la sección queda
 *     "pinneada" mientras el contenido interior entra desde laterales,
 *     scrubbed al scroll. Al regresar, la animación también retrocede.
 */
export function initAboutAnimations() {
    // ── 0. Preferencia de reducción de movimiento ────────────────────────────
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (prefersReducedMotion) {
        document.querySelectorAll('[data-animate]').forEach((el) => {
            gsap.set(el, { clearProps: 'all', opacity: 1 });
        });
        return;
    }

    // ── 1. Sincronizar ScrollTrigger con Lenis (smooth scroll global) ────────
    if (window.lenis) {
        window.lenis.on('scroll', ScrollTrigger.update);
        gsap.ticker.lagSmoothing(0);
    }

    // ── 2. Animaciones genéricas con data-animate ───────────────────────────
    const animatedElements = document.querySelectorAll('[data-animate]');

    animatedElements.forEach((el) => {
        const type     = (el.dataset.animate || 'fade-up').trim().toLowerCase();
        const duration = parseFloat(el.dataset.animateDuration) || 0.9;
        const ease     = el.dataset.animateEase || 'power3.out';
        const start    = el.dataset.animateStart || 'top 88%';
        const distance = parseFloat(el.dataset.animateDistance) || 80;

        let delay = parseFloat(el.dataset.animateDelay) || 0;
        if (delay > 10) delay = delay / 1000; // ms → s

        const fromProps = { opacity: 0 };
        const toProps   = { opacity: 1 };

        switch (type) {
            case 'fade-left':
                fromProps.x = -distance;
                toProps.x   = 0;
                break;
            case 'fade-right':
                fromProps.x = distance;
                toProps.x   = 0;
                break;
            case 'fade-up':
                fromProps.y = distance;
                toProps.y   = 0;
                break;
            case 'fade-down':
                fromProps.y = -distance;
                toProps.y   = 0;
                break;
            case 'fade':
            default:
                break;
        }

        gsap.fromTo(el, fromProps, {
            ...toProps,
            duration,
            delay,
            ease,
            scrollTrigger: {
                trigger: el,
                start,
                end: 'bottom top',
                toggleActions: 'play reverse play reverse',
            },
        });
    });

    // ── 3. Secciones con PIN + scrub (lateral reveal cinematico) ─────────────
    const pinnedSections = document.querySelectorAll('[data-pin-section]');

    pinnedSections.forEach((section) => {
        const pinDuration = section.dataset.pinDuration || '+=600';
        const leftEls     = section.querySelectorAll('[data-pin-child="left"]');
        const rightEls    = section.querySelectorAll('[data-pin-child="right"]');
        const centerEls   = section.querySelectorAll('[data-pin-child="center"]');

        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: section,
                start: 'top top',
                end: pinDuration,
                pin: true,
                scrub: 1.2,
                anticipatePin: 1,
            },
        });

        if (leftEls.length) {
            tl.fromTo(
                leftEls,
                { x: -120, opacity: 0 },
                { x: 0, opacity: 1, duration: 1, ease: 'power2.out', stagger: 0.15 },
                0
            );
        }

        if (rightEls.length) {
            tl.fromTo(
                rightEls,
                { x: 120, opacity: 0 },
                { x: 0, opacity: 1, duration: 1, ease: 'power2.out', stagger: 0.15 },
                0
            );
        }

        if (centerEls.length) {
            tl.fromTo(
                centerEls,
                { y: 60, opacity: 0 },
                { y: 0, opacity: 1, duration: 1, ease: 'power2.out', stagger: 0.12 },
                0.2
            );
        }
    });

    // ── 4. ScrollTrigger.batch para grids de logos / valores ─────────────────
    const batchGroups = document.querySelectorAll('[data-batch-group]');

    batchGroups.forEach((group) => {
        const children  = group.querySelectorAll('[data-batch-item]');
        if (!children.length) return;

        const direction = group.dataset.batchDirection || 'up';

        const getFrom = () => {
            if (direction === 'left')  return { x: -60, opacity: 0 };
            if (direction === 'right') return { x:  60, opacity: 0 };
            return { y: 40, opacity: 0 };
        };

        gsap.set(children, getFrom());

        ScrollTrigger.batch(children, {
            start: 'top 90%',
            onEnter: (els) =>
                gsap.to(els, {
                    x: 0, y: 0, opacity: 1,
                    duration: 0.7,
                    ease: 'power2.out',
                    stagger: 0.08,
                    overwrite: true,
                }),
            onLeaveBack: (els) =>
                gsap.to(els, {
                    ...getFrom(),
                    duration: 0.5,
                    ease: 'power2.in',
                    stagger: 0.05,
                    overwrite: true,
                }),
        });
    });

    // ── 5. Refresh al cargar todos los recursos ──────────────────────────────
    window.addEventListener('load', () => ScrollTrigger.refresh());
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAboutAnimations);
} else {
    initAboutAnimations();
}

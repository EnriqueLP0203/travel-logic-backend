document.addEventListener('DOMContentLoaded', () => {
    const elements = document.querySelectorAll('[data-animate-in]');

    if (!elements.length) {
        return;
    }

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (prefersReducedMotion) {
        elements.forEach((element) => {
            element.classList.remove('opacity-0', 'translate-y-8');
            element.classList.add('opacity-100', 'translate-y-0');
        });

        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                const element = entry.target;
                element.classList.remove('opacity-0', 'translate-y-8');
                element.classList.add('opacity-100', 'translate-y-0');
                observer.unobserve(element);
            });
        },
        { threshold: 0.12, rootMargin: '0px 0px -40px 0px' },
    );

    elements.forEach((element) => {
        const delay = element.dataset.animateDelay;

        if (delay) {
            element.style.transitionDelay = `${delay}ms`;
        }

        observer.observe(element);
    });
});

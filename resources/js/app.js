document.addEventListener('DOMContentLoaded', () => {
    const elements = document.querySelectorAll('[data-animate-in]');

    if (!elements.length) {
        return;
    }

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (prefersReducedMotion) {
        elements.forEach((el) => el.classList.add('is-visible'));
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                const el = entry.target;
                const delay = el.dataset.animateDelay;
                if (delay) {
                    setTimeout(() => el.classList.add('is-visible'), parseInt(delay));
                } else {
                    el.classList.add('is-visible');
                }
                observer.unobserve(el);
            });
        },
        { threshold: 0, rootMargin: '0px 0px 0px 0px' },
    );

    elements.forEach((el) => observer.observe(el));
});

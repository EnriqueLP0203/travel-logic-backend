document.addEventListener('DOMContentLoaded', () => {
    const elements = document.querySelectorAll('[data-animate-in]');

    if (elements.length) {
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        if (prefersReducedMotion) {
            elements.forEach((el) => el.classList.add('is-visible'));
        } else {
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
        }
    }

    const openModal = (modal) => {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    };

    const closeModal = (modal) => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    };

    document.querySelectorAll('[data-modal-target]').forEach((trigger) => {
        trigger.addEventListener('click', () => {
            const modal = document.querySelector(`[data-modal="${trigger.dataset.modalTarget}"]`);
            if (modal) {
                openModal(modal);
            }
        });
    });

    document.querySelectorAll('[data-modal]').forEach((modal) => {
        modal.querySelectorAll('[data-modal-close]').forEach((closer) => {
            closer.addEventListener('click', () => closeModal(modal));
        });

        if (modal.hasAttribute('data-open-on-load')) {
            openModal(modal);
        }
    });

    document.querySelectorAll('[data-image-input]').forEach((input) => {
        input.addEventListener('change', () => {
            const container = input.closest('label');
            if (!container) return;

            const preview = container.querySelector('[data-image-preview]');
            const placeholder = container.querySelector('[data-image-placeholder]');
            const fileName = container.querySelector('[data-image-name]');
            const file = input.files?.[0];

            if (!file || !preview) return;

            preview.src = window.URL.createObjectURL(file);
            preview.classList.remove('hidden');
            placeholder?.classList.add('hidden');

            if (fileName) {
                fileName.textContent = file.name;
            }
        });
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            document.querySelectorAll('[data-modal]:not(.hidden)').forEach((modal) => closeModal(modal));
        }
    });

    const profileContainer = document.querySelector('[data-profile-menu-container]');

    if (!profileContainer) {
        return;
    }

    const toggleButton = profileContainer.querySelector('[data-profile-toggle]');
    const profileMenu = profileContainer.querySelector('[data-profile-menu]');

    if (!toggleButton || !profileMenu) {
        return;
    }

    const closeProfileMenu = () => {
        profileMenu.classList.add('hidden');
        toggleButton.setAttribute('aria-expanded', 'false');
    };

    const openProfileMenu = () => {
        profileMenu.classList.remove('hidden');
        toggleButton.setAttribute('aria-expanded', 'true');
    };

    toggleButton.addEventListener('click', (event) => {
        event.stopPropagation();
        const isOpen = !profileMenu.classList.contains('hidden');

        if (isOpen) {
            closeProfileMenu();
        } else {
            openProfileMenu();
        }
    });

    document.addEventListener('click', (event) => {
        if (!profileContainer.contains(event.target)) {
            closeProfileMenu();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeProfileMenu();
        }
    });
});

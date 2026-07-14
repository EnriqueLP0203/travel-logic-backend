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
            if (!modal) return;

            populateDestinationModal(modal, trigger);
            openModal(modal);
        });
    });

    const populateDestinationModal = (modal, trigger) => {
        const target = trigger.dataset.modalTarget;

        if (target === 'destination-view') {
            modal.querySelector('[data-view-city]').textContent = trigger.dataset.city || '—';
            modal.querySelector('[data-view-state]').textContent = trigger.dataset.state || '—';
            modal.querySelector('[data-view-country]').textContent = trigger.dataset.country || '—';
            modal.querySelector('[data-view-active]').textContent =
                trigger.dataset.active === '1' ? 'Activo' : 'Inactivo';

            const image = modal.querySelector('[data-view-image]');
            const empty = modal.querySelector('[data-view-image-empty]');
            const thumb = trigger.dataset.thumbnail || '';

            if (thumb) {
                image.src = thumb;
                image.alt = trigger.dataset.city || '';
                image.classList.remove('hidden');
                empty?.classList.add('hidden');
            } else {
                image.removeAttribute('src');
                image.classList.add('hidden');
                empty?.classList.remove('hidden');
            }
        }

        if (target === 'destination-edit') {
            const form = modal.querySelector('[data-edit-form]');
            const idInput = modal.querySelector('[data-edit-id]');
            const cityInput = modal.querySelector('[data-edit-city]');
            const stateSelect = modal.querySelector('[data-edit-state]');
            const countrySelect = modal.querySelector('[data-edit-country]');
            const activeInput = modal.querySelector('[data-edit-active]');
            const preview = modal.querySelector('[data-edit-image-preview]');
            const placeholder = modal.querySelector('[data-edit-image-placeholder]');
            const fileName = modal.querySelector('[data-image-name]');
            const fileInput = modal.querySelector('[data-image-input]');

            if (form && trigger.dataset.updateUrl) {
                form.action = trigger.dataset.updateUrl;
            }

            if (idInput) idInput.value = trigger.dataset.id || '';
            if (cityInput) cityInput.value = trigger.dataset.city || '';
            if (countrySelect) countrySelect.value = trigger.dataset.country || '';
            if (stateSelect) stateSelect.value = trigger.dataset.state || '';
            if (activeInput) activeInput.checked = trigger.dataset.active === '1';

            if (fileInput) fileInput.value = '';
            if (fileName) fileName.textContent = '';

            const thumb = trigger.dataset.thumbnail || '';
            if (thumb && preview) {
                preview.src = thumb;
                preview.classList.remove('hidden');
                placeholder?.classList.add('hidden');
            } else if (preview) {
                preview.removeAttribute('src');
                preview.classList.add('hidden');
                placeholder?.classList.remove('hidden');
            }
        }

        if (target === 'destination-delete') {
            const form = modal.querySelector('[data-delete-form]');
            const cityLabel = modal.querySelector('[data-delete-city]');

            if (form && trigger.dataset.deleteUrl) {
                form.action = trigger.dataset.deleteUrl;
            }

            if (cityLabel) {
                cityLabel.textContent = trigger.dataset.city || '—';
            }
        }
    };

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

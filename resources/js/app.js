import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();
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
            populateAccommodationTypeModal(modal, trigger);
            populateHotelGroupModal(modal, trigger);
            populateHotelModal(modal, trigger);
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

    const populateAccommodationTypeModal = (modal, trigger) => {
        const target = trigger.dataset.modalTarget;
        const previewUrl =
            modal.dataset.iconPreviewUrl ||
            modal.querySelector('[data-icon-picker-root]')?.dataset.iconPreviewUrl ||
            '/admin/icons/preview';

        const emptyIconSvg =
            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-12 text-slate-300"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>';

        if (target === 'accommodation-type-view') {
            const nameEl = modal.querySelector('[data-view-name]');
            const activeEl = modal.querySelector('[data-view-active]');
            const iconEl = modal.querySelector('[data-view-icon]');
            const iconPreview = modal.querySelector('[data-view-icon-preview]');
            const iconClass = trigger.dataset.icon || '';

            if (nameEl) nameEl.textContent = trigger.dataset.name || '—';
            if (activeEl) activeEl.textContent = trigger.dataset.active === '1' ? 'Activo' : 'Inactivo';
            if (iconEl) iconEl.textContent = iconClass || '—';

            if (iconPreview) {
                if (!iconClass) {
                    iconPreview.innerHTML = emptyIconSvg;
                } else {
                    fetch(`${previewUrl}?name=${encodeURIComponent(iconClass)}`)
                        .then((res) => (res.ok ? res.json() : null))
                        .then((data) => {
                            iconPreview.innerHTML = data?.html || emptyIconSvg;
                        })
                        .catch(() => {
                            iconPreview.innerHTML = emptyIconSvg;
                        });
                }
            }
        }

        if (target === 'accommodation-type-edit') {
            const form = modal.querySelector('[data-edit-form]');
            const idInput = modal.querySelector('[data-edit-id]');
            const nameInput = modal.querySelector('[data-edit-name]');
            const activeSelect = modal.querySelector('[data-edit-active]');
            const iconInput = modal.querySelector('[data-edit-icon]');

            if (form && trigger.dataset.updateUrl) {
                form.action = trigger.dataset.updateUrl;
            }

            if (idInput) idInput.value = trigger.dataset.id || '';
            if (nameInput) nameInput.value = trigger.dataset.name || '';
            if (activeSelect) activeSelect.value = trigger.dataset.active === '1' ? '1' : '0';
            if (iconInput) {
                iconInput.value = trigger.dataset.icon || '';
                iconInput.dispatchEvent(new Event('input', { bubbles: true }));
            }
        }

        if (target === 'accommodation-type-delete') {
            const form = modal.querySelector('[data-delete-form]');
            const nameLabel = modal.querySelector('[data-delete-name]');

            if (form && trigger.dataset.deleteUrl) {
                form.action = trigger.dataset.deleteUrl;
            }

            if (nameLabel) {
                nameLabel.textContent = trigger.dataset.name || '—';
            }
        }
    };

    const populateHotelGroupModal = (modal, trigger) => {
        const target = trigger.dataset.modalTarget;

        if (target === 'hotel-group-view') {
            const nameEl = modal.querySelector('[data-view-name]');
            const activeEl = modal.querySelector('[data-view-active]');
            const image = modal.querySelector('[data-view-image]');
            const empty = modal.querySelector('[data-view-image-empty]');
            const thumb = trigger.dataset.thumbnail || '';

            if (nameEl) nameEl.textContent = trigger.dataset.name || '—';
            if (activeEl) activeEl.textContent = trigger.dataset.active === '1' ? 'Activo' : 'Inactivo';

            if (thumb && image) {
                image.src = thumb;
                image.alt = trigger.dataset.name || '';
                image.classList.remove('hidden');
                empty?.classList.add('hidden');
            } else if (image) {
                image.removeAttribute('src');
                image.classList.add('hidden');
                empty?.classList.remove('hidden');
            }
        }

        if (target === 'hotel-group-edit') {
            const form = modal.querySelector('[data-edit-form]');
            const idInput = modal.querySelector('[data-edit-id]');
            const nameInput = modal.querySelector('[data-edit-name]');
            const activeSelect = modal.querySelector('[data-edit-active]');
            const preview = modal.querySelector('[data-edit-image-preview]');
            const placeholder = modal.querySelector('[data-edit-image-placeholder]');
            const fileName = modal.querySelector('[data-image-name]');
            const fileInput = modal.querySelector('[data-image-input]');

            if (form && trigger.dataset.updateUrl) {
                form.action = trigger.dataset.updateUrl;
            }

            if (idInput) idInput.value = trigger.dataset.id || '';
            if (nameInput) nameInput.value = trigger.dataset.name || '';
            if (activeSelect) activeSelect.value = trigger.dataset.active === '1' ? '1' : '0';

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

        if (target === 'hotel-group-delete') {
            const form = modal.querySelector('[data-delete-form]');
            const nameLabel = modal.querySelector('[data-delete-name]');

            if (form && trigger.dataset.deleteUrl) {
                form.action = trigger.dataset.deleteUrl;
            }

            if (nameLabel) {
                nameLabel.textContent = trigger.dataset.name || '—';
            }
        }
    };

    const parseGalleryJson = (raw) => {
        try {
            const parsed = JSON.parse(raw || '[]');
            return Array.isArray(parsed) ? parsed : [];
        } catch {
            return [];
        }
    };

    const setCheckboxGroup = (container, csvIds) => {
        if (!container) return;
        const ids = new Set(
            String(csvIds || '')
                .split(',')
                .map((v) => v.trim())
                .filter(Boolean),
        );
        container.querySelectorAll('input[type="checkbox"]').forEach((checkbox) => {
            checkbox.checked = ids.has(String(checkbox.value));
        });
    };

    const renderExistingGallery = (container, items) => {
        if (!container) return;
        container.innerHTML = '';

        if (!items.length) {
            container.innerHTML =
                '<p class="col-span-full text-xs text-slate-400">Sin imágenes secundarias.</p>';
            return;
        }

        items.forEach((item) => {
            const wrap = document.createElement('label');
            wrap.className =
                'relative block overflow-hidden rounded-md border border-slate-200 bg-slate-50';
            wrap.innerHTML = `
                <img src="${item.url}" alt="" class="h-20 w-full object-cover">
                <span class="absolute inset-x-0 bottom-0 flex items-center gap-1 bg-slate-900/70 px-2 py-1 text-[10px] text-white">
                    <input type="checkbox" name="remove_gallery_ids[]" value="${item.id}" class="size-3 rounded border-slate-300">
                    Eliminar
                </span>
            `;
            container.appendChild(wrap);
        });
    };

    const renderViewGallery = (container, emptyEl, items) => {
        if (!container) return;
        container.querySelectorAll('[data-view-gallery-item]').forEach((el) => el.remove());

        if (!items.length) {
            emptyEl?.classList.remove('hidden');
            return;
        }

        emptyEl?.classList.add('hidden');
        items.forEach((item) => {
            const img = document.createElement('img');
            img.src = item.url;
            img.alt = '';
            img.setAttribute('data-view-gallery-item', '');
            img.className = 'h-20 w-full rounded-md object-cover border border-slate-200';
            container.appendChild(img);
        });
    };

    const populateHotelModal = (modal, trigger) => {
        const target = trigger.dataset.modalTarget;

        if (target === 'hotel-view') {
            const nameEl = modal.querySelector('[data-view-name]');
            const destEl = modal.querySelector('[data-view-destination]');
            const starsEl = modal.querySelector('[data-view-star-category]');
            const addressEl = modal.querySelector('[data-view-address]');
            const publishedEl = modal.querySelector('[data-view-published]');
            const featuredEl = modal.querySelector('[data-view-featured]');
            const activeEl = modal.querySelector('[data-view-active]');
            const shortEl = modal.querySelector('[data-view-short-description]');
            const image = modal.querySelector('[data-view-image]');
            const empty = modal.querySelector('[data-view-image-empty]');
            const galleryContainer = modal.querySelector('[data-view-gallery]');
            const galleryEmpty = modal.querySelector('[data-view-gallery-empty]');
            const thumb = trigger.dataset.thumbnail || '';
            const gallery = parseGalleryJson(trigger.dataset.gallery);

            if (nameEl) nameEl.textContent = trigger.dataset.name || '—';
            if (destEl) destEl.textContent = trigger.dataset.destination || '—';
            if (starsEl) starsEl.textContent = trigger.dataset.starCategory || '—';
            if (addressEl) addressEl.textContent = trigger.dataset.address || '—';
            if (publishedEl) {
                publishedEl.textContent = trigger.dataset.published === '1' ? 'Publicado' : 'No publicado';
            }
            if (featuredEl) {
                featuredEl.textContent = trigger.dataset.featured === '1' ? 'Destacado' : 'No destacado';
            }
            if (activeEl) {
                activeEl.textContent = trigger.dataset.active === '1' ? 'Activo' : 'Inactivo';
            }
            if (shortEl) shortEl.textContent = trigger.dataset.shortDescription || '—';

            if (thumb && image) {
                image.src = thumb;
                image.alt = trigger.dataset.name || '';
                image.classList.remove('hidden');
                empty?.classList.add('hidden');
            } else if (image) {
                image.removeAttribute('src');
                image.classList.add('hidden');
                empty?.classList.remove('hidden');
            }

            renderViewGallery(galleryContainer, galleryEmpty, gallery);
        }

        if (target === 'hotel-edit') {
            const form = modal.querySelector('[data-edit-form]');
            const setVal = (selector, value) => {
                const el = modal.querySelector(selector);
                if (el) el.value = value ?? '';
            };

            if (form && trigger.dataset.updateUrl) {
                form.action = trigger.dataset.updateUrl;
            }

            setVal('[data-edit-id]', trigger.dataset.id);
            setVal('[data-edit-name]', trigger.dataset.name);

            const titleName = modal.querySelector('[data-edit-title-name]');
            if (titleName) {
                titleName.textContent = trigger.dataset.name
                    ? `— ${trigger.dataset.name}`
                    : '';
            }

            setVal('[data-edit-destination]', trigger.dataset.destinationId);
            setVal('[data-edit-star-category]', trigger.dataset.starCategory);
            setVal('[data-edit-address]', trigger.dataset.address);
            setVal('[data-edit-postal-code]', trigger.dataset.postalCode);
            setVal('[data-edit-latitude]', trigger.dataset.latitude);
            setVal('[data-edit-longitude]', trigger.dataset.longitude);
            setVal('[data-edit-phone]', trigger.dataset.phone);
            setVal('[data-edit-email]', trigger.dataset.email);
            setVal('[data-edit-website]', trigger.dataset.website);
            setVal('[data-edit-star-rating]', trigger.dataset.starRating);
            setVal('[data-edit-price-range]', trigger.dataset.priceRange);
            setVal('[data-edit-slug]', trigger.dataset.slug);
            setVal('[data-edit-active]', trigger.dataset.active === '1' ? '1' : '0');
            setVal('[data-edit-published]', trigger.dataset.published === '1' ? '1' : '0');
            setVal('[data-edit-featured]', trigger.dataset.featured === '1' ? '1' : '0');
            setVal('[data-edit-short-description]', trigger.dataset.shortDescription);
            setVal('[data-edit-description]', trigger.dataset.description);
            setVal('[data-edit-amenities]', trigger.dataset.amenities);
            setVal('[data-edit-meta-title]', trigger.dataset.metaTitle);
            setVal('[data-edit-meta-description]', trigger.dataset.metaDescription);
            setVal('[data-edit-meta-keywords]', trigger.dataset.metaKeywords);

            setCheckboxGroup(
                modal.querySelector('[data-edit-hotel-groups]'),
                trigger.dataset.hotelGroups,
            );
            setCheckboxGroup(
                modal.querySelector('[data-edit-accommodation-types]'),
                trigger.dataset.accommodationTypes,
            );

            const fileInput = modal.querySelector('[data-image-input]');
            const fileName = modal.querySelector('[data-image-name]');
            const preview = modal.querySelector('[data-edit-image-preview]');
            const placeholder = modal.querySelector('[data-edit-image-placeholder]');
            const galleryInput = modal.querySelector('[data-gallery-input]');
            const galleryPreview = modal.querySelector('[data-gallery-preview]');

            if (fileInput) fileInput.value = '';
            if (fileName) fileName.textContent = '';
            if (galleryInput) galleryInput.value = '';
            if (galleryPreview) galleryPreview.innerHTML = '';

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

            renderExistingGallery(
                modal.querySelector('[data-edit-existing-gallery]'),
                parseGalleryJson(trigger.dataset.gallery),
            );
        }

        if (target === 'hotel-delete') {
            const form = modal.querySelector('[data-delete-form]');
            const nameLabel = modal.querySelector('[data-delete-name]');

            if (form && trigger.dataset.deleteUrl) {
                form.action = trigger.dataset.deleteUrl;
            }

            if (nameLabel) {
                nameLabel.textContent = trigger.dataset.name || '—';
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

    document.querySelectorAll('[data-gallery-input]').forEach((input) => {
        input.addEventListener('change', () => {
            const root = input.closest('section') || input.closest('form') || input.parentElement;
            const preview = root?.querySelector('[data-gallery-preview]');
            if (!preview) return;

            preview.innerHTML = '';
            Array.from(input.files || []).forEach((file) => {
                const img = document.createElement('img');
                img.src = window.URL.createObjectURL(file);
                img.alt = file.name;
                img.className = 'h-20 w-full rounded-md object-cover border border-slate-200';
                preview.appendChild(img);
            });
        });
    });

    const initLucideIconPickers = () => {
        const normalizeIconName = (raw) => {
            let name = String(raw || '')
                .trim()
                .toLowerCase()
                .replace(/[\s_]+/g, '-')
                .replace(/[^a-z0-9-]/g, '')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');

            if (!name) return '';
            if (!name.startsWith('lucide-')) name = `lucide-${name}`;
            return name;
        };

        document.querySelectorAll('[data-icon-picker-root]').forEach((root) => {
            const input = root.querySelector('[data-icon-input]');
            const previewBox = root.querySelector('[data-icon-preview]');
            const status = root.querySelector('[data-icon-status]');
            const openBtn = root.querySelector('[data-icon-picker-open]');
            const closeBtn = root.querySelector('[data-icon-picker-close]');
            const panel = root.querySelector('[data-icon-picker-panel]');
            const filterInput = root.querySelector('[data-icon-picker-filter]');
            const grid = root.querySelector('[data-icon-picker-grid]');
            const catalogUrl = root.dataset.iconCatalogUrl;
            const previewUrl = root.dataset.iconPreviewUrl;
            const previewsUrl = root.dataset.iconPreviewsUrl;

            if (!input || !previewBox || !catalogUrl || !previewUrl) return;

            let catalog = null;
            let previewTimer = null;
            let catalogLoaded = false;
            const svgCache = new Map();
            let gridObserver = null;

            const setPreviewHtml = (html) => {
                previewBox.innerHTML = html;
            };

            const lucideCatalogLink =
                '<a href="https://lucide.dev/icons" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline">lucide.dev/icons</a>';

            const setStatus = (message, isError = false) => {
                if (!status) return;
                status.innerHTML = `${message} ${lucideCatalogLink}`;
                status.classList.toggle('text-red-500', isError);
                status.classList.toggle('text-slate-500', !isError);
            };

            const loadPreview = async (rawValue) => {
                const component = normalizeIconName(rawValue);

                if (!component) {
                    setPreviewHtml(
                        '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5 text-slate-300"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>',
                    );
                    setStatus('Escribe el nombre Lucide o busca en el catálogo.');
                    return;
                }

                try {
                    const response = await fetch(`${previewUrl}?name=${encodeURIComponent(component)}`);
                    if (!response.ok) {
                        setPreviewHtml(
                            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-5 text-red-400"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg>',
                        );
                        setStatus('Icono no encontrado.', true);
                        return;
                    }

                    const data = await response.json();
                    setPreviewHtml(data.html || '');
                    if (input.value.trim() && data.component) {
                        input.value = data.component;
                    }
                    setStatus(`Icono: ${data.component}`);
                } catch {
                    setStatus('No se pudo cargar el preview.', true);
                }
            };

            const schedulePreview = () => {
                clearTimeout(previewTimer);
                previewTimer = setTimeout(() => loadPreview(input.value), 300);
            };

            input.addEventListener('input', schedulePreview);

            if (input.value) {
                loadPreview(input.value);
            }

            const renderGrid = (icons) => {
                if (!grid) return;

                if (gridObserver) {
                    gridObserver.disconnect();
                    gridObserver = null;
                }

                const query = (filterInput?.value || '').trim().toLowerCase();
                const filtered = query
                    ? icons.filter((name) => name.includes(query))
                    : icons;

                const limited = filtered.slice(0, 120);

                if (!limited.length) {
                    grid.innerHTML =
                        '<p class="col-span-full py-6 text-center text-xs text-slate-400">Sin resultados.</p>';
                    return;
                }

                grid.innerHTML = limited
                    .map(
                        (iconName) => `
                        <button
                            type="button"
                            data-icon-pick="${iconName}"
                            title="${iconName}"
                            class="flex flex-col items-center gap-1 rounded-md border border-transparent p-2 text-slate-700 hover:border-slate-300 hover:bg-white">
                            <span data-icon-pick-preview class="flex h-7 w-7 items-center justify-center text-slate-700">
                                <span class="size-4 animate-pulse rounded bg-slate-200"></span>
                            </span>
                            <span class="max-w-full truncate text-[10px] text-slate-500">${iconName}</span>
                        </button>`,
                    )
                    .join('');

                const pending = [];

                grid.querySelectorAll('[data-icon-pick]').forEach((btn) => {
                    const iconName = btn.getAttribute('data-icon-pick');
                    const slot = btn.querySelector('[data-icon-pick-preview]');

                    btn.addEventListener('click', () => {
                        input.value = `lucide-${iconName}`;
                        loadPreview(input.value);
                        panel?.classList.add('hidden');
                    });

                    if (svgCache.has(iconName) && slot) {
                        slot.innerHTML = svgCache.get(iconName);
                        return;
                    }

                    pending.push({ iconName, slot });
                });

                const loadBatch = async (batch) => {
                    if (!batch.length) return;

                    if (previewsUrl) {
                        try {
                            const names = batch.map((item) => item.iconName).join(',');
                            const response = await fetch(
                                `${previewsUrl}?names=${encodeURIComponent(names)}`,
                            );
                            if (response.ok) {
                                const data = await response.json();
                                const map = data.icons || {};
                                batch.forEach(({ iconName, slot }) => {
                                    const html = map[iconName];
                                    if (!html || !slot) return;
                                    svgCache.set(iconName, html);
                                    slot.innerHTML = html;
                                });
                                return;
                            }
                        } catch {
                            // fallback individual abajo
                        }
                    }

                    await Promise.all(
                        batch.map(async ({ iconName, slot }) => {
                            try {
                                const response = await fetch(
                                    `${previewUrl}?name=${encodeURIComponent(iconName)}`,
                                );
                                if (!response.ok) return;
                                const data = await response.json();
                                if (data.html && slot) {
                                    svgCache.set(iconName, data.html);
                                    slot.innerHTML = data.html;
                                }
                            } catch {
                                // ignore
                            }
                        }),
                    );
                };

                // Carga por lotes visibles (IntersectionObserver)
                const queue = [...pending];
                const flushVisible = () => {
                    const visible = queue.splice(0, 40);
                    loadBatch(visible);
                };

                if ('IntersectionObserver' in window) {
                    gridObserver = new IntersectionObserver(
                        (entries) => {
                            const toLoad = [];
                            entries.forEach((entry) => {
                                if (!entry.isIntersecting) return;
                                const btn = entry.target;
                                const iconName = btn.getAttribute('data-icon-pick');
                                const slot = btn.querySelector('[data-icon-pick-preview]');
                                gridObserver.unobserve(btn);

                                if (!iconName || svgCache.has(iconName)) {
                                    if (svgCache.has(iconName) && slot) {
                                        slot.innerHTML = svgCache.get(iconName);
                                    }
                                    return;
                                }

                                toLoad.push({ iconName, slot });
                            });

                            if (toLoad.length) loadBatch(toLoad);
                        },
                        { root: grid, rootMargin: '40px', threshold: 0.01 },
                    );

                    grid.querySelectorAll('[data-icon-pick]').forEach((btn) => {
                        if (!svgCache.has(btn.getAttribute('data-icon-pick'))) {
                            gridObserver.observe(btn);
                        }
                    });
                } else {
                    flushVisible();
                }
            };

            const ensureCatalog = async () => {
                if (catalogLoaded && catalog) {
                    renderGrid(catalog);
                    return;
                }

                try {
                    const response = await fetch(catalogUrl);
                    if (!response.ok) throw new Error('catalog failed');
                    const data = await response.json();
                    catalog = Array.isArray(data.icons) ? data.icons : [];
                    catalogLoaded = true;
                    renderGrid(catalog);
                } catch {
                    if (grid) {
                        grid.innerHTML =
                            '<p class="col-span-full py-6 text-center text-xs text-red-500">No se pudo cargar el catálogo.</p>';
                    }
                }
            };

            openBtn?.addEventListener('click', () => {
                panel?.classList.remove('hidden');
                ensureCatalog();
                filterInput?.focus();
            });

            closeBtn?.addEventListener('click', () => {
                panel?.classList.add('hidden');
            });

            filterInput?.addEventListener('input', () => {
                if (catalog) renderGrid(catalog);
            });
        });
    };

    initLucideIconPickers();

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

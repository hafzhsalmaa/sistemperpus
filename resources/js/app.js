const deleteForms = document.querySelectorAll('[data-delete-form]');
const modalOpenButtons = document.querySelectorAll('[data-modal-open]');
const modalCloseButtons = document.querySelectorAll('[data-modal-close]');
const modals = document.querySelectorAll('[data-modal]');
const editButtons = document.querySelectorAll('[data-edit-book]');
const editBookForm = document.getElementById('edit-book-form');
const dropdowns = document.querySelectorAll('[data-dropdown]');
const flashAlerts = document.querySelectorAll('[data-flash-alert]');
const passwordToggleButtons = document.querySelectorAll('[data-password-toggle]');

const openModal = (modalId) => {
    const modal = document.getElementById(modalId);

    if (! modal) {
        return;
    }

    modal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
};

const closeModal = (modal) => {
    if (! modal) {
        return;
    }

    modal.classList.add('hidden');

    if ([...modals].every((item) => item.classList.contains('hidden'))) {
        document.body.classList.remove('overflow-hidden');
    }
};

const fillEditForm = (book) => {
    if (! editBookForm || ! book) {
        return;
    }

    editBookForm.action = book.update_url;

    document.getElementById('edit_kode_buku').value = book.kode_buku ?? '';
    document.getElementById('edit_judul').value = book.judul ?? '';
    document.getElementById('edit_penulis').value = book.penulis ?? '';
    document.getElementById('edit_penerbit').value = book.penerbit ?? '';
    document.getElementById('edit_tahun_terbit').value = book.tahun_terbit ?? '';
    document.getElementById('edit_stok').value = book.stok ?? '';
};

const getBookDataFromDataset = (dataset) => {
    if (! dataset) {
        return null;
    }

    return {
        update_url: dataset.updateUrl ?? '',
        kode_buku: dataset.kodeBuku ?? '',
        judul: dataset.judul ?? '',
        penulis: dataset.penulis ?? '',
        penerbit: dataset.penerbit ?? '',
        tahun_terbit: dataset.tahunTerbit ?? '',
        stok: dataset.stok ?? '',
    };
};

deleteForms.forEach((form) => {
    form.addEventListener('submit', (event) => {
        const confirmed = window.confirm('Yakin ingin menghapus data buku ini?');

        if (! confirmed) {
            event.preventDefault();
        }
    });
});

modalOpenButtons.forEach((button) => {
    button.addEventListener('click', () => {
        openModal(button.dataset.modalOpen);
    });
});

modalCloseButtons.forEach((button) => {
    button.addEventListener('click', () => {
        closeModal(button.closest('[data-modal]'));
    });
});

editButtons.forEach((button) => {
    button.addEventListener('click', () => {
        fillEditForm(getBookDataFromDataset(button.dataset));
        openModal('edit-book-modal');
    });
});

modals.forEach((modal) => {
    if (modal.dataset.openOnLoad === 'true') {
        if (modal.id === 'edit-book-modal') {
            fillEditForm(getBookDataFromDataset(modal.dataset));
        }

        openModal(modal.id);
    }
});

dropdowns.forEach((dropdown) => {
    const toggleButton = dropdown.querySelector('[data-dropdown-toggle]');
    const menu = dropdown.querySelector('[data-dropdown-menu]');
    const icon = dropdown.querySelector('[data-dropdown-icon]');

    if (! toggleButton || ! menu) {
        return;
    }

    toggleButton.addEventListener('click', () => {
        const isHidden = menu.classList.contains('hidden');

        dropdowns.forEach((item) => {
            item.querySelector('[data-dropdown-menu]')?.classList.add('hidden');
            item.querySelector('[data-dropdown-toggle]')?.setAttribute('aria-expanded', 'false');
            item.querySelector('[data-dropdown-icon]')?.classList.remove('rotate-180');
        });

        if (isHidden) {
            menu.classList.remove('hidden');
            toggleButton.setAttribute('aria-expanded', 'true');
            icon?.classList.add('rotate-180');
        }
    });
});

document.addEventListener('click', (event) => {
    dropdowns.forEach((dropdown) => {
        if (dropdown.contains(event.target)) {
            return;
        }

        dropdown.querySelector('[data-dropdown-menu]')?.classList.add('hidden');
        dropdown.querySelector('[data-dropdown-toggle]')?.setAttribute('aria-expanded', 'false');
        dropdown.querySelector('[data-dropdown-icon]')?.classList.remove('rotate-180');
    });
});

const hideFlashAlert = (alert) => {
    if (! alert || alert.dataset.closing === 'true') {
        return;
    }

    alert.dataset.closing = 'true';
    alert.classList.add('flash-alert-hide');

    window.setTimeout(() => {
        alert.remove();
    }, 500);
};

flashAlerts.forEach((alert) => {
    const closeButton = alert.querySelector('[data-flash-close]');

    closeButton?.addEventListener('click', () => {
        hideFlashAlert(alert);
    });

    window.setTimeout(() => {
        hideFlashAlert(alert);
    }, 3000);
});

passwordToggleButtons.forEach((button) => {
    const wrapper = button.closest('.relative');
    const input = wrapper?.querySelector('[data-password-input]');
    const eyeOpen = button.querySelector('[data-eye-open]');
    const eyeClose = button.querySelector('[data-eye-close]');

    if (! input) {
        return;
    }

    button.addEventListener('click', () => {
        const showPassword = input.type === 'password';

        input.type = showPassword ? 'text' : 'password';
        eyeOpen?.classList.toggle('hidden', showPassword);
        eyeClose?.classList.toggle('hidden', ! showPassword);
        button.setAttribute('aria-label', showPassword ? 'Sembunyikan password' : 'Lihat password');
    });
});

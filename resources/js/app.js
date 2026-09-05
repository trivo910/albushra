import './bootstrap';

document.addEventListener('submit', (event) => {
    const form = event.target.closest('[data-confirm]');
    if (form && !window.confirm(form.dataset.confirm)) {
        event.preventDefault();
    }
});


// Inline delete buttons (used inside other forms, where a nested <form> would be invalid HTML).
// Replaces the previous nested <form data-confirm> which the browser was flattening into the
// outer package-edit form, causing the parent form to submit instead of the delete.
document.addEventListener('click', async (event) => {
    const button = event.target.closest('[data-delete-url]');
    if (!button) return;

    const url = button.dataset.deleteUrl;
    const token = button.dataset.deleteToken;
    const message = button.dataset.deleteConfirm || 'Are you sure?';

    if (!window.confirm(message)) {
        return;
    }

    button.disabled = true;
    try {
        await window.axios.delete(url, {
            headers: {
                'X-CSRF-TOKEN': token,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
        });
        window.location.reload();
    } catch (error) {
        button.disabled = false;
        const status = error.response?.status;
        const fallback = status === 419
            ? 'Your session expired. Please reload the page and try again.'
            : 'Could not delete the image. Please try again.';
        window.alert(error.response?.data?.message || fallback);
    }
});
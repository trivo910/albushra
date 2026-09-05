import './bootstrap';

document.addEventListener('submit', (event) => {
    const form = event.target.closest('[data-confirm]');
    if (form && !window.confirm(form.dataset.confirm)) {
        event.preventDefault();
    }
});


// Read the CSRF token from the standard Laravel meta tag first; fall back to a
// per-button data attribute for pages that don't include the meta tag.
function getCsrfToken() {
    const meta = document.querySelector('meta[name="csrf-token"]');
    if (meta && meta.content) {
        return meta.content;
    }
    return null;
}


// Inline delete buttons (used inside other forms, where a nested <form> would be invalid HTML).
document.addEventListener('click', async (event) => {
    const button = event.target.closest('[data-delete-url]');
    if (!button) return;

    if (button.dataset.deleteBusy === '1') {
        return;
    }

    const url = button.dataset.deleteUrl;
    const message = button.dataset.deleteConfirm;

    // If the markup explicitly opts-in to a confirmation prompt, show it.
    // (The per-row "Delete" link on the admin reviews page does NOT set
    // data-delete-confirm, so the click deletes immediately.)
    if (message && !window.confirm(message)) {
        return;
    }

    // Prefer the meta tag token (freshest); fall back to the data attribute that
    // was rendered into the page. This makes the request work even when one of
    // the two sources is missing.
    const token = getCsrfToken() || button.dataset.deleteToken;

    if (!token) {
        window.alert('Security token missing. Please reload the page and try again.');
        return;
    }

    button.dataset.deleteBusy = '1';
    button.disabled = true;
    const originalLabel = button.innerHTML;
    button.innerHTML = '…';

    // Optimistically remove the wrapper so the user sees instant feedback.
    // If the request fails we re-insert it.
    //
    // Wrap selection priority:
    //   1. data-delete-wrapper attribute (explicit opt-in)
    //   2. The closest <tr> ancestor (table row — used on the admin reviews
    //      index, where the "Delete" button lives inside a <td>)
    //   3. The button's direct parent (fallback for any other layout)
    const wrapper =
        button.closest('[data-delete-wrapper]') ||
        button.closest('tr') ||
        button.parentElement;
    const wrapperPlaceholder = document.createComment('delete-placeholder');
    const wrapperParent = wrapper.parentNode;
    wrapperParent.insertBefore(wrapperPlaceholder, wrapper);
    wrapper.style.display = 'none';

    try {
        await window.axios.delete(url, {
            headers: {
                'X-CSRF-TOKEN': token,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
        });

        // Success: remove the element entirely and keep the page as-is.
        wrapper.remove();
    } catch (error) {
        // Restore the wrapper to its original position.
        wrapper.style.display = '';
        if (wrapperPlaceholder.parentNode) {
            wrapperPlaceholder.parentNode.insertBefore(wrapper, wrapperPlaceholder);
            wrapperPlaceholder.remove();
        }
        button.disabled = false;
        button.innerHTML = originalLabel;
        delete button.dataset.deleteBusy;

        const status = error.response?.status;
        let message;
        if (status === 419) {
            message = 'Your session expired. Please reload the page and try again.';
        } else if (status === 403) {
            message = 'You are not allowed to perform this action.';
        } else if (status === 404) {
            message = 'The image was already removed.';
        } else if (error.response?.data?.message) {
            message = error.response.data.message;
        } else if (error.message) {
            message = `Could not delete the image: ${error.message}`;
        } else {
            message = 'Could not delete the image. Please try again.';
        }
        window.alert(message);
    }
});

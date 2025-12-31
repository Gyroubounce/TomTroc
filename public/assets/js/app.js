document.addEventListener('DOMContentLoaded', () => {

    const trigger = document.getElementById('trigger-file');
    const input = document.getElementById('profile-input');
    const form = document.getElementById('photo-form');

    if (trigger && input && form) {

        trigger.addEventListener('click', (e) => {
            e.preventDefault();
            input.click();
        });

        input.addEventListener('change', () => {
            form.submit();
        });
    }
});

document.addEventListener('DOMContentLoaded', () => {

    const triggerBook = document.getElementById('trigger-book-file');
    const inputBook = document.getElementById('book-image-input');
    const formBook = document.getElementById('book-photo-form');

    if (triggerBook && inputBook && formBook) {

        triggerBook.addEventListener('click', (e) => {
            e.preventDefault();
            inputBook.click();
        });

        inputBook.addEventListener('change', () => {
            formBook.submit();
        });
    }
});

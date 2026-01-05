document.addEventListener('DOMContentLoaded', () => {

    /* ------------------------------------------
       1. Upload photo de profil
    ------------------------------------------ */
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


    /* ------------------------------------------
       2. Upload photo de livre (edit)
    ------------------------------------------ */
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


    /* ------------------------------------------
       3. Aperçu dynamique (create)
    ------------------------------------------ */
    const previewInput = document.getElementById('book-image-input');
    const previewImage = document.getElementById('preview-image');
    const noImage = document.getElementById('no-image');

    // ⚠️ Ici on ne teste PAS les trois en même temps
    if (previewInput) {
        previewInput.addEventListener('change', (event) => {

            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();

            reader.onload = (e) => {
            previewImage.src = e.target.result; 
            previewImage.classList.remove('hidden'); 
            noImage.classList.add('hidden'); // 🔥 masque le placeholder 
            };

            reader.readAsDataURL(file);
        });
    }

});

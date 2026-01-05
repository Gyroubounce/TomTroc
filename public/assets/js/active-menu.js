document.addEventListener("DOMContentLoaded", () => {
    const current = window.location.pathname;

    document.querySelectorAll(".main-nav a, .user-nav a").forEach(link => {
        const href = link.getAttribute("href");

        // Cas exact (ex: /mon-compte)
        if (href === current) {
            link.classList.add("active");
        }

        // Cas des livres (toutes les pages sous /books)
        if (current.startsWith("/books") && href === "/books") {
            link.classList.add("active");
        }

        // Cas des messages (toutes les pages sous /messages)
        if (current.startsWith("/messages") && href === "/messages") {
            link.classList.add("active");
        }
    });
});

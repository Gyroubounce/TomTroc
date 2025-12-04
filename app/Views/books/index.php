<div class="page-container">
    <div class="page-header-content">
        <h1>Nos livres à l’échange</h1>
    <form class="search-bar" method="get" action="/books">
        <input type="text" name="q" placeholder="Rechercher un livre" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
        <button type="submit" class="search-btn">
            🔍
        </button>
</form>

    </div>

    <section class="books-grid">
        <?php foreach ($books as $book): ?>
            <a href="/books/<?= $book->id ?>" class="book-card">
                <?php if (!empty($book->image)): ?>
                    <img src="/uploads/<?= htmlspecialchars($book->image) ?>"
                         alt="<?= htmlspecialchars($book->title) ?>"
                         class="book-cover">
                <?php endif; ?>

                <h2 class="book-title"><?= htmlspecialchars($book->title) ?></h2>
                <p class="book-author"><?= htmlspecialchars($book->author) ?></p>
                <p class="book-seller">Vendu par : <?= htmlspecialchars($book->seller ?? 'Inconnu') ?></p>
            </a>
        <?php endforeach; ?>
    </section>
</div>

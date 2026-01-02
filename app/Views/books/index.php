<main role="main">
    <div class="page-container">

        <div class="page-header-content">
            <h1 id="books-title">Nos livres à l’échange</h1>

            <form class="search-bar"
                  method="get"
                  action="/books"
                  role="search"
                  aria-label="Rechercher un livre">

                <label for="search-input" class="visually-hidden">Rechercher un livre</label>
                <input
                    id="search-input"
                    type="text"
                    name="q"
                    placeholder="Rechercher un livre"
                    title="Rechercher un livre"
                    value="<?= htmlspecialchars($_GET['q'] ?? '') ?>"
                >

                <button type="submit"
                        class="search-btn"
                        aria-label="Lancer la recherche">
                    <img src="/assets/img/Union.png"
                         alt=""
                         class="search-icon"
                         aria-hidden="true">
                </button>
            </form>
        </div>
             <?php if (isset($_GET['q']) && empty($books)): ?>
                <p class="no-results">
                    Aucun livre ne correspond à « <?= htmlspecialchars($_GET['q']) ?> ».
                </p>
            <?php endif; ?>

        <!-- LISTE DES LIVRES -->
        <section class="books-grid"
                 aria-labelledby="books-title"
                 role="list">

            <?php foreach ($books as $book): ?>
                <a href="/books/<?= $book->getId() ?>"
                   class="book-card"
                   role="listitem"
                   tabindex="0"
                   aria-label="Voir le livre <?= htmlspecialchars($book->getTitle()) ?>
                   , écrit par <?= htmlspecialchars($book->getAuthor() ?? 'Auteur inconnu') ?>
                   , proposé par <?= htmlspecialchars($book->getUser()?->getUsername() ?? 'Utilisateur inconnu') ?>"
                >

                       <?php
                            $image = $book->getImage();

                            // Si l'image contient déjà un chemin complet, on le garde tel quel
                            if (str_starts_with($image, '/assets/uploads/books/')) {
                                $src = $image;
                            } else {
                                $src = '/assets/uploads/books/' . $image;
                            }
                            ?>

                            <img src="<?= htmlspecialchars($src) ?>"
                                alt="Couverture du livre <?= htmlspecialchars($book->getTitle()) ?>"
                                class="book-cover">



                    <h2 class="book-title">
                        <?= htmlspecialchars($book->getTitle()) ?>
                    </h2>

                    <p class="book-author">
                        <?= htmlspecialchars($book->getAuthor() ?? 'Auteur inconnu') ?>
                    </p>

                    <p class="book-seller">
                        Vendu par :
                        <span aria-label="Vendeur">
                            <?= htmlspecialchars($book->getUser()?->getUsername() ?? 'Inconnu') ?>
                        </span>
                    </p>

                </a>
            <?php endforeach; ?>

        </section>

    </div>
</main>

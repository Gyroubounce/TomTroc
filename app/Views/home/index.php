<main class="home" role="main">

    <!-- SECTION 1 : HERO -->
    <section class="home-hero" aria-labelledby="hero-title">
        <div class="container">

            <div class="home-hero-content">

                <div class="home-hero-text">
                    <h1 id="hero-title">Rejoignez nos lecteurs passionnés</h1>

                    <p> Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux
                        de la lecture. Nous croyons en la magie du partage de connaissances et
                        d'histoires à travers les livres.</p>

                    <a href="/books"
                       class="btn btn-primary btn-hero"
                       aria-label="Découvrir les livres disponibles à l'échange">
                        Découvrir
                    </a>
                </div>

                <div class="home-hero-image">
                    <img
                        src="/assets/img/connexion_01.png"
                        alt="Illustration de lecteurs et de livres">
                    <p class="hero-credit" aria-hidden="true">Hamza</p>
                </div>

            </div>

        </div>
    </section>


    <!-- SECTION 2 : DERNIERS LIVRES AJOUTÉS -->
    <section class="home-latest-books" aria-labelledby="latest-books-title">
        <div class="container">

            <h2 id="latest-books-title">Les derniers livres ajoutés</h2>

            <div class="books-grid" role="list">
                <?php foreach ($books as $book): ?>
                    <a href="/books/<?= $book->getId() ?>"
                       class="book-card"
                       role="listitem"
                       tabindex="0"
                       aria-label="Voir le livre <?= htmlspecialchars($book->getTitle()) ?>, écrit par <?= htmlspecialchars($book->getAuthor() ?? 'Auteur inconnu') ?>, proposé par <?= htmlspecialchars($book->getUser()?->getUsername() ?? 'Utilisateur inconnu') ?>"
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



                        <h3 class="book-title"><?= htmlspecialchars($book->getTitle()) ?></h3>

                        <p class="book-author">
                            <?= htmlspecialchars($book->getAuthor() ?? 'Auteur inconnu') ?>
                        </p>

                        <p class="book-seller">
                            Vendu par :
                            <span>
                                <?= htmlspecialchars($book->getUser()?->getUsername() ?? 'Inconnu') ?>
                            </span>
                        </p>

                    </a>
                <?php endforeach; ?>
            </div>

            <div class="home-books-cta">
                <a href="/books"
                   class="btn btn-secondary btn-large"
                   aria-label="Voir tous les livres disponibles">
                    Voir tous les livres
                </a>
            </div>

        </div>
    </section>


    <!-- SECTION 3 : COMMENT ÇA MARCHE -->
    <section class="home-how-it-works" aria-labelledby="how-title">
        <div class="container">

            <h2 id="how-title">Comment ça marche ?</h2>

            <p class="home-how-description">
                Échanger des livres avec TomTroc c’est simple et amusant !
                Suivez ces étapes pour commencer : </p>

            <div class="home-how-steps" role="list">

                <div class="home-how-step" role="listitem">
                    <p>Inscrivez-vous gratuitement sur notre plateforme.</p>
                </div>

                <div class="home-how-step" role="listitem">
                    <p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
                </div>

                <div class="home-how-step" role="listitem">
                    <p>Parcourez les livres disponibles chez d'autres membres.</p>
                </div>

                <div class="home-how-step" role="listitem">
                    <p>Proposez un échange et discutez avec d'autres passionnés de lecture.</p>
                </div>

            </div>

            <div class="home-books-cta">
                <a href="/books"
                   class="btn btn-outline btn-large"
                   aria-label="Voir tous les livres disponibles">
                    Voir tous les livres
                </a>
            </div>

        </div>
    </section>


    <!-- SECTION 4 : BANDEAU IMAGE -->
    <section class="home-banner" aria-labelledby="banner-title">
        <h2 id="banner-title" class="visually-hidden">Illustration de l'échange de livres</h2>
        <img
            src="/assets/img/bandeau.png"
            alt="Illustration représentant l'échange de livres entre lecteurs"
        >
    </section>


    <!-- SECTION 5 : NOS VALEURS -->
    <section class="home-values" aria-labelledby="values-title">
        <div class="container">

            <h2 id="values-title">Nos valeurs</h2>

            <div class="home-values-content">
                <p>
                   Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. 
                   Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. 
                   Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.
                </p>

                <p>
                    Notre association a été fondée avec une conviction profonde : chaque livre mérite
                    d'être lu et partagé.
                </p>

                <p>
                    Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux
                    lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger
                    des livres qui attendent patiemment sur les étagères.
                </p>
            </div>

            <div class="home-equipe-text">
                <p>L’équipe Tom Troc</p>
            </div>
        </div>

        <div class="home-equipe-icon">
            <img src="/assets/img/coeur.svg" alt="Icône de cœur symbolisant la passion et la communauté" class="equipe-heart">
        </div>
    </section>

</main>

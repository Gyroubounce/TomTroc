<main class="home">

    <!-- SECTION 1 : HERO -->
    <section class="home-hero">
        <div class="container">

            <div class="home-hero-content">

                <div class="home-hero-text">
                    <h1>Rejoignez nos lecteurs passionnés</h1>

                    <p>
                        Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux
                        de la lecture. Nous croyons en la magie du partage de connaissances et
                        d'histoires à travers les livres.
                    </p>

                    <a href="/books" class="btn btn-primary btn-hero">
                        Découvrir
                    </a>
                </div>

                <div class="home-hero-image">
                    <img
                        src="/assets/img/connexion_01.png"
                        alt="Livres et lecture"
                        width="404"
                        height="539"
                    >
                    <p class="hero-credit">Hamza</p>
                </div>

            </div>

        </div>
    </section>


    <!-- SECTION 2 : DERNIERS LIVRES AJOUTÉS -->
    <section class="home-latest-books">
        <div class="container">

            <h2>Les derniers livres ajoutés</h2>

            <div class="books-grid">
                <?php foreach ($books as $book): ?>
                    <a href="/books/<?= $book->id ?>" class="book-card">

                        <?php if (!empty($book->image)): ?>
                            <img
                                src="<?= htmlspecialchars($book->image) ?>"
                                alt="<?= htmlspecialchars($book->title) ?>"
                                class="book-cover"
                            >
                        <?php endif; ?>

                        <h3 class="book-title"><?= htmlspecialchars($book->title) ?></h3>
                        <p class="book-author"><?= htmlspecialchars($book->author) ?></p>
                        <p class="book-seller">
                            Vendu par : <?= htmlspecialchars($book->user->username ?? 'Inconnu') ?>
                        </p>

                    </a>
                <?php endforeach; ?>
            </div>

            <div class="home-books-cta">
                <a href="/books" class="btn btn-secondary btn-large">
                    Voir tous les livres
                </a>
            </div>

        </div>
    </section>


    <!-- SECTION 3 : COMMENT ÇA MARCHE -->
    <section class="home-how-it-works">
        <div class="container">

            <h2>Comment ça marche ?</h2>

            <p class="home-how-description">
                Échanger des livres avec TomTroc c’est simple et amusant !
                Suivez ces étapes pour commencer :
            </p>

            <div class="home-how-steps">

                <div class="home-how-step">
                    <p>Inscrivez-vous gratuitement sur notre plateforme.</p>
                </div>

                <div class="home-how-step">
                    <p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
                </div>

                <div class="home-how-step">
                    <p>Parcourez les livres disponibles chez d'autres membres.</p>
                </div>

                <div class="home-how-step">
                    <p>Proposez un échange et discutez avec d'autres passionnés de lecture.</p>
                </div>

            </div>

            <div class="home-books-cta">
                <a href="/books" class="btn btn-outline btn-large">
                    Voir tous les livres
                </a>
            </div>

        </div>
    </section>


    <!-- SECTION 4 : BANDEAU IMAGE -->
    <section class="home-banner">
        <img
            src="/assets/img/bandeau.png"
            alt="Bandeau illustrant l'échange de livres"
        >
    </section>


    <!-- SECTION 5 : NOS VALEURS -->
    <section class="home-values">
        <div class="container">

            <h2>Nos valeurs</h2>

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
            <img src="/assets/img/coeur.svg" alt="Cœur" class="equipe-heart">
        </div>
    </section>

</main>

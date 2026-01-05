<main class="book-show-body">

    <!-- Lien retour -->
    <a href="/books"
       class="book-back"
       aria-label="Retour à la liste des livres">
        Nos livres > <?= htmlspecialchars($book->getTitle()) ?>
    </a>

    <div class="book-detail">

        <!-- Image du livre -->
        <?php if ($book->getImage()): ?>
            <img src="<?= htmlspecialchars($book->getImage()) ?>" 
                 alt="Couverture du livre <?= htmlspecialchars($book->getTitle()) ?>" 
                 class="book-cover-detail">
        <?php else: ?>
            <img src="/assets/img/default-book.png"
                 alt="Aucune couverture disponible pour <?= htmlspecialchars($book->getTitle()) ?>"
                 class="book-cover-detail">
        <?php endif; ?>

        <div class="book-info">

            <!-- Titre -->
            <h1><?= htmlspecialchars($book->getTitle()) ?></h1>

            <!-- Auteur -->
            <p class="author">
                par <?= htmlspecialchars($book->getAuthor() ?? 'Auteur inconnu') ?>
            </p>

            <hr class="separator" aria-hidden="true">

            <!-- Description -->
            <p class="description-label">Description</p>
            <p class="description-text">
                <?= nl2br(htmlspecialchars($book->getDescription() ?? 'Aucune description disponible.')) ?>
            </p>

            <!-- Statut -->
            <p class="status">
                <strong>Status :</strong>
                <?= htmlspecialchars($book->getStatus()) ?>
            </p>

        <div class="owner">
            <p>Propriétaire</p>

            <div class="owner-info">

              <?php
                $profile = $book->getUser()->getProfile();

                // Si l'image contient déjà un chemin complet, on le garde tel quel
                if ($profile && str_starts_with($profile, '/assets/uploads/profile/')) {
                    $src = $profile;
                } else {
                    // Sinon on construit le chemin complet
                    $src = '/assets/uploads/profile/' . ($profile ?: 'default.png');
                }
                ?>
                <img src="<?= htmlspecialchars($src) ?>"
                    alt="Photo de profil de <?= htmlspecialchars($book->getUser()->getUsername()) ?>"
                    class="owner-photo">


                <?php if ($book->getUser()): ?>
                    <a href="/users/profil/<?= $book->getUser()->getId() ?>"
                    class="owner-name"
                    aria-label="Voir le profil de <?= htmlspecialchars($book->getUser()->getUsername()) ?>">
                        <?= htmlspecialchars($book->getUser()->getUsername()) ?>
                    </a>
                <?php else: ?>
                    <span class="owner-name">Utilisateur inconnu</span>
                <?php endif; ?>

            </div>
        </div>


            <!-- Bouton message -->
        <?php if ($user->getId() !== Session::get('user_id')): ?>
           <a href="/messages?other=<?= $user->getId() ?>" class="btn"
            aria-label="Envoyer un message au propriétaire du livre">
                Envoyer un message
            </a>
        <?php endif; ?>


        </div>
    
    </div>
</main>

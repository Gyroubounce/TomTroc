<main class="profil-main">

  <div class="profil-container">

    <!-- Bloc gauche : infos du propriétaire -->
    <div class="profil-left profil-block">

      <div class="profil-info">

        <!-- Photo de profil -->
        <img src="/assets/uploads/profile/<?= htmlspecialchars($user->getProfile() ?? 'default.png') ?>" 
             alt="Photo de profil de <?= htmlspecialchars($user->getUsername()) ?>"
             class="profil-photo">

        <div class="profil-details">

          <!-- Nom d'utilisateur -->
          <div class="profil-username">
            <?= htmlspecialchars($user->getUsername()) ?>
          </div>

          <!-- Date d'inscription -->
          <div class="profil-member-since">
            Membre depuis <?= date('d/m/Y', strtotime($user->getCreatedAt())) ?>
          </div>

          <!-- Nombre de livres -->
          <div class="profil-section-title">Bibliothèque</div>
          <p><?= count($books) ?> livres</p>

        </div>
      </div>

      <!-- CTA : envoyer un message au propriétaire -->
      <?php if ($user->getId() !== Session::get('user_id')): ?>
        <a href="/messages?other=<?= $user->getId() ?>"
           class="profil-cta"
           aria-label="Envoyer un message à <?= htmlspecialchars($user->getUsername()) ?>">
          Envoyer un message
        </a>
      <?php endif; ?>

    </div>

    <!-- Bloc droit : liste des livres du propriétaire -->
    <div class="profil-right profil-block">

      <table class="profil-table">
        <caption class="visually-hidden">
          Liste des livres appartenant à <?= htmlspecialchars($user->getUsername()) ?>
        </caption>

        <thead>
          <tr>
            <th scope="col">Photo</th>
            <th scope="col">Titre</th>
            <th scope="col">Auteur</th>
            <th scope="col">Description</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($books as $index => $book): ?>
            <tr class="<?= $index % 2 === 0 ? 'row-grey' : '' ?>">

              <!-- Photo du livre -->
              <td>
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
                                class="account-book-pic">
              </td>

              <!-- Titre -->
              <td><?= htmlspecialchars($book->getTitle()) ?></td>

              <!-- Auteur -->
              <td><?= htmlspecialchars($book->getAuthor() ?? 'Auteur inconnu') ?></td>

              <!-- Description -->
              <td>
                <?= htmlspecialchars(mb_strimwidth($book->getDescription() ?? 'Aucune description', 0, 80, '…')) ?>
              </td>


            </tr>
          <?php endforeach; ?>
        </tbody>

      </table>

    </div>

  </div>

</main>

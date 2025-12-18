<main>
  <h1>Profil de <?= htmlspecialchars($user->username) ?></h1>

  <div class="profil-container">
    <!-- Bloc gauche : infos utilisateur -->
    <div class="profil-left profil-block">
      <img src="/assets/uploads/profile/<?= htmlspecialchars($user->profile ?? 'default.png') ?>" 
           alt="Photo de profil" class="profil-photo">
      <div class="profil-username"><?= htmlspecialchars($user->username) ?></div>
      <div class="profil-member-since">Membre depuis <?= date('d/m/Y', strtotime($user->created_at)) ?></div>
      <div class="profil-library">Bibliothèque : <?= count($books) ?> livres</div>

      <!-- CTA pour démarrer une conversation -->
      <a href="/messages/conversation/<?= $user->id ?>" class="profil-cta">Envoyer un message</a>
    </div>

    <!-- Bloc droit : bibliothèque de l’utilisateur -->
    <div class="profil-right profil-block">
      <h2>Ses livres</h2>
      <table class="profil-table">
        <thead>
          <tr>
            <th>Photo</th>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Description</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($books as $index => $book): ?>
          <tr class="<?= $index % 2 === 0 ? 'row-grey' : '' ?>">
            <td><img src="<?= htmlspecialchars($book->image) ?>"
                     alt="<?= htmlspecialchars($book->title) ?>"
                     class="profil-book-pic"></td>
            <td><?= htmlspecialchars($book->title) ?></td>
            <td><?= htmlspecialchars($book->author) ?></td>
            <td><?= htmlspecialchars($book->description) ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

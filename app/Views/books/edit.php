<main class="edit-body">
  <a href="/mon-compte" class="edit-back"> ← Retour </a>
  <h1 class="edit-title">Modifier les informations</h1>

  <div class="edit-container">

    <!-- Bloc gauche : image -->
    <div class="edit-left edit-block">
        <p>Photo</p>

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
              class="edit-cover-detail">


        <a href="#" 
          class="edit-photo-link"
          id="trigger-book-file"
          aria-label="Modifier la photo du livre">
          Modifier la photo
        </a>

        <!-- Formulaire invisible -->
        <form id="book-photo-form"
              action="/books/update-image/<?= $book->getId() ?>"
              method="post"
              enctype="multipart/form-data"
              class="hidden">

            <input type="file"
                  id="book-image-input"
                  name="image"
                  accept="image/jpeg,image/png">
        </form>
    </div>


    <!-- Bloc droit : formulaire -->
    <div class="edit-right edit-block">

      <form action="/books/update/<?= $book->getId() ?>" 
            method="post" 
            class="edit-form">

        <label for="title">Titre</label>
        <input type="text" id="title" name="title"
               value="<?= htmlspecialchars($book->getTitle()) ?>" required>

        <label for="author">Auteur</label>
        <input type="text" id="author" name="author"
               value="<?= htmlspecialchars($book->getAuthor()) ?>" required>

        <label for="description">Commentaire</label>
        <textarea id="description" name="description"><?= htmlspecialchars($book->getDescription()) ?></textarea>

        <label for="status">Disponibilité</label>
        <select id="status" name="status">
          <option value="disponible" <?= $book->getStatus() === 'disponible' ? 'selected' : '' ?>>
            Disponible
          </option>
          <option value="non dispo" <?= $book->getStatus() === 'non dispo' ? 'selected' : '' ?>>
            Non disponible
          </option>
        </select>

        <button type="submit" class="edit-submit btn">Valider</button>
      </form>

    </div>

  </div>
  <script src="/assets/js/app.js"></script>
</main>

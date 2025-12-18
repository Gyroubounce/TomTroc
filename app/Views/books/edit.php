<main class="account-body">
  <h1 class="account-title">Éditer le livre</h1>

  <div class="edit-container">
    <!-- Bloc gauche : image -->
    <div class="edit-left edit-block">
      <img src="<?= htmlspecialchars($book->image) ?>" 
                alt="<?= htmlspecialchars($book->title) ?>" 
                class="book-cover-detail">
    </div>

    <!-- Bloc droit : formulaire -->
    <div class="edit-right edit-block">
      <form action="/books/update/<?= $book->id ?>" method="post" class="edit-form">
        
        <label for="title">Titre</label>
        <input type="text" id="title" name="title" 
               value="<?= htmlspecialchars($book->title) ?>" required>

        <label for="author">Auteur</label>
        <input type="text" id="author" name="author" 
               value="<?= htmlspecialchars($book->author) ?>" required>

        <label for="description">Commentaire</label>
        <textarea id="description" name="description"><?= htmlspecialchars($book->description) ?></textarea>

        <label for="status">Disponibilité</label>
        <select id="status" name="status">
          <option value="disponible" <?= $book->status === 'disponible' ? 'selected' : '' ?>>Disponible</option>
          <option value="indisponible" <?= $book->status === 'indisponible' ? 'selected' : '' ?>>Indisponible</option>
        </select>

        <button type="submit" class="edit-submit">Valider</button>
      </form>
    </div>
  </div>
</main>
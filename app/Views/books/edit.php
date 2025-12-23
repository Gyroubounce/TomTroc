<main class="edit-body">
  <a href="/mon-compte" class="edit-back"> ← Retour </a>
  <h1 class="edit-title">Modifier les informations</h1>

  <div class="edit-container">
    <!-- Bloc gauche : image -->
    <div class="edit-left edit-block">
      <p>photo</p>
      <img src="<?= htmlspecialchars($book->image) ?>" 
                alt="<?= htmlspecialchars($book->title) ?>" 
                class="edit-cover-detail">
      <a href="/books/edit-image/<?= $book->id ?>" class="edit-photo-link"> Modifier la photo </a>
                
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

        <button type="submit" class="edit-submit btn">Valider</button>
      </form>
    </div>
  </div>
</main>
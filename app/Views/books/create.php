<main class="edit-body">
  <a href="/mon-compte" class="edit-back"> ← Retour </a>
  <h1 class="edit-title">Ajouter un livre</h1>

  <div class="edit-container">

    <!-- Bloc gauche : image -->
    <div class="edit-left edit-block">
        <p>Photo</p>

        <!-- Image par défaut -->
        <img src="/assets/img/default-book.png"
             alt="Aucune couverture"
             class="edit-cover-detail">

        <!-- Bouton pour choisir une image -->
        <label for="book-image-input"
               class="edit-photo-link"
               aria-label="Ajouter une photo de couverture">
            Ajouter une photo
        </label>

        <!-- Input file (sera envoyé avec le formulaire principal) -->
        <input type="file"
               id="book-image-input"
               name="image"
               accept="image/jpeg,image/png"
               form="create-book-form"
               class="hidden">
    </div>


    <!-- Bloc droit : formulaire -->
    <div class="edit-right edit-block">

      <form id="create-book-form"
            action="/books/store"
            method="post"
            enctype="multipart/form-data"
            class="edit-form">

        <label for="title">Titre</label>
        <input type="text" id="title" name="title" required>

        <label for="author">Auteur</label>
        <input type="text" id="author" name="author" required>

        <label for="description">Commentaire</label>
        <textarea id="description" name="description"></textarea>

        <!-- Status par défaut -->
        <input type="hidden" name="status" value="disponible">

        <button type="submit" class="edit-submit btn">Créer le livre</button>
      </form>

    </div>

  </div>

  <script src="/assets/js/app.js"></script>
</main>

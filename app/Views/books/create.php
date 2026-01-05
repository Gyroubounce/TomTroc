<main class="create-body">

  <a href="/mon-compte" class="create-back"> ← Retour </a>
  <h1 class="create-title">Ajouter un livre</h1>

  <div class="create-container">

    <!-- Bloc gauche : image -->
    <div class="create-left">

        <p>Photo</p>

        <!-- Image preview (cachée au départ) -->
        <img id="preview-image"
             src=""
             alt="Aperçu de la couverture"
             class="create-cover-detail hidden">

        <!-- Placeholder avant sélection -->
        <div id="no-image" class="create-cover-detail empty-cover">
            Aucune image sélectionnée
        </div>

        <!-- Bouton pour choisir une image -->
        <label for="book-image-input"
               class="create-photo-link"
               aria-label="Ajouter une photo de couverture">
            Ajouter une photo
        </label>

        <!-- Input file -->
        <input type="file"
               id="book-image-input"
               name="image"
               accept="image/jpeg,image/png"
               form="create-book-form"
               class="hidden">

    </div>

    <!-- Bloc droit : formulaire -->
    <div class="create-right">

      <form id="create-book-form"
            action="/books/store"
            method="post"
            enctype="multipart/form-data"
            class="create-form">

        <label for="title">Titre</label>
        <input type="text" id="title" name="title" required>

        <label for="author">Auteur</label>
        <input type="text" id="author" name="author" required>

        <label for="description">Commentaire</label>
        <textarea id="description" name="description"></textarea>

        <input type="hidden" name="status" value="disponible">

        <button type="submit" class="create-submit btn">Créer le livre</button>

      </form>

    </div>

  </div>

  <script src="/assets/js/app.js"></script>

</main>

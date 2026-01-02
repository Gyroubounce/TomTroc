<main class="account-body">

    <h1 class="account-title">Mon compte</h1>

    <p>
        Bienvenue,
        <?= htmlspecialchars($user->getUsername()) ?> !
    </p>

    <!-- SECTION 1 : Infos utilisateur -->
    <section class="account-container" aria-labelledby="account-title">

    <h2 id="account-title" class="visually-hidden">
        Informations du compte utilisateur
    </h2>


        <!-- Bloc gauche -->
        <div class="account-left account-block">

           <div class="account-top">

                <img src="/assets/uploads/profile/<?= htmlspecialchars($user->getProfile() ?? 'default.png') ?>" 
                    alt="Photo de profil de <?= htmlspecialchars($user->getUsername()) ?>"
                    class="account-profile-pic">

                <a href="#" 
                class="account-edit-link"
                id="trigger-file"
                aria-label="Modifier la photo de profil">
                    Modifier
                </a>

                <!-- Formulaire invisible -->
                <form id="photo-form"
                    action="/users/update/<?= $user->getId() ?>"
                    method="post"
                    enctype="multipart/form-data"
                    class="hidden">

                    <input type="file"
                        id="profile-input"
                        name="profile"
                        accept="image/jpeg,image/png"
                        title="Importer une photo de profil">
                </form>

            </div>


            <div class="account-info">
                <div class="account-username">
                    <?= htmlspecialchars($user->getUsername()) ?>
                </div>

                <div class="account-member-since">
                    Membre depuis
                    <?= date('d/m/Y', strtotime($user->getCreatedAt())) ?>
                </div>

                <div class="account-section-title">Bibliothèque</div>
                <p><?= count($books) ?> livres</p>
            </div>

            <div class="account-add-book">
                <a href="/books/create" class="btn-add-book">
                    + Ajouter un livre
                </a>
            </div>


        </div>

        <!-- Bloc droit -->
        <div class="account-right account-block">

            <form action="/users/update/<?= $user->getId() ?>"
                  method="post"
                  class="account-form"
                  aria-labelledby="personal-info-title">

                <div id="personal-info-title" class="account-form-title">
                    Vos informations personnelles
                </div>

                <label for="email-input">Email</label>
                <input id="email-input"
                       type="email"
                       name="email"
                       value="<?= htmlspecialchars($user->getEmail()) ?>">

                <label for="password-input">Mot de passe</label>
                <input id="password-input"
                       type="password"
                       name="password"
                       placeholder="••••••••">

                <label for="username-input">Pseudo</label>
                <input id="username-input"
                       type="text"
                       name="username"
                       value="<?= htmlspecialchars($user->getUsername()) ?>">

                <button type="submit">Enregistrer</button>

            </form>

        </div>

    </section>

    <!-- SECTION 2 : Tableau des livres -->
    <section class="account-books account-block-section"
             aria-labelledby="books-table-title">

        <h2 id="books-table-title" class="visually-hidden">
            Tableau des livres de l’utilisateur
        </h2>

        <table class="account-table">
            <caption class="visually-hidden">
                Liste des livres appartenant à <?= htmlspecialchars($user->getUsername()) ?>
            </caption>

            <thead>
                <tr>
                    <th scope="col">Photo</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Auteur</th>
                    <th scope="col">Description</th>
                    <th scope="col">Disponibilité</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($books as $book): ?>
                <tr>

                    <!-- Photo -->
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


                    <!-- Disponibilité -->
                    <td>
                        <?php if ($book->getStatus() === 'disponible'): ?>
                            <span class="account-status account-available">Disponible</span>
                        <?php else: ?>
                            <span class="account-status account-unavailable">Non disponible</span>
                        <?php endif; ?>
                    </td>

                    <!-- Actions -->
                    <td class="account-action-links">
                        <a href="/books/edit/<?= $book->getId() ?>"
                           class="edit"
                           aria-label="Éditer le livre <?= htmlspecialchars($book->getTitle()) ?>">
                            Éditer
                        </a>

                        <a href="/books/delete/<?= $book->getId() ?>"
                           class="supprimer"
                           aria-label="Supprimer le livre <?= htmlspecialchars($book->getTitle()) ?>">
                            Supprimer
                        </a>
                    </td>

                </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

    </section>
<script src="/assets/js/app.js"></script>

</main>

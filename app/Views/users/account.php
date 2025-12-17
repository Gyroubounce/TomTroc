<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mon compte</title>
  <link rel="stylesheet" href="/assets/css/account.css">
</head>
<body class="account-body">
  <h1 class="account-title">Mon compte</h1>
  <p>Bienvenue, <?= htmlspecialchars($user->username) ?> !</p>
  <div class="account-container">
    <!-- Bloc gauche -->
    <div class="account-left account-block">
        <img src="/assets/uploads/profile/<?= htmlspecialchars($user->profile ?? 'default.png') ?>" 
            alt="Photo de profil" class="account-profile-pic">
        <a href="/users/edit/<?= $user->id ?>" class="account-edit-link">Modifier</a>
        <div class="account-username"><?= htmlspecialchars($user->username) ?></div>
        <div class="account-member-since">Membre depuis <?= date('d/m/Y', strtotime($user->created_at)) ?></div>
        <div class="account-section-title">Bibliothèque</div>
        <p><?= count($books) ?> livres</p>
    </div>

    <!-- Bloc droit -->
    <div class="account-right account-block">
        <div class="account-section-title">Vos informations personnelles</div>
            <form action="/users/update/<?= $user->id ?>" method="post" class="account-form">
                <label>Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user->email) ?>">

                <label>Mot de passe</label>
                <input type="password" name="password" placeholder="••••••••">

                <label>Pseudo</label>
                <input type="text" name="username" value="<?= htmlspecialchars($user->username) ?>">

                <button type="submit">Enregistrer</button>
            </form>
        </div>    
    </div>
    <!-- Bloc du bas : livres -->
    <div class="account-books account-block">
        <div class="account-section-title">Vos livres</div>
        <table class="account-table">
            <thead>
            <tr>
                <th>Photo</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Description</th>
                <th>Disponibilité</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($books as $book): ?>
            <tr>
                <td><img src="<?= htmlspecialchars($book->image) ?>"
                            alt="<?= htmlspecialchars($book->title) ?>"
                            class="account-book-pic"></td>
                <td><?= htmlspecialchars($book->title) ?></td>
                <td><?= htmlspecialchars($book->author) ?></td>
                <td><?= htmlspecialchars($book->description) ?></td>
                <td>
                <?php if ($book->status === 'disponible'): ?>
                    <span class="account-status account-available">Disponible</span>
                <?php else: ?>
                    <span class="account-status account-unavailable">Non disponible</span>
                <?php endif; ?>
                </td>
                <td class="account-action-links">
                <a href="/books/edit/<?= $book->id ?>">Éditer</a>
                <a href="/books/delete/<?= $book->id ?>">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>

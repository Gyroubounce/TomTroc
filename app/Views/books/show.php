<h1><?= htmlspecialchars($book->title) ?></h1>
    <p><strong>Auteur :</strong> <?= htmlspecialchars($book->author) ?></p>
    <p><strong>Description :</strong> <?= nl2br(htmlspecialchars($book->description)) ?></p>
    <p><strong>Status :</strong> <?= htmlspecialchars($book->status) ?></p>

    <?php if ($book->image): ?>
        <img src="/uploads/<?= htmlspecialchars($book->image) ?>" alt="<?= htmlspecialchars($book->title) ?>">
    <?php endif; ?>

    <a href="/books" class="btn">Retour à la liste des livres</a>
<h1>Liste des livres</h1>
<ul>
<?php foreach ($books as $book): ?>
    <li>
        <a href="/books/<?= $book->id ?>">
            <?= htmlspecialchars($book->title) ?> - <?= htmlspecialchars($book->author) ?>
        </a>
    </li>
<?php endforeach; ?>
</ul>

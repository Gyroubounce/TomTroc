<main>
    <div class="book-detail">
        <?php if ($book->image): ?>
            <img src="<?= htmlspecialchars($book->image) ?>" 
                alt="<?= htmlspecialchars($book->title) ?>" 
                class="book-cover-detail">
        <?php endif; ?>

        <div class="book-info">
            <h1><?= htmlspecialchars($book->title) ?></h1>
            <p class="author">par <?= htmlspecialchars($book->author) ?></p>

            <hr class="separator">

            <p class="description-label">Description</p>
            <p class="description-text"><?= nl2br(htmlspecialchars($book->description)) ?></p>

            <p class="status"><strong>Status :</strong> <?= htmlspecialchars($book->status) ?></p>

            <div class="owner">
            <p>Propriétaire :</p>
            <?php if ($user && $user->profile): ?>
                <img src="/assets/uploads/profile/<?= htmlspecialchars($user->profile) ?>" 
                    alt="<?= htmlspecialchars($user->username) ?>" 
                    class="owner-photo">
            <?php endif; ?>
            <a href="/users/profil/<?= $book->user_id ?>"><?= htmlspecialchars($book->user->username ?? 'Inconnu') ?></a>


        </div>

            <a href="/messages/conversation/<?= $user->id ?>" class="btn">Envoyer un message</a>
        </div>
    </div>
</main>

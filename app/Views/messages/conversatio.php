<?php
/** @var object $otherUser */
/** @var array $messages */
/** @var int $userId */
?>

<div class="conversation-page">

    <header class="conversation-header">
        <a href="/messages" class="back-btn">← Retour</a>

        <div class="user-info">
            <img src="<?= htmlspecialchars($otherUser->getProfile() ?? '/assets/img/default.png') ?>" 
                 alt="Profil" 
                 class="profile-pic">

            <h2><?= htmlspecialchars($otherUser->getUsername()) ?></h2>
        </div>
    </header>

    <div class="messages-container">

        <?php if (empty($messages)): ?>
            <p class="no-messages">Aucun message pour le moment. Commence la conversation !</p>
        <?php endif; ?>

        <?php foreach ($messages as $msg): ?>
            <div class="message <?= $msg->sender_id == $userId ? 'sent' : 'received' ?>">
                <div class="message-content">
                    <?= nl2br(htmlspecialchars($msg->content)) ?>
                </div>
                <div class="message-time">
                    <?= date('d/m/Y H:i', strtotime($msg->created_at)) ?>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

    <form action="/messages/send/<?= $otherUser->getId() ?>" method="POST" class="message-form">
        <textarea name="content" placeholder="Écris ton message..." required></textarea>
        <button type="submit">Envoyer</button>
    </form>

</div>

<main class="conversation-container">
  <h2>Conversation avec <?= htmlspecialchars($otherUser->username) ?></h2>

  <div class="discussion-thread">
    <?php foreach ($messages as $message): ?>
      <div class="discussion-message <?= $message->sender_id === $user->id ? 'sent' : 'received' ?>">
        <p><?= htmlspecialchars($message->content) ?></p>
        <span class="discussion-date"><?= date('d/m/Y H:i', strtotime($message->created_at)) ?></span>
      </div>
    <?php endforeach; ?>
  </div>

  <form action="/messages/send/<?= $otherUser->id ?>" method="post" class="discussion-form">
    <textarea name="content" placeholder="Écrire un message..." required></textarea>
    <button type="submit">Envoyer</button>
  </form>
</main>

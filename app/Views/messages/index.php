<main class="messagerie-container">
  <!-- Bloc gauche -->
  <div class="messagerie-left messagerie-block">
    <h2>Messagerie</h2>
    <div class="conversation-list">
      <?php foreach ($conversations as $conv): ?>
        <div class="conversation-card" 
             onclick="window.location='/messages?conversation=<?= $conv->other_user_id ?>'">
          <img src="/assets/uploads/profile/<?= htmlspecialchars($conv->other_profile ?? 'default.png') ?>" 
               alt="<?= htmlspecialchars($conv->other_username) ?>" 
               class="conversation-photo">
          <div class="conversation-info">
            <div class="conversation-header">
              <span class="conversation-username"><?= htmlspecialchars($conv->other_username) ?></span>
              <span class="conversation-date"><?= date('d/m/Y H:i', strtotime($conv->created_at)) ?></span>
            </div>
            <p class="conversation-preview"><?= htmlspecialchars(substr($conv->content, 0, 40)) ?>...</p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Bloc droit -->
  <div class="messagerie-right messagerie-block">
    <?php if (isset($messages)): ?>
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
    <?php else: ?>
      <p>Sélectionnez une conversation à gauche pour commencer.</p>
    <?php endif; ?>
  </div>
</main>

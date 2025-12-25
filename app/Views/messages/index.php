<main role="main">

  <div class="messagerie-container">

    <!-- Colonne gauche : liste des conversations -->
    <aside class="messagerie-left" aria-label="Liste des conversations">

      <header>
        <h2>Messagerie</h2>
      </header>

      <nav class="conversation-list" aria-label="Conversations">
        <?php foreach ($conversations as $conv): ?>

          <article class="conversation-card"
                   role="button"
                   tabindex="0"
                   aria-label="Ouvrir la conversation avec <?= htmlspecialchars($conv->other_username) ?>"
                   onclick="window.location='/messages?conversation=<?= $conv->other_user_id ?>'">

            <img src="/assets/uploads/profile/<?= htmlspecialchars($conv->other_profile ?? 'default.png') ?>"
                 alt="Photo de profil de <?= htmlspecialchars($conv->other_username) ?>"
                 class="conversation-photo">

            <div class="conversation-info">
              <header class="conversation-header">
                <span class="conversation-username"><?= htmlspecialchars($conv->other_username) ?></span>
                <time class="conversation-date" datetime="<?= date('c', strtotime($conv->created_at)) ?>">
                  <?= date('d/m/Y H:i', strtotime($conv->created_at)) ?>
                </time>
              </header>

              <p class="conversation-preview">
                <?= htmlspecialchars(substr($conv->content, 0, 40)) ?>…
              </p>
            </div>

          </article>

        <?php endforeach; ?>
      </nav>

    </aside>


    <!-- Colonne droite : discussion -->
    <section class="messagerie-right" aria-label="Discussion en cours">

      <?php if (isset($messages)): ?>

        <section class="discussion-thread" aria-live="polite">
          <?php foreach ($messages as $message): ?>

            <article class="discussion-message <?= $message->sender_id === $user->id ? 'sent' : 'received' ?>"
                     aria-label="<?= $message->sender_id === $user->id ? 'Message envoyé' : 'Message reçu' ?>">

              <p><?= htmlspecialchars($message->content) ?></p>

              <time class="discussion-date" datetime="<?= date('c', strtotime($message->created_at)) ?>">
                <?= date('d/m/Y H:i', strtotime($message->created_at)) ?>
              </time>

            </article>

          <?php endforeach; ?>
        </section>

        <form action="/messages/send-to/<?= $otherUser->id ?>"
              method="post"
              class="discussion-form"
              aria-label="Formulaire d’envoi de message">

          <label for="message-content" class="visually-hidden">Votre message</label>
          <textarea id="message-content"
                    name="content"
                    placeholder="Tapez votre message ici"
                    required></textarea>

          <button type="submit" class="btn">Envoyer</button>
        </form>

      <?php else: ?>

        <p aria-live="polite">Sélectionnez une conversation à gauche pour commencer.</p>

      <?php endif; ?>

    </section>

  </div>

</main>

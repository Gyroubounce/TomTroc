<main class="messagerie-main">

  <div class="messagerie-container">

    <!-- Colonne gauche : liste des conversations -->
    <aside class="messagerie-left" aria-label="Liste des conversations">

      <header>
        <h1>Messagerie</h1>
      </header>

      <nav class="conversation-list" aria-label="Conversations">
        <?php foreach ($conversations as $conv): ?>

          <article class="conversation-card"
                   tabindex="0"
                   aria-label="Ouvrir la conversation avec <?= htmlspecialchars($conv->other_username) ?>"
                   onclick="window.location='/messages?other=<?= $conv->other_user_id ?>'">

            <?php
              $profile = $conv->other_profile;

              // Si l'image contient déjà un chemin complet
              if ($profile && str_starts_with($profile, '/assets/uploads/profile/')) {
                  $src = $profile;
              } else {
                  $src = '/assets/uploads/profile/' . ($profile ?: 'default.png');
              }
            ?>
              <img src="<?= htmlspecialchars($src) ?>"
                  alt="Photo de profil de <?= htmlspecialchars($conv->other_username) ?>"
                  class="conversation-photo">


            <div class="conversation-info">
              <header class="conversation-header">
                <span class="conversation-username"><?= htmlspecialchars($conv->other_username) ?></span>
                <time class="conversation-date" datetime="<?= date('c', strtotime($conv->created_at)) ?>">
                  <?= date('d.m.Y H:i', strtotime($conv->created_at)) ?>
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


    
      <?php if (!$otherUser): ?>

        <!-- 🔥 Aucune conversation sélectionnée -->
        <p aria-live="polite">Pas de messages sélectionnés.</p>

      <?php else: ?>

        <!-- 🔥 En-tête de la conversation -->
        <header class="discussion-top-header">

           <?php
              $profile = $otherUser->getProfile();

              // Si l'image contient déjà un chemin complet
              if ($profile && str_starts_with($profile, '/assets/uploads/profile/')) {
                  $src = $profile;
              } else {
                  $src = '/assets/uploads/profile/' . ($profile ?: 'default.png');
              }
            ?>
              <img src="<?= htmlspecialchars($src) ?>"
                  alt="Photo de profil de <?= htmlspecialchars($otherUser->getUsername()) ?>"
                  class="discussion-top-photo">


            <span class="discussion-top-name">
                <?= htmlspecialchars($otherUser->getUsername()) ?>
            </span>

        </header>




          <!-- 🔥 Affichage des messages -->
          <section class="discussion-thread" aria-live="polite">
            <?php foreach ($messages as $message): ?>

              <article class="discussion-message <?= $message->sender_id === $currentUser->getId() ? 'sent' : 'received' ?>">

                <div class="message-header">

                    <?php if ($message->sender_id !== $currentUser->getId()): ?>
                          <?php
                            $profile = $otherUser->getProfile();

                            // Si l'image contient déjà un chemin complet
                            if ($profile && str_starts_with($profile, '/assets/uploads/profile/')) {
                                $src = $profile;
                            } else {
                                $src = '/assets/uploads/profile/' . ($profile ?: 'default.png');
                            }
                          ?>
                            <img src="<?= htmlspecialchars($src) ?>"
                                alt="Photo de profil de <?= htmlspecialchars($otherUser->getUsername()) ?>"
                                class="discussion-profile">
                    <?php endif; ?>

                    <div class="discussion-meta">
                      <span class="discussion-date"><?= date('d.m', strtotime($message->created_at)) ?></span>
                      <span class="discussion-time"><?= date('H:i', strtotime($message->created_at)) ?></span>
                    </div>

                </div>

                <p class="discussion-content"><?= htmlspecialchars($message->content) ?></p>

              </article>

            <?php endforeach; ?>
          </section>

   


        <!-- 🔥 Formulaire d’envoi -->
        <form action="/messages/send-to/<?= $otherUser->getId() ?>"
              method="post"
              class="discussion-form"
              aria-label="Formulaire d’envoi de message">

          <label for="message-content" class="visually-hidden">Votre message</label>
          <input id="message-content"
                 name="content"
                 placeholder="Tapez votre message ici"
                 required>

          <button type="submit" class="btn">Envoyer</button>
        </form>

      <?php endif; ?>

    </section>

  </div>

</main>

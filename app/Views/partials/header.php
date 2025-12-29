<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>TomTroc</title>
  <link rel="stylesheet" href="/assets/scss/main.css">
</head>
<body>
<header class="site-header">
  <div class="header-container">

    <div class="left-block">
      <div class="logo"></div>
      <nav class="main-nav">
        <ul>
          <li><a href="/">Accueil</a></li>
          <li><a href="/books">Nos livres à l’échange</a></li>
        </ul>
      </nav>
    </div>

    <nav class="user-nav">
      <ul>

          <li>
              <a href="/messages" class="messages-menu__btn">
                  <img src="/assets/img/icon-messagerie.png" alt="Messagerie" class="messages-menu__icon">
                  Messagerie

                  <?php if (Session::has('user_id')): ?>
                      <?php
                          $userId = Session::get('user_id');
                          $messageManager = new MessageManager();
                          $unreadCount = $messageManager->countUnreadMessages($userId);
                      ?>

                      <?php if ($unreadCount > 0): ?>
                          <span class="messages-menu__badge"><?= $unreadCount ?></span>
                      <?php endif; ?>
                  <?php endif; ?>

              </a>
          </li>

          <li>
              <a href="/mon-compte" class="messages-menu__btn">
                  <img src="/assets/img/icon-mon-compte.png" alt="Mon compte" class="messages-menu__icon">
                  Mon compte
              </a>
          </li>

          <?php if (Session::has('user_id')): ?>

              <?php $currentUser = (new UserManager())->findById(Session::get('user_id')); ?>

              <li><a href="/logout">Déconnexion</a></li>

              <!-- ✔️ Correction ici : utilisation du getter -->
              <li><span>Bienvenue, <?= htmlspecialchars($currentUser->getUsername()) ?></span></li>

          <?php else: ?>

              <li><a href="/inscription">Connexion</a></li>

          <?php endif; ?>

      </ul>
    </nav>

  </div>
</header>

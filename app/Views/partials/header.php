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

    <!-- Bloc gauche : logo + navigation -->
    <div class="left-block">
      <div class="logo"></div>

      <nav class="main-nav">
        <ul>
          <li><a href="/">Accueil</a></li>
          <li><a href="/books">Nos livres à l’échange</a></li>
        </ul>
      </nav>
    </div>

    <!-- Bloc droit : navigation utilisateur -->
    <nav class="user-nav">
      <ul>

        <?php
            $currentUser = null;

            if (Session::has('user_id')) {
                $currentUser = (new UserManager())->findById(Session::get('user_id'));
            }

            // Si non connecté → redirection vers /connexion
            $messagesLink = $currentUser ? "/messages" : "/connexion";
            $accountLink  = $currentUser ? "/mon-compte" : "/connexion";
        ?>

        <!-- Messagerie -->
        <li>
          <a href="<?= $messagesLink ?>" class="messages-menu__btn">
            <img src="/assets/img/icon-messagerie.png" alt="Messagerie" class="messages-menu__icon">
            Messagerie

            <?php if ($currentUser): ?>
                <?php
                    $messageManager = new MessageManager();
                    $unreadCount = $messageManager->countUnreadMessages($currentUser->getId());
                ?>

                <?php if ($unreadCount > 0): ?>
                    <span class="messages-menu__badge"><?= $unreadCount ?></span>
                <?php endif; ?>
            <?php endif; ?>

          </a>
        </li>

        <!-- Mon compte -->
        <li>
          <a href="<?= $accountLink ?>" class="messages-menu__btn">
            <img src="/assets/img/icon-mon-compte.png" alt="Mon compte" class="messages-menu__icon">
            Mon compte
          </a>
        </li>

        <!-- Connexion / Déconnexion + Bienvenue -->
        <?php if ($currentUser): ?>

            <li><a href="/logout">Déconnexion</a></li>
            <li><span>Bienvenue, <?= htmlspecialchars($currentUser->getUsername()) ?></span></li>

        <?php else: ?>

            <li><a href="/inscription">Connexion</a></li>

        <?php endif; ?>

      </ul>
    </nav>

  </div>
</header>

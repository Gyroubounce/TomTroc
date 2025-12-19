<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>TomTroc</title>
  <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body>
<header class="site-header">
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
      <li><a href="/messages">Messagerie</a></li>
      <li><a href="/mon-compte">Mon compte</a></li>
        <?php if (Session::has('user_id')): ?>
      <!-- Utilisateur connecté -->
      <li><a href="/logout">Déconnexion</a></li>
      <?php $user = (new UserManager())->findById(Session::get('user_id')); ?>
      <span>Bienvenue, <?= htmlspecialchars($user->username) ?></span>
    <?php else: ?>
      <!-- Utilisateur non connecté -->
      <li><a href="/inscription">Connexion</a></li>
    <?php endif; ?>
    </ul>
  </nav>
</header>



<main>

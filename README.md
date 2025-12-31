TomTroc 📚
Application web MVC en PHP/MySQL.
Ce document explique comment déployer TomTroc sur un serveur de production.

🚀 Déploiement
1. Transférer le projet
Copiez le dossier TomTroc sur votre serveur (via Git, FTP ou SSH).
Assurez‑vous que la racine publique du site pointe vers le dossier /public.

2. Configurer le serveur web
Apache
Définir le DocumentRoot sur /public

Activer mod_rewrite

Vérifier que .htaccess est pris en compte

Nginx
Pointer root vers /public

Activer la réécriture vers index.php pour toutes les routes

3. Créer le fichier de configuration
Dans /config/config.php (non versionné), renseignez :

les identifiants de connexion MySQL

l’URL du site (ex : https://tomtroc.mondomaine.com)

le mode d’environnement (production)

désactivez le debug (debug => false)

Exemple :

php
'app' => [
    'base_url' => 'https://tomtroc.mondomaine.com',
    'env' => 'production',
    'debug' => false
]
4. Installer la base de données
Exécutez les scripts SQL présents dans /data/sql/ :

001_create_database.sql → crée les tables

002_seed_data.sql → insère les données de test

(optionnel) 003_update_descriptions.sql → met à jour les descriptions

Vous pouvez les exécuter via phpMyAdmin, Adminer ou la ligne de commande MySQL.

5. Vérifier les permissions
Le serveur doit pouvoir écrire dans :

/public/assets/uploads/books/

/public/assets/uploads/profiles/

Droits recommandés : 775 (ou 755 selon configuration).

6. Lancer l’application
Accédez à votre domaine :

👉 https://tomtroc.mondomaine.com

Si tout est correctement configuré, l’application est opérationnelle.

7. (Optionnel) Réinstallation automatique
Lors du premier accès, TomTroc peut initialiser la base via Installer.php.
Si vous souhaitez forcer une réinstallation, supprimez les tables existantes avant de recharger la page.
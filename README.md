TomTroc 📚
Application web MVC en PHP/MySQL. Ce document explique comment déployer TomTroc sur un serveur.

🚀 Déploiement
Transférer le projet Copier le dossier TomTroc sur votre serveur (via Git, FTP ou SSH).

Configurer le serveur web Pointer le domaine ou sous-domaine vers le dossier public/ du projet.

Créer le fichier de configuration Dans /config/config.php (non versionné), définir vos paramètres de connexion à la base de données et l’URL du site.

Installer la base de données Exécuter les scripts SQL présents dans /data/sql/ pour créer les tables et insérer les données de test.

Lancer l’application Accéder à votre domaine, l’application est prête.
https://tomtroc.mondomaine.com
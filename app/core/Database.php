<?php

class Database {
    private static ?PDO $instance = null;

    /**
     * Retourne une instance PDO unique (Singleton)
     */
    public static function getConnection(): PDO
    {
        if (self::$instance === null) {

            $configPath = __DIR__ . '/../../config/config.php';

            if (!file_exists($configPath)) {
                throw new Exception('Fichier config.php introuvable. Placez-le dans /config et ne le versionnez pas.');
            }

            $config = require $configPath;
            $db = $config['db'];

            // Construction du DSN
            $dsn = sprintf(
                "mysql:host=%s;dbname=%s;charset=%s",
                $db['host'],
                $db['name'],
                $db['charset']
            );

            try {
                self::$instance = new PDO($dsn, $db['user'], $db['pass'], [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false, // Sécurité renforcée
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4", // Encodage garanti
                ]);

            } catch (PDOException $e) {
                error_log("Erreur de connexion à la base : " . $e->getMessage());
                throw new Exception("Impossible de se connecter à la base de données.");
            }
        }

        return self::$instance;
    }
}

<?php

class Installer {

    public static function run(): void
    {
        $pdo = Database::getConnection();

        // Vérifie si toutes les tables nécessaires existent
        if (self::isAlreadyInstalled($pdo)) {
            return;
        }

        $sqlFiles = [
            __DIR__ . '/../../data/sql/001_create_database.sql',
            __DIR__ . '/../../data/sql/002_seed_data.sql'
        ];

        foreach ($sqlFiles as $file) {
            self::executeSqlFile($file, $pdo);
        }
    }

    private static function isAlreadyInstalled(PDO $pdo): bool
    {
        $requiredTables = ['users', 'books', 'messages'];

        foreach ($requiredTables as $table) {
            $stmt = $pdo->query("SHOW TABLES LIKE '$table'");
            if (!$stmt || $stmt->rowCount() === 0) {
                return false; // Une table manque → installation nécessaire
            }
        }

        return true; // Toutes les tables existent
    }

    private static function executeSqlFile(string $file, PDO $pdo): void
    {
        if (!file_exists($file)) {
            error_log("Fichier SQL introuvable : $file");
            return;
        }

        $sql = file_get_contents($file);

        // Découpage simple et robuste
        $queries = array_filter(array_map('trim', explode(';', $sql)));

        foreach ($queries as $query) {
            if (!empty($query)) {
                try {
                    $pdo->exec($query);
                } catch (PDOException $e) {
                    error_log("Erreur SQL dans $file : " . $e->getMessage());
                }
            }
        }
    }
}

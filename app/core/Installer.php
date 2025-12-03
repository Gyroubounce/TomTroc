<?php
class Installer {
    public static function run() {
        $pdo = Database::getConnection();

        // Vérifie si la table users existe déjà
        $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
        if ($stmt->rowCount() > 0) {
            return; // Base déjà initialisée, on ne fait rien
        }

        // Exécute les scripts SQL
        self::executeSqlFile(__DIR__ . '/../../data/sql/001_create_database.sql', $pdo);
        self::executeSqlFile(__DIR__ . '/../../data/sql/002_seed_data.sql', $pdo);
    }

    private static function executeSqlFile($file, $pdo) {
        $sql = file_get_contents($file);
        $queries = array_filter(array_map('trim', explode(';', $sql)));

        foreach ($queries as $query) {
            if (!empty($query)) {
                $pdo->exec($query);
            }
        }
    }
}

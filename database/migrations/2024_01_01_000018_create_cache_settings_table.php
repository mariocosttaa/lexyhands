<?php

namespace App\Database\Migrations;

use App\Services\SqlEasy;

class CreateCacheSettingsTable
{
    public function up(): void
    {
        $pdo = (new SqlEasy())->conn();
        
        $sql = "
            CREATE TABLE IF NOT EXISTS cache_settings (
                id INT AUTO_INCREMENT PRIMARY KEY,
                debug BOOLEAN DEFAULT FALSE,
                expiration_time INT DEFAULT 60 COMMENT 'Expiration time in minutes',
                status BOOLEAN DEFAULT TRUE COMMENT 'Cache enabled/disabled',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ";
        
        $pdo->exec($sql);
        
        // Insert default cache settings
        $insertSql = "
            INSERT INTO cache_settings (id, debug, expiration_time, status)
            VALUES (1, 0, 60, 1)
            ON DUPLICATE KEY UPDATE
                debug = VALUES(debug),
                expiration_time = VALUES(expiration_time),
                status = VALUES(status)
        ";
        
        $pdo->exec($insertSql);
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS cache_settings";
        (new SqlEasy())->conn()->exec($sql);
    }
}

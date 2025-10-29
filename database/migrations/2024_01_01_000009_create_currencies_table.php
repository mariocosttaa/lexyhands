<?php

namespace App\Database\Migrations;

use App\Services\SqlEasy;

class CreateCurrenciesTable
{
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS currencies (
                id INT AUTO_INCREMENT PRIMARY KEY,
                code VARCHAR(3) UNIQUE NOT NULL,
                name VARCHAR(100) NOT NULL,
                symbol VARCHAR(10) NOT NULL,
                exchange_rate DECIMAL(10,4) DEFAULT 1.0000,
                is_default BOOLEAN DEFAULT FALSE,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                INDEX idx_code (code),
                INDEX idx_is_default (is_default)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ";
        
        (new SqlEasy())->conn()->exec($sql);
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS currencies";
        (new SqlEasy())->conn()->exec($sql);
    }
}

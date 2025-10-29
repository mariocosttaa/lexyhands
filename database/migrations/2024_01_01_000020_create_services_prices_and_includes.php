<?php

namespace App\Database\Migrations;

use App\Services\SqlEasy;

class CreateServicesPricesAndIncludes
{
    public function up(): void
    {
        $pdo = (new SqlEasy())->conn();
        
        // Create services_price table
        $sql = "
            CREATE TABLE IF NOT EXISTS services_price (
                id INT AUTO_INCREMENT PRIMARY KEY,
                service_id INT NOT NULL,
                name VARCHAR(255) NULL,
                description TEXT,
                price DECIMAL(10,2) NOT NULL,
                currency_code VARCHAR(3) DEFAULT 'EUR',
                duration INT DEFAULT 60,
                is_active BOOLEAN DEFAULT TRUE,
                sort_order INT DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                INDEX idx_service_id (service_id),
                INDEX idx_currency_code (currency_code),
                INDEX idx_is_active (is_active),
                INDEX idx_sort_order (sort_order),
                FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ";
        
        $pdo->exec($sql);
        
        // Add includes JSON column to services table if it doesn't exist
        try {
            $pdo->exec("ALTER TABLE services ADD COLUMN includes JSON NULL AFTER content");
        } catch (\PDOException $e) {
            // Column might already exist, ignore
            if (strpos($e->getMessage(), 'Duplicate column name') === false) {
                throw $e;
            }
        }
    }

    public function down(): void
    {
        $pdo = (new SqlEasy())->conn();
        
        // Drop services_price table
        $pdo->exec("DROP TABLE IF EXISTS services_price");
        
        // Remove includes column from services
        try {
            $pdo->exec("ALTER TABLE services DROP COLUMN IF EXISTS includes");
        } catch (\PDOException $e) {
            // Ignore if column doesn't exist
        }
    }
}

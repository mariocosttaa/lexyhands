<?php

namespace App\Database\Migrations;

use App\Services\SqlEasy;

class CreateSiteTrafficTable
{
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS site_traffic (
                id INT AUTO_INCREMENT PRIMARY KEY,
                ip_address VARCHAR(45) NOT NULL,
                user_agent TEXT,
                device_type VARCHAR(20) DEFAULT 'Desktop',
                page_url VARCHAR(500),
                visit_time DATETIME NOT NULL,
                referrer VARCHAR(500) NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_ip_address (ip_address),
                INDEX idx_visit_time (visit_time),
                INDEX idx_device_type (device_type)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ";
        
        (new SqlEasy())->conn()->exec($sql);
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS site_traffic";
        (new SqlEasy())->conn()->exec($sql);
    }
}

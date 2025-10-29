<?php

namespace App\Database\Migrations;

use App\Services\SqlEasy;

class CreateSettingsTable
{
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS settings (
                id INT AUTO_INCREMENT PRIMARY KEY,
                site_name VARCHAR(255) NOT NULL DEFAULT 'LexyHands',
                site_description TEXT,
                site_logo VARCHAR(500),
                show_logo BOOLEAN DEFAULT TRUE,
                contact_email VARCHAR(255),
                contact_phone VARCHAR(50),
                address TEXT,
                city VARCHAR(100),
                postal_code VARCHAR(20),
                country VARCHAR(100),
                facebook_url VARCHAR(500),
                instagram_url VARCHAR(500),
                twitter_url VARCHAR(500),
                linkedin_url VARCHAR(500),
                maintenance_mode BOOLEAN DEFAULT FALSE,
                maintenance_message TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                INDEX idx_site_name (site_name)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ";
        
        (new SqlEasy())->conn()->exec($sql);
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS settings";
        (new SqlEasy())->conn()->exec($sql);
    }
}

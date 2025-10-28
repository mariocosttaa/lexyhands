<?php

namespace App\Database\Migrations;

use App\Services\SqlEasy;

class CreateGalleryTable
{
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS gallery (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                description TEXT,
                image_path VARCHAR(500) NOT NULL,
                alt_text VARCHAR(255),
                category VARCHAR(100),
                sort_order INT DEFAULT 0,
                status ENUM('active', 'inactive') DEFAULT 'active',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                INDEX idx_category (category),
                INDEX idx_status (status),
                INDEX idx_sort_order (sort_order)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ";
        
        SqlEasy::getInstance()->query($sql);
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS gallery";
        SqlEasy::getInstance()->query($sql);
    }
}

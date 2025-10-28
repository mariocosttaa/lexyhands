<?php

namespace App\Database\Migrations;

use App\Services\SqlEasy;

class CreatePostsCategorysTable
{
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS posts_categorys (
                id INT AUTO_INCREMENT PRIMARY KEY,
                identificator VARCHAR(100) UNIQUE NOT NULL,
                name VARCHAR(100) NOT NULL,
                description TEXT,
                color VARCHAR(7) DEFAULT '#007bff',
                icon VARCHAR(50),
                sort_order INT DEFAULT 0,
                status ENUM('active', 'inactive') DEFAULT 'active',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                INDEX idx_identificator (identificator),
                INDEX idx_status (status),
                INDEX idx_sort_order (sort_order)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ";
        
        SqlEasy::getInstance()->query($sql);
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS posts_categorys";
        SqlEasy::getInstance()->query($sql);
    }
}

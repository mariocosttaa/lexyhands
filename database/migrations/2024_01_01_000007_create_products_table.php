<?php

namespace App\Database\Migrations;

use App\Services\SqlEasy;

class CreateProductsTable
{
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS products (
                id INT AUTO_INCREMENT PRIMARY KEY,
                identificator VARCHAR(255) UNIQUE NOT NULL,
                name VARCHAR(255) NOT NULL,
                description TEXT,
                content LONGTEXT,
                image VARCHAR(500),
                service_id INT,
                status ENUM('active', 'inactive') DEFAULT 'active',
                sort_order INT DEFAULT 0,
                meta_description TEXT,
                meta_keywords TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                INDEX idx_identificator (identificator),
                INDEX idx_service_id (service_id),
                INDEX idx_status (status),
                INDEX idx_sort_order (sort_order),
                FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE SET NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ";
        
        SqlEasy::getInstance()->query($sql);
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS products";
        SqlEasy::getInstance()->query($sql);
    }
}

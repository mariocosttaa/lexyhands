<?php

namespace App\Database\Migrations;

use App\Services\SqlEasy;

class CreateServicesFaqTable
{
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS services_faq (
                id INT AUTO_INCREMENT PRIMARY KEY,
                service_id INT NOT NULL,
                question TEXT NOT NULL,
                answer TEXT NOT NULL,
                sort_order INT DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                INDEX idx_service_id (service_id),
                INDEX idx_sort_order (sort_order),
                FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ";
        
        SqlEasy::getInstance()->query($sql);
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS services_faq";
        SqlEasy::getInstance()->query($sql);
    }
}

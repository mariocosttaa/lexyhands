<?php

namespace App\Database\Migrations;

use App\Services\SqlEasy;

class CreateRolesTable
{
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS roles (
                id INT AUTO_INCREMENT PRIMARY KEY,
                role_id VARCHAR(50) UNIQUE NOT NULL,
                name VARCHAR(100) NOT NULL,
                description TEXT,
                permissions JSON,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                INDEX idx_role_id (role_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ";
        
        (new SqlEasy())->conn()->exec($sql);
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS roles";
        (new SqlEasy())->conn()->exec($sql);
    }
}

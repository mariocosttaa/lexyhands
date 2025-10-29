<?php

namespace App\Database\Migrations;

use App\Services\SqlEasy;

class CreateUsersTable
{
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id VARCHAR(50) UNIQUE NOT NULL,
                name VARCHAR(100) NOT NULL,
                surname VARCHAR(100) NOT NULL,
                email VARCHAR(255) UNIQUE NOT NULL,
                password VARCHAR(255) NOT NULL,
                role_id VARCHAR(50) NOT NULL,
                phone VARCHAR(20),
                address TEXT,
                city VARCHAR(100),
                postal_code VARCHAR(20),
                country VARCHAR(100),
                avatar VARCHAR(255),
                status ENUM('active', 'inactive', 'suspended') DEFAULT 'active',
                email_verified_at TIMESTAMP NULL,
                last_login_at TIMESTAMP NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                INDEX idx_user_id (user_id),
                INDEX idx_email (email),
                INDEX idx_role_id (role_id),
                INDEX idx_status (status)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ";
        
        (new SqlEasy())->conn()->exec($sql);
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS users";
        (new SqlEasy())->conn()->exec($sql);
    }
}

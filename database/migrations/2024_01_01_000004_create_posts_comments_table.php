<?php

namespace App\Database\Migrations;

use App\Services\SqlEasy;

class CreatePostsCommentsTable
{
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS posts_comments (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id VARCHAR(50) NOT NULL,
                post_id INT NOT NULL,
                name VARCHAR(100) NOT NULL,
                email VARCHAR(255) NOT NULL,
                comment TEXT NOT NULL,
                status ENUM('approved', 'pending', 'rejected') DEFAULT 'pending',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                INDEX idx_user_id (user_id),
                INDEX idx_post_id (post_id),
                INDEX idx_status (status),
                FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
                FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ";
        
        (new SqlEasy())->conn()->exec($sql);
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS posts_comments";
        (new SqlEasy())->conn()->exec($sql);
    }
}

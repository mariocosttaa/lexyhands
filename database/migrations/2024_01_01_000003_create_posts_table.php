<?php

namespace App\Database\Migrations;

use App\Services\SqlEasy;

class CreatePostsTable
{
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS posts (
                id INT AUTO_INCREMENT PRIMARY KEY,
                author_id VARCHAR(50) NOT NULL,
                identificator VARCHAR(255) UNIQUE NOT NULL,
                tittle VARCHAR(255) NOT NULL,
                subtittle VARCHAR(500),
                content LONGTEXT NOT NULL,
                featured_image VARCHAR(500),
                category INT NOT NULL,
                date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                status ENUM('published', 'draft', 'archived') DEFAULT 'draft',
                meta_description TEXT,
                meta_keywords TEXT,
                tags JSON,
                countComments INT DEFAULT 0,
                views INT DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                INDEX idx_identificator (identificator),
                INDEX idx_author_id (author_id),
                INDEX idx_category (category),
                INDEX idx_status (status),
                INDEX idx_date (date),
                FOREIGN KEY (author_id) REFERENCES users(user_id) ON DELETE CASCADE,
                FOREIGN KEY (category) REFERENCES posts_categorys(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ";
        
        SqlEasy::getInstance()->query($sql);
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS posts";
        SqlEasy::getInstance()->query($sql);
    }
}

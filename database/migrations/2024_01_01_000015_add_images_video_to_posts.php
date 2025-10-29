<?php

namespace App\Database\Migrations;

use App\Services\SqlEasy;

class AddImagesVideoToPosts
{
    public function up(): void
    {
        $pdo = (new SqlEasy())->conn();
        
        // Check and add images column (JSON)
        $checkImages = "SELECT COUNT(*) as count FROM information_schema.COLUMNS 
                       WHERE TABLE_SCHEMA = DATABASE() 
                       AND TABLE_NAME = 'posts' 
                       AND COLUMN_NAME = 'images'";
        $stmt = $pdo->query($checkImages);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        if ($result['count'] == 0) {
            $pdo->exec("ALTER TABLE posts ADD COLUMN images JSON NULL AFTER featured_image");
        }
        
        // Check and add video column
        $checkVideo = "SELECT COUNT(*) as count FROM information_schema.COLUMNS 
                      WHERE TABLE_SCHEMA = DATABASE() 
                      AND TABLE_NAME = 'posts' 
                      AND COLUMN_NAME = 'video'";
        $stmt = $pdo->query($checkVideo);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        if ($result['count'] == 0) {
            $pdo->exec("ALTER TABLE posts ADD COLUMN video VARCHAR(500) NULL AFTER images");
        }
    }

    public function down(): void
    {
        $pdo = (new SqlEasy())->conn();
        $pdo->exec("ALTER TABLE posts DROP COLUMN IF EXISTS video");
        $pdo->exec("ALTER TABLE posts DROP COLUMN IF EXISTS images");
    }
}

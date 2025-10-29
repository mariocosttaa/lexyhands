<?php

namespace App\Database\Migrations;

use App\Services\SqlEasy;

class AddImagesSpecificationsToProducts
{
    public function up(): void
    {
        $pdo = (new SqlEasy())->conn();
        
        // Check and add images column (JSON) - products use images (plural, JSON array) not image (singular)
        $checkImages = "SELECT COUNT(*) as count FROM information_schema.COLUMNS 
                       WHERE TABLE_SCHEMA = DATABASE() 
                       AND TABLE_NAME = 'products' 
                       AND COLUMN_NAME = 'images'";
        $stmt = $pdo->query($checkImages);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        if ($result['count'] == 0) {
            $pdo->exec("ALTER TABLE products ADD COLUMN images JSON NULL AFTER image");
        }
        
        // Check and add specifications column (JSON)
        $checkSpecs = "SELECT COUNT(*) as count FROM information_schema.COLUMNS 
                      WHERE TABLE_SCHEMA = DATABASE() 
                      AND TABLE_NAME = 'products' 
                      AND COLUMN_NAME = 'specifications'";
        $stmt = $pdo->query($checkSpecs);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        if ($result['count'] == 0) {
            $pdo->exec("ALTER TABLE products ADD COLUMN specifications JSON NULL AFTER content");
        }
    }

    public function down(): void
    {
        $pdo = (new SqlEasy())->conn();
        $pdo->exec("ALTER TABLE products DROP COLUMN IF EXISTS specifications");
        $pdo->exec("ALTER TABLE products DROP COLUMN IF EXISTS images");
    }
}

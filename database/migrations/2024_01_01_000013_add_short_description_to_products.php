<?php

namespace App\Database\Migrations;

use App\Services\SqlEasy;

class AddShortDescriptionToProducts
{
    public function up(): void
    {
        // Check if column exists first
        $checkSql = "SELECT COUNT(*) as count FROM information_schema.COLUMNS 
                     WHERE TABLE_SCHEMA = DATABASE() 
                     AND TABLE_NAME = 'products' 
                     AND COLUMN_NAME = 'short_description'";
        
        $pdo = (new \App\Services\SqlEasy())->conn();
        $stmt = $pdo->query($checkSql);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        if ($result['count'] == 0) {
            $sql = "
                ALTER TABLE products
                ADD COLUMN short_description VARCHAR(255) NULL AFTER description
            ";
            $pdo->exec($sql);
        }
    }

    public function down(): void
    {
        $sql = "
            ALTER TABLE products
            DROP COLUMN IF EXISTS short_description
        ";
        
        (new SqlEasy())->conn()->exec($sql);
    }
}

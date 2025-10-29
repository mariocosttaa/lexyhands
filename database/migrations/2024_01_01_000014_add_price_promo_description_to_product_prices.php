<?php

namespace App\Database\Migrations;

use App\Services\SqlEasy;

class AddPricePromoDescriptionToProductPrices
{
    public function up(): void
    {
        $pdo = (new SqlEasy())->conn();
        
        // Check and add price_promo column
        $checkPromo = "SELECT COUNT(*) as count FROM information_schema.COLUMNS 
                      WHERE TABLE_SCHEMA = DATABASE() 
                      AND TABLE_NAME = 'product_prices' 
                      AND COLUMN_NAME = 'price_promo'";
        $stmt = $pdo->query($checkPromo);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        if ($result['count'] == 0) {
            $pdo->exec("ALTER TABLE product_prices ADD COLUMN price_promo DECIMAL(10,2) NULL AFTER price");
        }
        
        // Check and add description column
        $checkDesc = "SELECT COUNT(*) as count FROM information_schema.COLUMNS 
                     WHERE TABLE_SCHEMA = DATABASE() 
                     AND TABLE_NAME = 'product_prices' 
                     AND COLUMN_NAME = 'description'";
        $stmt = $pdo->query($checkDesc);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        if ($result['count'] == 0) {
            $pdo->exec("ALTER TABLE product_prices ADD COLUMN description VARCHAR(255) NULL AFTER price_promo");
        }
    }

    public function down(): void
    {
        $pdo = (new SqlEasy())->conn();
        $pdo->exec("ALTER TABLE product_prices DROP COLUMN IF EXISTS description");
        $pdo->exec("ALTER TABLE product_prices DROP COLUMN IF EXISTS price_promo");
    }
}

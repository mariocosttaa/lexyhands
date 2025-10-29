<?php

namespace App\Database\Migrations;

use App\Services\SqlEasy;

class CreateProductsStocksTable
{
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS products_stocks (
                id INT AUTO_INCREMENT PRIMARY KEY,
                product_id INT NOT NULL,
                unlimited_stocks BOOLEAN DEFAULT FALSE,
                stock INT DEFAULT 0,
                stock_with_size JSON NULL,
                stock_with_color JSON NULL,
                stock_with_size_and_color JSON NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                INDEX idx_product_id (product_id),
                FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ";
        
        (new SqlEasy())->conn()->exec($sql);
    }

    public function down(): void
    {
        $sql = "DROP TABLE IF EXISTS products_stocks";
        (new SqlEasy())->conn()->exec($sql);
    }
}

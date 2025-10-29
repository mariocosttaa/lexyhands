<?php

namespace App\Database\Seeders;

use App\Services\SqlEasy;

class ProductsSeeder
{
    private SqlEasy $sqlEasy;

    public function __construct()
    {
        $this->sqlEasy = SqlEasy::getInstance();
    }

    public function run(): void
    {
        echo "🛍️ Seeding products and currencies...\n";
        
        // Seed currencies
        $currencies = [
            [
                'code' => 'EUR',
                'name' => 'Euro',
                'symbol' => '€',
                'exchange_rate' => 1.0,
                'is_default' => 1
            ],
            [
                'code' => 'USD',
                'name' => 'US Dollar',
                'symbol' => '$',
                'exchange_rate' => 0.85,
                'is_default' => 0
            ],
            [
                'code' => 'GBP',
                'name' => 'British Pound',
                'symbol' => '£',
                'exchange_rate' => 1.15,
                'is_default' => 0
            ]
        ];

        foreach ($currencies as $currency) {
            try {
                $this->sqlEasy->insert('currencies', $currency);
            } catch (\PDOException $e) {
                // Ignore duplicate entry errors (SQLSTATE code is string "23000")
                // Check error code or message for duplicate entry
                $errorCode = (string)$e->getCode();
                $isDuplicate = ($errorCode === '23000' || strpos($e->getMessage(), 'Duplicate entry') !== false);
                if (!$isDuplicate) {
                    throw $e;
                }
                // Silently ignore duplicate entries
            }
        }

        // Seed products
        $products = [
            [
                'identificator' => 'pacote-massagem-relaxante',
                'name' => 'Pacote Massagem Relaxante',
                'description' => 'Pacote completo de massagem relaxante',
                'content' => '<p>Pacote especial de massagem relaxante com múltiplas sessões para máximo benefício.</p><p>Inclui:</p><ul><li>3 sessões de 60 minutos</li><li>Óleos essenciais premium</li><li>Acompanhamento personalizado</li></ul>',
                'image' => '/assets/images/products/pacote-relaxante.jpg',
                'service_id' => 1,
                'status' => 'active',
                'sort_order' => 1,
                'meta_description' => 'Pacote completo de massagem relaxante',
                'meta_keywords' => 'pacote, massagem, relaxante, promoção'
            ],
            [
                'identificator' => 'pacote-massagem-terapeutica',
                'name' => 'Pacote Massagem Terapêutica',
                'description' => 'Pacote especializado para tratamento de dores',
                'content' => '<p>Pacote focado no tratamento de dores musculares e tensões.</p><p>Inclui:</p><ul><li>4 sessões de 75 minutos</li><li>Técnicas especializadas</li><li>Avaliação inicial</li><li>Relatório de progresso</li></ul>',
                'image' => '/assets/images/products/pacote-terapeutica.jpg',
                'service_id' => 2,
                'status' => 'active',
                'sort_order' => 2,
                'meta_description' => 'Pacote especializado para tratamento de dores',
                'meta_keywords' => 'pacote, massagem, terapêutica, tratamento'
            ],
            [
                'identificator' => 'combo-completo',
                'name' => 'Combo Completo',
                'description' => 'Combinação de todos os nossos serviços',
                'content' => '<p>O pacote mais completo com todos os nossos serviços.</p><p>Inclui:</p><ul><li>2 sessões de massagem relaxante</li><li>2 sessões de massagem terapêutica</li><li>1 sessão de reflexologia</li><li>Desconto especial</li></ul>',
                'image' => '/assets/images/products/combo-completo.jpg',
                'service_id' => null,
                'status' => 'active',
                'sort_order' => 3,
                'meta_description' => 'Combo completo com todos os serviços',
                'meta_keywords' => 'combo, completo, serviços, desconto'
            ]
        ];

        foreach ($products as $product) {
            // Try to get existing product first (needed for prices later)
            $existing = $this->sqlEasy->select('products', ['identificator' => $product['identificator']], 1, null, true);
            if ($existing === false || $existing === null) {
                try {
                    $productId = $this->sqlEasy->insert('products', $product);
                    // Store product ID for prices (if product was inserted)
                    if ($productId) {
                        $product['id'] = $productId;
                    }
                } catch (\PDOException $e) {
                    // Ignore duplicate entry errors (error code 23000)
                    $errorCode = $e->getCode();
                if (($errorCode != 23000 && $errorCode != '23000') || strpos($e->getMessage(), 'Duplicate entry') === false) {
                        throw $e;
                    }
                    // If duplicate, fetch existing product ID
                    $existing = $this->sqlEasy->select('products', ['identificator' => $product['identificator']], 1, null, true);
                    if ($existing) {
                        $product['id'] = is_object($existing) ? $existing->id : ($existing['id'] ?? null);
                    }
                }
            } else {
                // Get existing product ID
                $product['id'] = is_object($existing) ? $existing->id : ($existing['id'] ?? null);
            }
        }

        // Get product IDs from database (products may already exist)
        $product1 = $this->sqlEasy->select('products', ['identificator' => 'pacote-massagem-relaxante'], 1, null, true);
        $product2 = $this->sqlEasy->select('products', ['identificator' => 'pacote-massagem-terapeutica'], 1, null, true);
        $product3 = $this->sqlEasy->select('products', ['identificator' => 'combo-completo'], 1, null, true);
        
        $productId1 = is_object($product1) ? $product1->id : ($product1['id'] ?? 1);
        $productId2 = is_object($product2) ? $product2->id : ($product2['id'] ?? 2);
        $productId3 = is_object($product3) ? $product3->id : ($product3['id'] ?? 3);
        
        // Seed product prices
        $prices = [
            // Pacote Massagem Relaxante
            ['product_id' => $productId1, 'currency_code' => 'EUR', 'price' => 150.00, 'is_active' => 1],
            ['product_id' => $productId1, 'currency_code' => 'USD', 'price' => 176.47, 'is_active' => 1],
            ['product_id' => $productId1, 'currency_code' => 'GBP', 'price' => 130.43, 'is_active' => 1],
            
            // Pacote Massagem Terapêutica
            ['product_id' => $productId2, 'currency_code' => 'EUR', 'price' => 250.00, 'is_active' => 1],
            ['product_id' => $productId2, 'currency_code' => 'USD', 'price' => 294.12, 'is_active' => 1],
            ['product_id' => $productId2, 'currency_code' => 'GBP', 'price' => 217.39, 'is_active' => 1],
            
            // Combo Completo
            ['product_id' => $productId3, 'currency_code' => 'EUR', 'price' => 300.00, 'is_active' => 1],
            ['product_id' => $productId3, 'currency_code' => 'USD', 'price' => 352.94, 'is_active' => 1],
            ['product_id' => $productId3, 'currency_code' => 'GBP', 'price' => 260.87, 'is_active' => 1]
        ];

        foreach ($prices as $price) {
            try {
                $this->sqlEasy->insert('product_prices', $price);
            } catch (\PDOException $e) {
                // Ignore duplicate entry errors (SQLSTATE code is string "23000")
                // Check error code or message for duplicate entry
                $errorCode = (string)$e->getCode();
                $isDuplicate = ($errorCode === '23000' || strpos($e->getMessage(), 'Duplicate entry') !== false);
                if (!$isDuplicate) {
                    throw $e;
                }
                // Silently ignore duplicate entries
            }
        }

        // Seed settings (only if settings table is empty)
        $existingSettings = $this->sqlEasy->select('settings', null, 1);
        if (!$existingSettings) {
            $settings = [
                'site_name' => 'LexyHands',
                'site_description' => 'Massagem terapêutica profissional para seu bem-estar',
                'site_logo' => '/assets/images/logo.png',
                'show_logo' => 1,
                'contact_email' => 'contact@lexyhands.com',
                'contact_phone' => '+351 962 674 341',
                'address' => 'Rua da Massagem, 123',
                'city' => 'Lisboa',
                'postal_code' => '1000-001',
                'country' => 'Portugal',
                'facebook_url' => 'https://facebook.com/lexyhands',
                'instagram_url' => 'https://instagram.com/lexyhands',
                'maintenance_mode' => 0
            ];

            $this->sqlEasy->insert('settings', $settings);
        }
        
        echo "✅ Products, currencies and settings seeded\n";
    }
}

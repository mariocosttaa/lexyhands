<?php

namespace App\Database\Seeders;

use App\Services\SqlEasy;

class ProductsSeeder
{
    private SqlEasy $sqlEasy;

    public function __construct()
    {
        $this->sqlEasy = new SqlEasy();
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
            $this->sqlEasy->insert('currencies', $currency);
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
            $this->sqlEasy->insert('products', $product);
        }

        // Seed product prices
        $prices = [
            // Pacote Massagem Relaxante
            ['product_id' => 1, 'currency_code' => 'EUR', 'price' => 150.00, 'is_active' => 1],
            ['product_id' => 1, 'currency_code' => 'USD', 'price' => 176.47, 'is_active' => 1],
            ['product_id' => 1, 'currency_code' => 'GBP', 'price' => 130.43, 'is_active' => 1],
            
            // Pacote Massagem Terapêutica
            ['product_id' => 2, 'currency_code' => 'EUR', 'price' => 250.00, 'is_active' => 1],
            ['product_id' => 2, 'currency_code' => 'USD', 'price' => 294.12, 'is_active' => 1],
            ['product_id' => 2, 'currency_code' => 'GBP', 'price' => 217.39, 'is_active' => 1],
            
            // Combo Completo
            ['product_id' => 3, 'currency_code' => 'EUR', 'price' => 300.00, 'is_active' => 1],
            ['product_id' => 3, 'currency_code' => 'USD', 'price' => 352.94, 'is_active' => 1],
            ['product_id' => 3, 'currency_code' => 'GBP', 'price' => 260.87, 'is_active' => 1]
        ];

        foreach ($prices as $price) {
            $this->sqlEasy->insert('product_prices', $price);
        }

        // Seed settings
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
        
        echo "✅ Products, currencies and settings seeded\n";
    }
}

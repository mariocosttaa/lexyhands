<?php

namespace App\Database\Seeders;

use App\Services\SqlEasy;

class ServiceSeeder
{
    private SqlEasy $sqlEasy;

    public function __construct()
    {
        $this->sqlEasy = SqlEasy::getInstance();
    }

    public function run(): void
    {
        echo "🛠️ Seeding services...\n";
        
        $services = [
            [
                'identificator' => 'massagem-relaxante',
                'name' => 'Massagem Relaxante',
                'description' => 'Massagem terapêutica para relaxamento e bem-estar',
                'content' => '<p>A massagem relaxante é perfeita para aliviar o stress e tensão muscular. Utilizamos técnicas suaves e movimentos circulares para promover o relaxamento profundo.</p><p>Esta modalidade é ideal para quem procura momentos de tranquilidade e renovação energética.</p>',
                'featured_image' => '/assets/images/services/massagem-relaxante.jpg',
                'price' => 60.00,
                'duration' => 60,
                'status' => 'active',
                'sort_order' => 1,
                'meta_description' => 'Massagem relaxante profissional para alívio do stress',
                'meta_keywords' => 'massagem, relaxante, terapêutica, bem-estar'
            ],
            [
                'identificator' => 'massagem-terapeutica',
                'name' => 'Massagem Terapêutica',
                'description' => 'Massagem especializada para tratamento de dores musculares',
                'content' => '<p>A massagem terapêutica é focada no tratamento de dores musculares e tensões específicas. Utilizamos técnicas de pressão profunda e alongamentos para aliviar dores.</p><p>Ideal para quem sofre de dores nas costas, pescoço ou outras áreas tensionadas.</p>',
                'featured_image' => '/assets/images/services/massagem-terapeutica.jpg',
                'price' => 70.00,
                'duration' => 75,
                'status' => 'active',
                'sort_order' => 2,
                'meta_description' => 'Massagem terapêutica para tratamento de dores musculares',
                'meta_keywords' => 'massagem, terapêutica, dores, tratamento'
            ],
            [
                'identificator' => 'reflexologia',
                'name' => 'Reflexologia',
                'description' => 'Terapia através de pontos de pressão nos pés',
                'content' => '<p>A reflexologia trabalha pontos específicos nos pés que correspondem a diferentes órgãos e sistemas do corpo. Esta técnica promove o equilíbrio energético e o bem-estar geral.</p><p>Uma experiência única de relaxamento e harmonização corporal.</p>',
                'featured_image' => '/assets/images/services/reflexologia.jpg',
                'price' => 50.00,
                'duration' => 45,
                'status' => 'active',
                'sort_order' => 3,
                'meta_description' => 'Reflexologia podal para equilíbrio energético',
                'meta_keywords' => 'reflexologia, podal, energia, equilíbrio'
            ]
        ];

        foreach ($services as $service) {
            try {
                $this->sqlEasy->insert('services', $service);
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
        
        echo "✅ Services seeded\n";
    }
}

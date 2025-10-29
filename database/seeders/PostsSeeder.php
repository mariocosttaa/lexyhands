<?php

namespace App\Database\Seeders;

use App\Services\SqlEasy;

class PostsSeeder
{
    private SqlEasy $sqlEasy;

    public function __construct()
    {
        $this->sqlEasy = SqlEasy::getInstance();
    }

    public function run(): void
    {
        echo "📝 Seeding posts and categories...\n";
        
        // Seed post categories
        $categories = [
            [
                'identificator' => 'general',
                'name' => 'General',
                'description' => 'Posts gerais sobre massagem e bem-estar',
                'color' => '#007bff',
                'icon' => 'fas fa-heart',
                'sort_order' => 1,
                'status' => 'active'
            ],
            [
                'identificator' => 'technology',
                'name' => 'Technology',
                'description' => 'Tecnologia e inovações em massagem',
                'color' => '#28a745',
                'icon' => 'fas fa-microchip',
                'sort_order' => 2,
                'status' => 'active'
            ],
            [
                'identificator' => 'business',
                'name' => 'Business',
                'description' => 'Negócios e empreendedorismo',
                'color' => '#ffc107',
                'icon' => 'fas fa-briefcase',
                'sort_order' => 3,
                'status' => 'active'
            ]
        ];

        foreach ($categories as $category) {
            try {
                $this->sqlEasy->insert('posts_categorys', $category);
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

        // Seed posts
        $posts = [
            [
                'author_id' => 'ADM001',
                'identificator' => 'bem-vindos-lexyhands',
                'tittle' => 'Bem-vindos à LexyHands',
                'subtittle' => 'Descubra os benefícios da massagem terapêutica profissional',
                'content' => '<p>Bem-vindos à LexyHands! Somos especialistas em massagem terapêutica e relaxamento. Nossa missão é proporcionar momentos de bem-estar e alívio do stress através de técnicas profissionais de massagem.</p><p>Oferecemos diversos tipos de massagem adaptados às suas necessidades, desde relaxamento profundo até terapias específicas para dores musculares.</p>',
                'featured_image' => '/assets/images/posts/massagem-relaxante.jpg',
                'category' => 1,
                'date' => date('Y-m-d H:i:s'),
                'status' => 'published',
                'meta_description' => 'Conheça a LexyHands e nossos serviços de massagem terapêutica profissional.',
                'meta_keywords' => 'massagem, terapêutica, relaxamento, bem-estar',
                'tags' => json_encode(['massagem', 'terapêutica', 'relaxamento', 'bem-estar'])
            ],
            [
                'author_id' => 'ADM001',
                'identificator' => 'beneficios-massagem-relaxante',
                'tittle' => 'Benefícios da Massagem Relaxante',
                'subtittle' => 'Descubra como a massagem relaxante pode melhorar sua qualidade de vida',
                'content' => '<p>A massagem relaxante é uma das técnicas mais procuradas para alívio do stress e tensão muscular. Esta modalidade oferece diversos benefícios para a saúde física e mental.</p><h3>Principais Benefícios:</h3><ul><li>Redução do stress e ansiedade</li><li>Melhoria da circulação sanguínea</li><li>Alívio de tensões musculares</li><li>Promoção do bem-estar geral</li><li>Melhoria da qualidade do sono</li></ul>',
                'featured_image' => '/assets/images/posts/beneficios-massagem.jpg',
                'category' => 1,
                'date' => date('Y-m-d H:i:s'),
                'status' => 'published',
                'meta_description' => 'Conheça os principais benefícios da massagem relaxante para sua saúde.',
                'meta_keywords' => 'massagem, relaxante, benefícios, saúde',
                'tags' => json_encode(['massagem', 'relaxante', 'benefícios', 'saúde'])
            ],
            [
                'author_id' => 'EDT001',
                'identificator' => 'massagem-terapeutica-dores',
                'tittle' => 'Massagem Terapêutica para Dores',
                'subtittle' => 'Técnicas especializadas para alívio de dores musculares',
                'content' => '<p>A massagem terapêutica é especialmente eficaz no tratamento de dores musculares e articulares. Utilizamos técnicas específicas para aliviar tensões e promover a recuperação.</p><h3>Técnicas Utilizadas:</h3><ul><li>Massagem profunda</li><li>Liberação miofascial</li><li>Pontos de pressão</li><li>Alongamentos assistidos</li></ul><p>Esta abordagem é ideal para quem sofre de dores crônicas ou lesões musculares.</p>',
                'featured_image' => '/assets/images/posts/massagem-terapeutica.jpg',
                'category' => 2,
                'date' => date('Y-m-d H:i:s'),
                'status' => 'published',
                'meta_description' => 'Técnicas especializadas de massagem para alívio de dores.',
                'meta_keywords' => 'massagem, terapêutica, dores, técnicas',
                'tags' => json_encode(['massagem', 'terapêutica', 'dores', 'técnicas'])
            ],
            [
                'author_id' => 'ADM001',
                'identificator' => 'cuidados-pos-massagem',
                'tittle' => 'Cuidados Pós-Massagem',
                'subtittle' => 'Saiba como cuidar do seu corpo após uma sessão de massagem',
                'content' => '<p>Após uma sessão de massagem, é importante seguir alguns cuidados para maximizar os benefícios e garantir uma recuperação adequada.</p><h3>Recomendações:</h3><ul><li>Beber bastante água</li><li>Evitar atividades intensas</li><li>Descansar adequadamente</li><li>Evitar álcool nas primeiras horas</li><li>Manter uma alimentação leve</li></ul><p>Seguir essas orientações ajuda a prolongar os efeitos positivos da massagem.</p>',
                'featured_image' => '/assets/images/posts/cuidados-pos-massagem.jpg',
                'category' => 1,
                'date' => date('Y-m-d H:i:s'),
                'status' => 'published',
                'meta_description' => 'Orientações importantes para após sua sessão de massagem.',
                'meta_keywords' => 'cuidados, pós-massagem, orientações, saúde',
                'tags' => json_encode(['cuidados', 'pós-massagem', 'orientações', 'saúde'])
            ]
        ];

        foreach ($posts as $post) {
            try {
                $this->sqlEasy->insert('posts', $post);
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

        // Seed post comments
        $comments = [
            [
                'user_id' => 'ADM001',
                'post_id' => 1,
                'name' => 'Maria Silva',
                'email' => 'maria.silva@email.com',
                'comment' => 'Excelente serviço! A massagem foi muito relaxante e profissional.',
                'status' => 'approved'
            ],
            [
                'user_id' => 'EDT001',
                'post_id' => 1,
                'name' => 'João Santos',
                'email' => 'joao.santos@email.com',
                'comment' => 'Recomendo muito! Ambiente acolhedor e atendimento de qualidade.',
                'status' => 'approved'
            ],
            [
                'user_id' => 'ADM001',
                'post_id' => 2,
                'name' => 'Ana Costa',
                'email' => 'ana.costa@email.com',
                'comment' => 'Os benefícios da massagem são realmente incríveis. Sinto-me muito melhor!',
                'status' => 'approved'
            ],
            [
                'user_id' => 'EDT001',
                'post_id' => 3,
                'name' => 'Carlos Oliveira',
                'email' => 'carlos.oliveira@email.com',
                'comment' => 'A massagem terapêutica ajudou muito com minhas dores nas costas.',
                'status' => 'approved'
            ]
        ];

        // Get post IDs from database (posts may already exist)
        $post1 = $this->sqlEasy->select('posts', ['identificator' => 'bem-vindos-lexyhands'], 1, null, true);
        $post2 = $this->sqlEasy->select('posts', ['identificator' => 'beneficios-massagem-relaxante'], 1, null, true);
        $post3 = $this->sqlEasy->select('posts', ['identificator' => 'massagem-terapeutica-dores'], 1, null, true);
        
        $postId1 = is_object($post1) ? $post1->id : ($post1['id'] ?? 1);
        $postId2 = is_object($post2) ? $post2->id : ($post2['id'] ?? 2);
        $postId3 = is_object($post3) ? $post3->id : ($post3['id'] ?? 3);
        
        // Update comment post_ids
        $comments[0]['post_id'] = $postId1;
        $comments[1]['post_id'] = $postId1;
        $comments[2]['post_id'] = $postId2;
        $comments[3]['post_id'] = $postId3;
        
        foreach ($comments as $comment) {
            try {
                $this->sqlEasy->insert('posts_comments', $comment);
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
        
        echo "✅ Posts and comments seeded\n";
    }
}

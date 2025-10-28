<?php

namespace App\Services;

use App\Database\Seeders\DatabaseSeeder;

class Seeder
{
    public function run(): void
    {
        echo "🌱 Starting database seeding...\n\n";
        
        try {
            $seeder = new DatabaseSeeder();
            $seeder->run();
            
            echo "\n🎉 Database seeding completed successfully!\n";
            
        } catch (\Exception $e) {
            echo "\n❌ Database seeding failed: " . $e->getMessage() . "\n";
            throw $e;
        }
    }

    public function clearTables(): void
    {
        echo "🧹 Clearing database tables...\n";
        
        $tables = [
            'posts_comments',
            'posts',
            'product_prices',
            'products',
            'services_faq',
            'currencies',
            'users',
            'roles',
            'posts_categorys',
            'services',
            'settings'
        ];
        
        $pdo = Database::getInstance()->getConnection();
        
        // Disable foreign key checks
        $pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
        
        foreach ($tables as $table) {
            try {
                $pdo->exec("TRUNCATE TABLE {$table}");
                echo "✅ Cleared table: {$table}\n";
            } catch (\Exception $e) {
                echo "⚠️  Could not clear table {$table}: " . $e->getMessage() . "\n";
            }
        }
        
        // Re-enable foreign key checks
        $pdo->exec('SET FOREIGN_KEY_CHECKS = 1');
        
        echo "✅ Database tables cleared\n\n";
    }

    public function refresh(): void
    {
        echo "🔄 Refreshing database...\n\n";
        
        $this->clearTables();
        $this->run();
    }
}

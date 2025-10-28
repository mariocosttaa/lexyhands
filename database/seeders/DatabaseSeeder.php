<?php

namespace App\Database\Seeders;

use App\Database\Seeders\UserSeeder;
use App\Database\Seeders\ServiceSeeder;
use App\Database\Seeders\PostsSeeder;
use App\Database\Seeders\ProductsSeeder;

class DatabaseSeeder
{
    public function run(): void
    {
        echo "🌱 Starting database seeding...\n\n";
        
        // Run individual seeders
        (new UserSeeder())->run();
        (new ServiceSeeder())->run();
        (new PostsSeeder())->run();
        (new ProductsSeeder())->run();
        
        echo "\n✅ Database seeding completed successfully!\n";
    }
}

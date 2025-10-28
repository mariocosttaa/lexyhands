<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Services\Seeder;

try {
    echo "🌱 LexyHands Database Seeder Tool\n";
    echo "=================================\n\n";
    
    $seeder = new Seeder();
    
    // Check if we should clear tables first
    if (isset($argv[1]) && $argv[1] === '--refresh') {
        $seeder->refresh();
    } else {
        $seeder->run();
    }
    
} catch (Exception $e) {
    echo "\n❌ Seeding failed: " . $e->getMessage() . "\n";
    exit(1);
}

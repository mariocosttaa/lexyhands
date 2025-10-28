<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Services\Migration;

try {
    echo "🚀 LexyHands Database Migration Tool\n";
    echo "=====================================\n\n";
    
    $migration = new Migration();
    $migration->run();
    
} catch (Exception $e) {
    echo "\n❌ Migration failed: " . $e->getMessage() . "\n";
    exit(1);
}

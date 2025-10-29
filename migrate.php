<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Services\Migration;

try {
    echo "🚀 LexyHands Database Migration Tool\n";
    echo "=====================================\n\n";
    
    $migration = new Migration();
    
    // Check command line arguments
    if (isset($argv[1])) {
        $command = $argv[1];
        
        if ($command === 'rollback') {
            $steps = isset($argv[2]) ? (int)$argv[2] : 1;
            $migration->rollback($steps);
        } elseif ($command === 'drop') {
            // Check for --force flag to skip confirmation
            $force = isset($argv[2]) && $argv[2] === '--force';
            
            if (!$force) {
                echo "⚠️  WARNING: This will delete ALL tables from the database!\n";
                echo "Type 'yes' to continue (or use --force to skip confirmation): ";
                $handle = fopen("php://stdin", "r");
                $line = trim(fgets($handle));
                fclose($handle);
                
                if (strtolower($line) !== 'yes') {
                    echo "❌ Operation cancelled.\n";
                    exit(0);
                }
            }
            
            $migration->dropAllTables();
        } else {
            echo "❌ Unknown command: {$command}\n";
            echo "Usage: php migrate.php [rollback [steps]|drop]\n";
            exit(1);
        }
    } else {
        // Default: run migrations
        $migration->run();
    }
    
} catch (Exception $e) {
    echo "\n❌ Operation failed: " . $e->getMessage() . "\n";
    exit(1);
}

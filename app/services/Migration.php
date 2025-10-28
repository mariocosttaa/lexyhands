<?php

namespace App\Services;

use PDO;
use PDOException;

class Migration
{
    private PDO $pdo;
    private string $migrationsTable = 'migrations';

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
        $this->createMigrationsTable();
    }

    private function createMigrationsTable(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS {$this->migrationsTable} (
                id INT AUTO_INCREMENT PRIMARY KEY,
                migration VARCHAR(255) NOT NULL,
                batch INT NOT NULL,
                executed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                UNIQUE KEY unique_migration (migration)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ";
        
        $this->pdo->exec($sql);
    }

    public function run(): void
    {
        echo "🚀 Running database migrations...\n\n";
        
        $migrations = $this->getPendingMigrations();
        
        if (empty($migrations)) {
            echo "✅ No pending migrations found.\n";
            return;
        }

        $batch = $this->getNextBatchNumber();
        
        foreach ($migrations as $migration) {
            try {
                echo "Running migration: {$migration}\n";
                
                $this->pdo->beginTransaction();
                
                $this->runMigration($migration);
                $this->recordMigration($migration, $batch);
                
                $this->pdo->commit();
                echo "✅ Migration {$migration} completed successfully\n";
                
            } catch (PDOException $e) {
                $this->pdo->rollBack();
                echo "❌ Migration {$migration} failed: " . $e->getMessage() . "\n";
                throw $e;
            }
        }
        
        echo "\n🎉 All migrations completed successfully!\n";
    }

    private function getPendingMigrations(): array
    {
        $migrationsDir = __DIR__ . '/../database/migrations/';
        $files = glob($migrationsDir . '*.php');
        
        $migrations = [];
        foreach ($files as $file) {
            $migration = basename($file, '.php');
            if (!$this->isMigrationExecuted($migration)) {
                $migrations[] = $migration;
            }
        }
        
        sort($migrations);
        return $migrations;
    }

    private function isMigrationExecuted(string $migration): bool
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM {$this->migrationsTable} WHERE migration = ?");
        $stmt->execute([$migration]);
        return $stmt->fetchColumn() > 0;
    }

    private function runMigration(string $migration): void
    {
        $migrationFile = __DIR__ . '/../database/migrations/' . $migration . '.php';
        
        if (!file_exists($migrationFile)) {
            throw new \Exception("Migration file not found: {$migrationFile}");
        }
        
        require_once $migrationFile;
        
        $className = $this->getMigrationClassName($migration);
        
        if (!class_exists($className)) {
            throw new \Exception("Migration class not found: {$className}");
        }
        
        $migrationInstance = new $className();
        $migrationInstance->up();
    }

    private function getMigrationClassName(string $migration): string
    {
        $parts = explode('_', $migration);
        $className = '';
        
        foreach ($parts as $part) {
            $className .= ucfirst($part);
        }
        
        return "App\\Database\\Migrations\\{$className}";
    }

    private function recordMigration(string $migration, int $batch): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->migrationsTable} (migration, batch) VALUES (?, ?)");
        $stmt->execute([$migration, $batch]);
    }

    private function getNextBatchNumber(): int
    {
        $stmt = $this->pdo->query("SELECT MAX(batch) FROM {$this->migrationsTable}");
        $maxBatch = $stmt->fetchColumn();
        return ($maxBatch ?: 0) + 1;
    }

    public function rollback(int $steps = 1): void
    {
        echo "🔄 Rolling back {$steps} migration(s)...\n\n";
        
        $stmt = $this->pdo->prepare("
            SELECT migration FROM {$this->migrationsTable} 
            ORDER BY batch DESC, id DESC 
            LIMIT ?
        ");
        $stmt->execute([$steps]);
        $migrations = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        foreach ($migrations as $migration) {
            try {
                echo "Rolling back migration: {$migration}\n";
                
                $this->pdo->beginTransaction();
                
                $this->rollbackMigration($migration);
                $this->removeMigrationRecord($migration);
                
                $this->pdo->commit();
                echo "✅ Migration {$migration} rolled back successfully\n";
                
            } catch (PDOException $e) {
                $this->pdo->rollBack();
                echo "❌ Rollback of {$migration} failed: " . $e->getMessage() . "\n";
                throw $e;
            }
        }
        
        echo "\n🎉 Rollback completed successfully!\n";
    }

    private function rollbackMigration(string $migration): void
    {
        $migrationFile = __DIR__ . '/../database/migrations/' . $migration . '.php';
        
        if (!file_exists($migrationFile)) {
            throw new \Exception("Migration file not found: {$migrationFile}");
        }
        
        require_once $migrationFile;
        
        $className = $this->getMigrationClassName($migration);
        
        if (!class_exists($className)) {
            throw new \Exception("Migration class not found: {$className}");
        }
        
        $migrationInstance = new $className();
        $migrationInstance->down();
    }

    private function removeMigrationRecord(string $migration): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->migrationsTable} WHERE migration = ?");
        $stmt->execute([$migration]);
    }
}

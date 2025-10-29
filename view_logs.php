<?php
/**
 * Log Viewer - View access and error logs
 * 
 * Usage: php view_logs.php [type] [lines]
 *   type: 'access' (default) or 'error'
 *   lines: number of lines to show (default: 50)
 */

require_once __DIR__ . '/vendor/autoload.php';

use App\Services\Logger;

$type = $argv[1] ?? 'access';
$lines = isset($argv[2]) ? (int)$argv[2] : 50;

$logger = new Logger();

if ($type === 'access') {
    $logs = $logger->getRecentLogs($lines);
    
    echo "\n";
    echo "═══════════════════════════════════════════════════════════════════════════════\n";
    echo "                          ACCESS LOGS (Last {$lines} entries)\n";
    echo "═══════════════════════════════════════════════════════════════════════════════\n\n";
    
    if (empty($logs)) {
        echo "No logs found.\n\n";
        exit(0);
    }
    
    foreach ($logs as $log) {
        $status = $log['status'] ?? 'N/A';
        $statusColor = match($status) {
            200 => "\033[32m", // Green
            404 => "\033[33m", // Yellow
            500 => "\033[31m", // Red
            default => "\033[0m" // Reset
        };
        
        echo "{$statusColor}[{$status}]\033[0m ";
        echo "{$log['method']} ";
        echo "\033[36m{$log['uri']}\033[0m ";
        echo "| IP: {$log['ip']} ";
        
        if (isset($log['execution_time'])) {
            echo "| Time: {$log['execution_time']} ";
        }
        
        if (isset($log['memory_usage'])) {
            echo "| Memory: {$log['memory_usage']} ";
        }
        
        echo "| {$log['timestamp']}\n";
        
        if (isset($log['error'])) {
            echo "  └─ Error: \033[31m{$log['error']}\033[0m\n";
        }
    }
    
} elseif ($type === 'error') {
    $errorLogFile = __DIR__ . '/app/cache/logs/error-' . date('Y-m-d') . '.log';
    
    if (!file_exists($errorLogFile)) {
        echo "\nNo error logs found for today.\n\n";
        exit(0);
    }
    
    $fileLines = file($errorLogFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $fileLines = array_slice($fileLines, -$lines);
    $fileLines = array_reverse($fileLines);
    
    echo "\n";
    echo "═══════════════════════════════════════════════════════════════════════════════\n";
    echo "                          ERROR LOGS (Last {$lines} entries)\n";
    echo "═══════════════════════════════════════════════════════════════════════════════\n\n";
    
    foreach ($fileLines as $line) {
        $log = json_decode($line, true);
        if ($log) {
            echo "\033[31m[ERROR]\033[0m ";
            echo "{$log['timestamp']} | ";
            echo "{$log['method']} ";
            echo "\033[36m{$log['uri']}\033[0m | ";
            echo "IP: {$log['ip']}\n";
            echo "  └─ {$log['message']}\n";
            
            if (isset($log['trace'])) {
                echo "  └─ Trace: " . substr($log['trace'], 0, 200) . "...\n";
            }
            echo "\n";
        }
    }
    
} else {
    echo "Usage: php view_logs.php [access|error] [lines]\n";
    echo "  access - Show access logs (default)\n";
    echo "  error  - Show error logs\n";
    echo "  lines  - Number of lines to show (default: 50)\n";
}

echo "\n";

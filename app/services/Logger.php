<?php

namespace App\Services;

class Logger
{
    private string $logFile;
    private string $logDir;
    private bool $enabled;

    public function __construct()
    {
        $this->logDir = __DIR__ . '/../../app/cache/logs';
        $this->enabled = isset($_ENV['APP_DEBUG']) && $_ENV['APP_DEBUG'] === 'true';
        
        // Create logs directory if it doesn't exist
        if (!file_exists($this->logDir)) {
            mkdir($this->logDir, 0755, true);
        }
        
        // Create log file with date (one file per day)
        $date = date('Y-m-d');
        $this->logFile = $this->logDir . '/access-' . $date . '.log';
    }

    /**
     * Log a request
     */
    public function logRequest($method, $uri, $statusCode = 200, $executionTime = null, $error = null): void
    {
        if (!$this->enabled) {
            return;
        }

        $timestamp = date('Y-m-d H:i:s');
        $ip = $this->getClientIp();
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
        $referer = $_SERVER['HTTP_REFERER'] ?? 'Direct';
        $memoryUsage = $this->formatBytes(memory_get_usage(true));
        $peakMemory = $this->formatBytes(memory_get_peak_usage(true));
        
        $logEntry = [
            'timestamp' => $timestamp,
            'method' => $method,
            'uri' => $uri,
            'status' => $statusCode,
            'ip' => $ip,
            'user_agent' => $userAgent,
            'referer' => $referer,
            'execution_time' => $executionTime ? round($executionTime * 1000, 2) . 'ms' : null,
            'memory_usage' => $memoryUsage,
            'peak_memory' => $peakMemory,
        ];

        if ($error) {
            $logEntry['error'] = $error;
        }

        $logLine = $this->formatLogEntry($logEntry);
        
        // Write to log file
        file_put_contents($this->logFile, $logLine . PHP_EOL, FILE_APPEND | LOCK_EX);
    }

    /**
     * Log an error
     */
    public function logError($message, $trace = null): void
    {
        if (!$this->enabled) {
            return;
        }

        $timestamp = date('Y-m-d H:i:s');
        $ip = $this->getClientIp();
        $uri = $_SERVER['REQUEST_URI'] ?? 'Unknown';
        $method = $_SERVER['REQUEST_METHOD'] ?? 'Unknown';

        $logEntry = [
            'timestamp' => $timestamp,
            'level' => 'ERROR',
            'method' => $method,
            'uri' => $uri,
            'ip' => $ip,
            'message' => $message,
        ];

        if ($trace) {
            $logEntry['trace'] = $trace;
        }

        $logLine = $this->formatLogEntry($logEntry);
        
        // Write to error log file
        $errorLogFile = $this->logDir . '/error-' . date('Y-m-d') . '.log';
        file_put_contents($errorLogFile, $logLine . PHP_EOL, FILE_APPEND | LOCK_EX);
    }

    /**
     * Format log entry as JSON or text
     */
    private function formatLogEntry(array $entry): string
    {
        // Format as JSON for easier parsing
        return json_encode($entry, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Get client IP address
     */
    private function getClientIp(): string
    {
        $ipKeys = [
            'HTTP_CF_CONNECTING_IP', // Cloudflare
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_REAL_IP',
            'HTTP_CLIENT_IP',
            'REMOTE_ADDR'
        ];

        foreach ($ipKeys as $key) {
            if (!empty($_SERVER[$key])) {
                $ip = $_SERVER[$key];
                // Handle multiple IPs (from proxy)
                if (strpos($ip, ',') !== false) {
                    $ip = trim(explode(',', $ip)[0]);
                }
                if (filter_var($ip, FILTER_VALIDATE_IP)) {
                    return $ip;
                }
            }
        }

        return $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
    }

    /**
     * Format bytes to human readable format
     */
    private function formatBytes($bytes, $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        
        $bytes /= pow(1024, $pow);
        
        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    /**
     * Get recent logs
     */
    public function getRecentLogs($limit = 100): array
    {
        if (!file_exists($this->logFile)) {
            return [];
        }

        $lines = file($this->logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $lines = array_slice($lines, -$limit);
        
        $logs = [];
        foreach ($lines as $line) {
            $logs[] = json_decode($line, true);
        }

        return array_reverse($logs);
    }

    /**
     * Clear old logs (older than specified days)
     */
    public function clearOldLogs($days = 30): void
    {
        $files = glob($this->logDir . '/*.log');
        $cutoffTime = time() - ($days * 24 * 60 * 60);

        foreach ($files as $file) {
            if (filemtime($file) < $cutoffTime) {
                unlink($file);
            }
        }
    }
}

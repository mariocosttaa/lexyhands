<?php

namespace App\Services;

class Cache  extends ServiceHelper {
    private $debug;
    private $expiration_time; // Tempo em minutos
    private $settings;
    private $status;

    public function __construct() {
        $stmt = parent::conn()->prepare("SELECT * FROM cache_settings WHERE id = 1");
        $stmt->execute();
        $result = $stmt->fetchObject();

        $this->settings = $result;
        $this->debug = $this->settings->debug;
        $this->expiration_time = $this->settings->expiration_time;
        $this->status = $this->settings->status;
    }

    // Reportar erros
    private function logReports($message): void {
        if ($this->debug) {
            $logFile = __DIR__ . '/../cache/caches.log'; 
            error_log($message . "\n", 3, $logFile);
        }
    }

    // Criar diretório se não existir
    private function ensureDirectory($type): string {
        $dir = __DIR__ . '/../cache/' . $type . '/';
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
            $this->logReports("Diretório criado: $dir");
        }
        return $dir;
    }

    // Gera a chave de cache a partir de um array
    private function generateCacheKey($array = []): string {
        return md5(serialize($array)); // Criptografa o array de parâmetros para gerar a chave
    }

    // Salvar um cache
    public function save($type, $array = []): void {

        //veriricar se está activo
        if(!$this->status) {
            return;
        }

        //retirar o value e armazenar
        $value = $array['value'];
        unset($array['value']);

        $cacheDir = $this->ensureDirectory($type); // Certifica-se que o diretório existe
        
        if(isset($array['table'])) {
            $cacheKey = $this->generateCacheKey($array); // Gera chave a partir do array
            $tableKey = $this->generateCacheKey($array['table']);
            $cacheFile = $cacheDir .  $tableKey . '_'. $cacheKey . '.cache';
            
        } else {
            $cacheKey = $this->generateCacheKey($array); // Gera chave a partir do array
            $cacheFile = $cacheDir . $cacheKey . '.cache';
        }
       

        file_put_contents($cacheFile, serialize($value));
        $this->logReports("Cache salvo: $cacheFile");
    }

    // Verificar se existe um cache válido
    public function verify($type, $array = [], $duration = null): bool {

        //veriricar se está activo
        if(!$this->status) {
            return false;
        }

        $cacheDir = $this->ensureDirectory($type);

        if(isset($array['table'])) {
            $cacheKey = $this->generateCacheKey($array); // Gera chave a partir do array
            $tableKey = $this->generateCacheKey($array['table']);
            $cacheFile = $cacheDir .  $tableKey . '_'. $cacheKey . '.cache';
            
        } else {
            $cacheKey = $this->generateCacheKey($array); // Gera chave a partir do array
            $cacheFile = $cacheDir . $cacheKey . '.cache';
        }

      
        //se n for permanente..
        if($duration !== 'permanent') {
            $duration = $duration ?: $this->expiration_time;
            $duration = $duration * 60;
        }

        if (file_exists($cacheFile)) {
            $fileTime = filemtime($cacheFile);
            $expirationTime = $duration;
            if ((time() - $fileTime) < $expirationTime) {
                $this->logReports("Cache válido encontrado: $cacheFile");
                return true;
            } else {
                if($duration !== 'permanent') {
                    unlink($cacheFile);
                    $this->logReports("Cache expirado removido: $cacheFile");
                }
            }
        }
        

        return false;
    }

    // Buscar o cache pela chave
    public function get($type, $array = []): mixed {

        //veriricar se está activo
        if(!$this->status) {
            return false;
        }

        if ($this->verify($type, $array)) {
            $cacheDir = $this->ensureDirectory($type);

            if(isset($array['table'])) {
                $cacheKey = $this->generateCacheKey($array); // Gera chave a partir do array
                $tableKey = $this->generateCacheKey($array['table']);
                $cacheFile = $cacheDir .  $tableKey . '_'. $cacheKey . '.cache';
                
            } else {
                $cacheKey = $this->generateCacheKey($array); // Gera chave a partir do array
                $cacheFile = $cacheDir . $cacheKey . '.cache';
            }
            
            return unserialize(file_get_contents($cacheFile));
        }
        return false;
    }

    // Deletar caches relacionados a um array de parâmetros
    // Deletar caches relacionados a um array de parâmetros
    public function delete($type, $array = []): bool {

        //veriricar se está activo
        if(!$this->status) {
            return false;
        }

        $cacheDir = $this->ensureDirectory($type);

        // Caso a tabela esteja definida no array
        if (isset($array['table'])) {
            $tableKey = $this->generateCacheKey($array['table']); // Gera a chave da tabela
            // Busca todos os caches que começam com a chave da tabela
            foreach (glob($cacheDir . $tableKey . '_*.cache') as $cacheFile) {
                unlink($cacheFile); // Apaga arquivos que correspondem ao prefixo da tabela
                $this->logReports("Cache removido por actualização para a tabela '{$array['table']}' -> Arquivo: $cacheFile");
                return true;
            }
        } else {
            // Se não houver 'table', usar o array completo para gerar a chave
            $cacheKeyPrefix = $this->generateCacheKey($array); // Usa o array completo para gerar a chave

            // Busca todos os caches que começam com a chave gerada
            foreach (glob($cacheDir . $cacheKeyPrefix . '*.cache') as $cacheFile) {
                unlink($cacheFile); // Apaga arquivos que correspondem à chave gerada
                $this->logReports("Cache removido por actualização -> Arquivo: $cacheFile");
                return true;
            }
        }

        return false;
    }

}
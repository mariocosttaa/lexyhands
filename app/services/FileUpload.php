<?php

namespace App\Services;

use App\Services\Notification;

class FileUpload
{
    private $uploadDir;
    private $allowedExtensions = [];
    private $errors = [];
    private $params = [];

    public function __construct(?string $uploadDir = null)
    {
        if ($uploadDir) {
            // Transforma o diretório fornecido em um caminho absoluto
            $this->uploadDir = rtrim($_SERVER['DOCUMENT_ROOT'] . '/' . $uploadDir, '/') . '/';

            // Cria o diretório de upload, se não existir
            if (!is_dir($this->uploadDir)) {
                mkdir($this->uploadDir, 0777, true);
            }
        }
    }

    public function remove(string $relativePath): bool
    {
        // Adiciona o $_SERVER['DOCUMENT_ROOT'] ao caminho para obter o caminho absoluto
        $absolutePath = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($relativePath, '/');

        // Verifica se o arquivo existe
        if (!file_exists($absolutePath)) {
            $this->errors[] = "O arquivo '{$relativePath}' não foi encontrado.";
            return false;
        }

        // Tenta remover o arquivo
        if (!unlink($absolutePath)) {
            $this->errors[] = "Não foi possível remover o arquivo '{$relativePath}'.";
            return false;
        }

        return true;
    }


    public function upload(?array $files = [], ?array $params = []): array|bool|string
    {
        $this->errors = [];
        $results = [];

        if (empty($files) || empty($params)) {
            return false;
        }

        // Verifica se o parâmetro 'multiple' está definido
        $isMultiple = isset($params['multiple']) ? $params['multiple'] : true;

        // Verifica se o 'multiple' está configurado para false e há mais de um arquivo
        if (!$isMultiple && is_array($files['name']) && count($files['name']) > 1) {
            $this->errors[] = "Somente um arquivo pode ser enviado.";
            return $params['alert'] ? $this->formatErrorsAsAlert() : $this->errors;
        }

        // Define parâmetros padrão
        $params = array_merge([
            'rename' => false,         // Renomear arquivo
            'overwrite' => false,      // Sobrescrever arquivos existentes
            'allowedExtensions' => [], // Extensões permitidas
            'convert' => null,         // Extensão de conversão (ex.: png)
            'alert' => false,          // Retornar erros em formato de alerta
            'url' => null,             // URL de redirecionamento (opcional)
            'returnJson' => true,      // Retornar caminho em JSON
            'maxSize' => 5             // Tamanho máximo do arquivo em MB (default 5MB)
        ], $params);

        $this->params = $params;
        $this->allowedExtensions = $params['allowedExtensions'];

        // Processa os arquivos
        if (is_array($files['name'])) {
            foreach ($files['name'] as $index => $name) {
                $file = [
                    'name' => $files['name'][$index],
                    'tmp_name' => $files['tmp_name'][$index],
                    'error' => $files['error'][$index],
                    'size' => $files['size'][$index]
                ];
                $results[] = $this->processFile($file);
            }
        } else {
            $results[] = $this->processFile($files);
        }

        // Retorna resultados ou erros
        if (!empty($this->errors)) {
            return $params['alert'] ? $this->formatErrorsAsAlert() : $this->errors;
        }

        return $params['returnJson'] ? json_encode($results) : implode(', ', $results);
    }

    private function processFile(array $file): ?string
    {
        // Valida o arquivo
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $this->errors[] = "Erro ao fazer upload do arquivo: {$file['name']}.";
            return null;
        }

        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

        if (!empty($this->allowedExtensions) && !in_array($extension, $this->allowedExtensions)) {
            $this->errors[] = 'O tipo de ficheiro "' . $file["name"] . '" não é aceitado, apenas ' . implode(', ', $this->allowedExtensions) . ' são permitidos.';
            return null;
        }

        // Se o parâmetro 'convert' for definido, altere a extensão
        $newExtension = $this->params['convert'] ?? null;
        if ($newExtension) {
            $extension = $newExtension;
        }

        $fileName = $this->params['rename']
            ? uniqid() . '.' . $extension
            : pathinfo($file['name'], PATHINFO_FILENAME) . '.' . $extension;

        $filePath = $this->uploadDir . $fileName;

        // Trata nomes duplicados
        if (file_exists($filePath) && !$this->params['overwrite']) {
            $fileName = $this->generateUniqueFileName($fileName);
            $filePath = $this->uploadDir . $fileName;
        }

        // Move o arquivo para o diretório de destino
        if (!move_uploaded_file($file['tmp_name'], $filePath)) {
            $this->errors[] = "Erro ao mover o arquivo {$file['name']} para o destino.";
            return null;
        }

        // Retorna o caminho relativo em relação à pasta pública
        return ltrim(string: str_replace($_SERVER['DOCUMENT_ROOT'], replace: '', subject: $filePath), characters: '/');
    }


    private function generateUniqueFileName(string $fileName): string
    {
        $pathInfo = pathinfo($fileName);
        $baseName = $pathInfo['filename'];
        $extension = $pathInfo['extension'];

        $counter = 1;
        $newFileName = $baseName . "($counter)." . $extension;
        while (file_exists($this->uploadDir . $newFileName)) {
            $counter++;
            $newFileName = $baseName . "($counter)." . $extension;
        }

        return $newFileName;
    }

    private function formatErrorsAsAlert(): never
    {
        $errorMessage = implode('<br>', $this->errors);
        $redirectUrl = $this->params['url'] ?? null;

        Notification::notify(
            title: 'Erro ao Enviar a Imagem',
            message: $errorMessage,
            level: 'error',
            type: 'sweetalert',
            position: 'top-end',
            timeout: 3000,
            redirectUrl: $redirectUrl
        );
        exit();
    }
}

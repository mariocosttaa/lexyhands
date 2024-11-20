<?php

namespace App\Services;

class FormFilter extends ServiceHelper
{
    /**
     * Filtra os dados de entrada removendo tags HTML e espaços extras.
     * 
     * @param array $data Dados brutos enviados pelo usuário (normalmente $_POST ou $_GET).
     * @return array Dados filtrados e seguros.
     */
    public static function sanitize(array $data): array
    {
        $sanitized = [];

        foreach ($data as $key => $value) {
            // Remove tags HTML e espaços extras para cada valor
            $sanitized[$key] = is_array($value) ? self::sanitize($value) : trim(strip_tags($value));
        }

        return $sanitized;
    }

    // Valida os campos com as regras fornecidas
    public static function validate(array $data, array $rules, $notifyError = false, $redirectUrl = null)
    {
        $errors = [];

        // Itera pelas regras e valida os dados
        foreach ($rules as $field => $rule) {
            // Divide a regra em tipo e outras validações
            $ruleParts = explode('|', $rule);
            $type = array_shift($ruleParts);  // O primeiro item será o tipo
            $isRequired = in_array('required', $ruleParts);  // Verifica se 'required' está nas regras
            $minLength = null;
            $maxLength = null;
            $message = null;

            // Verifica se há uma mensagem personalizada
            if (count($ruleParts) > 1) {
                $message = end($ruleParts);  // A última parte pode ser uma mensagem personalizada
                if($message == 'required' || $message == 'min' || $message != 'max') {
                    $message = null;
                }
            }

            // Verifica se existe uma limitação de caracteres
            foreach ($ruleParts as $part) {
                if (strpos($part, 'min:') === 0) {
                    $minLength  = (int) substr($part, 4);  // extrai o número após "min:"
                }
                if (strpos($part, 'max:') === 0) {
                    $maxLength = (int) substr($part, 4);  // extrai o número após "max:"
                }
            }

            // 1. Verifica se o campo é obrigatório (Primeira verificação)
            if ($isRequired && (!isset($data[$field]) || empty($data[$field]))) {
                $errors[$field][] = $message ?: ucfirst($field) . " é obrigatório.";
                continue;  // Se o campo for obrigatório e vazio, não valida mais outras regras
            }

            // 2. Verifica a limitação de caracteres (min e max) caso o campo não esteja vazio
            if (isset($data[$field])) {
                if ($minLength !== null && strlen($data[$field]) < $minLength) {
                    $errors[$field][] = $message ?? ucfirst($field) . " deve ter no mínimo $minLength caracteres.";
                }
                if ($maxLength !== null && strlen($data[$field]) > $maxLength) {
                    $errors[$field][] = $message ?? ucfirst($field) . " deve ter no máximo $maxLength caracteres.";
                }
            }

            // 3. Valida o tipo do campo (se o valor existir)
            if (isset($data[$field]) && !self::validateType($data[$field], $type)) {
                $errors[$field][] = $message ?? ucfirst($field) . " não é válido.";
            }
        }

        // Se houver erros, exibe a notificação
        if ($notifyError && !empty($errors)) {
            $errorMessages = implode('<br>', array_map(function ($fieldErrors) {
                return implode('<br>', $fieldErrors);
            }, $errors)); // Juntamos os erros de cada campo

            // Chama o serviço de notificação
            if ($redirectUrl) {
                // Redireciona com a notificação de erro
                \App\Services\Notification::notifyAfterRedirect(
                    'Erro de Validação',
                    $errorMessages,
                    level: 'error',
                    type: 'sweetalert', // Usando SweetAlert por padrão
                    position: 'center',
                    timeout: 5000,
                    redirectUrl: $redirectUrl
                );
            } else {
                // Apenas exibe a notificação sem redirecionamento
                \App\Services\Notification::notify(
                    'Erro de Validação',
                    message: $errorMessages,
                    level: 'error',
                    type: 'sweetalert', // Usando SweetAlert por padrão
                    position: 'top-end',
                    timeout: 5000
                );
            }

            return ['errors' => $errors]; // Retorna os erros
        }

        // Se não houver erros, retorna sucesso
        return ['success' => true];
    }

    // Valida o tipo de campo (ex: string, int, email)
    private static function validateType($value, $type)
    {
        switch ($type) {
            case 'string':
                return is_string($value);
            case 'int':
                return filter_var($value, filter: FILTER_VALIDATE_INT) !== false; //is_int($value);
            case 'email':
                return filter_var($value, filter: FILTER_VALIDATE_EMAIL) !== false;
            case 'url':
                return filter_var($value, filter: FILTER_VALIDATE_URL) !== false;
            case 'date':
                return strtotime($value) !== false;
            case 'float':
                return is_float($value);
            case 'bool':
                return is_bool($value);
            case 'array':
                return is_array($value);
            case 'object':
                return is_object($value);
            case 'json':
                return is_string($value) && json_decode($value) !== null;
            default:
                return true;
        }
    }
}

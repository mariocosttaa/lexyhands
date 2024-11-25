<?php

namespace App\Services;


class Money extends ServiceHelper {

    // Método para formatar o valor com base nas casas decimais e adicionar a separação de milhar
    public function formatAmount(float $amount, int $decimalPlaces = 2, ?string $currency = null): string
    {
        // Passo 1: Organiza o número considerando as casas decimais
        $amountAsString = (string) $amount;
        
        // Adiciona ponto antes das últimas casas decimais
        $amountAsString = substr($amountAsString, 0, -$decimalPlaces) . '.' . substr($amountAsString, -$decimalPlaces);

        // Passo 2: Formata o número com separador de milhar (ponto) e decimal (vírgula)
        $formattedAmount = number_format((float) $amountAsString, $decimalPlaces, ',', '.');

        return $formattedAmount;
    }

    // Método para remover caracteres não numéricos (como pontos, vírgulas) de um valor monetário
    public function sanitizeAmount(?string $amount): int|null|bool
    {
        if (empty($amount)) return false;
    
        // Remove todos os caracteres não numéricos, incluindo espaços, vírgulas e pontos
        $sanitizedAmount = preg_replace('/[^0-9]/', '', $amount);
    
        // Retorna o valor sanitizado como número inteiro
        return (int) $sanitizedAmount;
    }
    

    // Método para arredondar o número para um número específico de casas decimais, se necessário
    public function roundAmount(float $amount, int $decimalPlaces = 2): float
    {
        // A função round não altera o valor original, apenas o arredonda
        return round($amount, $decimalPlaces);
    }

    // Método para formatar um valor monetário como string com o símbolo da moeda
    public function formatCurrency(float $amount, string $currency = 'USD', int $decimalPlaces = 2): string
    {
        // Formata o número e adiciona o símbolo da moeda antes do valor
        $formattedAmount = $this->formatAmount($amount, $decimalPlaces);
        
        // Adiciona o símbolo da moeda antes do valor formatado
        switch (strtoupper($currency)) {
            case 'USD':
                return '$' . $formattedAmount;
            case 'EUR':
                return '€' . $formattedAmount;
            case 'BRL':
                return 'R$ ' . $formattedAmount;
            case 'JPY':
                return '¥' . $formattedAmount;
            default:
                return $formattedAmount;
        }
    }

    // Método para formatar um valor como moeda local (com vírgula como separador de decimais e ponto como separador de milhar)
    public function formatLocalCurrency(float $amount, int $decimalPlaces = 2): string
    {
        // Formata o valor de acordo com o padrão de moeda local (por exemplo, R$ 1.000,00)
        return number_format($amount, $decimalPlaces, ',', '.');
    }
}
?>

<?php

/**
 * Converte um número bigint em um valor decimal formatado com base no número de casas decimais.
 *
 * @param int|string $value Valor em bigint.
 * @param int $decimalPlaces Número de casas decimais (exemplo: 2 para centavos).
 * @return string Valor formatado como string, com separador decimal.
 */
function currencyOrganizer($value, int $decimalPlaces = 2): string
{
    // Certifique-se de que o valor é um número válido.
    if (!is_numeric($value)) {
        throw new InvalidArgumentException("O valor fornecido deve ser um número.");
    }

    // Converte para string para manipular os dígitos.
    $value = (string)$value;

    // Adiciona zeros à esquerda, se necessário, para evitar erro ao calcular as casas decimais.
    $value = str_pad($value, $decimalPlaces + 1, '0', STR_PAD_LEFT);

    // Calcula o ponto de separação entre a parte inteira e decimal.
    $integerPart = substr($value, 0, -$decimalPlaces);
    $decimalPart = substr($value, -$decimalPlaces);

    // Retorna o valor formatado como string.
    return $integerPart . '.' . $decimalPart;
}


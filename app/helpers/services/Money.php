<?php

use App\Services\Money;

function sanitazeMoney(?string $amount): mixed {
    if(empty($amount)) return null;
    return (new Money())->sanitizeAmount(amount: $amount);
}

function formatMoney(?float $amount, ?int $decimalPlaces = 2, ?string $currency = null, ?bool $formatWithSymbol = false): string|null {
    if(empty($amount)) return null;
    return (new Money())->formatAmount(amount: $amount, decimalPlaces: $decimalPlaces, currency: $currency, formatWithSymbol: $formatWithSymbol);
};


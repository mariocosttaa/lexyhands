<?php

use  App\Models\currencies as Currencies;

function getCurrencyByCode(?string $code = null): bool|object {
    if(empty($code)) return false;
    return Currencies::getByCode(code: $code);
}
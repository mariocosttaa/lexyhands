<?php

use App\Services\UserDate;

function getUserDateTime($date = null, $format = null): string {
    $userDate = new UserDate();
    return $userDate->userDateTime(utcDate: $date, format: $format);
}
<?php

use App\Models\Users;

function getUser($id, ?bool $forceHave = true):mixed {
    if(empty($id)) return false;
    return Users::getByUserId(user_id: $id, forceHave: $forceHave);
}

function getInitials(string $name, ?string $surname = null):string {
    if(empty($name)) return false;

    if (!empty($name)) {
        $initials = mb_strimwidth($name, 0, 1);
    }
    if (!empty($surname)) {
        $initials .= mb_strimwidth($surname, 0, 1);
    }
    return strtoupper($initials);
}

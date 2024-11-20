<?php

use App\Models\Users;

function getUser(int $id, ?bool $forceHave = true):mixed {
    if(empty($id)) return false;
    return Users::getByUserId(user_id: $id, forceHave: $forceHave);
}
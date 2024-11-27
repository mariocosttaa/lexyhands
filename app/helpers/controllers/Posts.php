<?php

use App\Models\Posts as Posts;
use App\Models\Posts_categorys as PostsCategorys;
use App\Models\Posts_comments as PostsComments;

function getPostCategory($id): mixed {
    if(empty($id)) return false;
    return PostsCategorys::getById($id);
}

function countByPost(int $id): mixed {
    if(empty($id)) return false;
    return PostsComments::countByPost(id: $id);
}

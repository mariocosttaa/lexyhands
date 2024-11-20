<?php

use App\Models\posts as Posts;
use App\Models\posts_categorys as PostsCategorys;
use App\Models\posts_comments as PostsComments;

function getPostCategory($id): mixed {
    if(empty($id)) return false;
    return PostsCategorys::getById($id);
}

function countByPost(int $id): mixed {
    if(empty($id)) return false;
    return PostsComments::countByPost(id: $id);
}

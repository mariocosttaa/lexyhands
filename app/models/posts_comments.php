<?php 

namespace App\Models;
use App\Models\Posts;

class Posts_comments extends ModelHelper {

    public static function create($data): void {
        if(empty($data)) return;
        parent::SQL_EASY_INSERT(table: 'posts_comments', data: $data);
    }
    
    public static function delete($id): void {
        if(empty($id)) return;
        parent::SQL_EASY_DELETE(table: 'posts_comments', where: ['id' => $id]);
    }

    public static  function update($id, $data): void {
        if(empty($id) || empty($data)) return;
        parent::SQL_EASY_UPDATE(table: 'posts_comments', data: $data, where: ['id' => $id]);
    }

    public static function getAll($order = null, $limit = null): mixed {
        return parent::SQL_EASY_SELECT(table: 'posts_comments', where: null, limit: $limit, order: $order);
    }

    public static function getById($id): mixed {
        if(empty($id)) return false;
        return parent::SQL_EASY_SELECT('posts_comments', where: ['id' => $id], limit: null, order: null, object: true);
    }

    public static function getByPostId(int $id): mixed {
        if(empty($id)) return false;
        return parent::SQL_EASY_SELECT(table: 'posts_comments', where: ['post_id' => $id], limit: null, order: null);
    }

    public static function countByPost(int $id): mixed {
        if(empty($id)) return false;
        return parent::SQL_EASY_COUNT(table: 'posts_comments', where: ['post_id' => $id]);
    }

}
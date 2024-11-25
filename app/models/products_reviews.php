<?php 

namespace App\Models;

class products_reviews extends ModelHelper {

    public static function create($data): bool|null {
        if(empty($data)) return false;
        return parent::SQL_EASY_INSERT(table: 'products_reviews', data: $data);
    }
    
    public static function delete($id): void {
        if(empty($id)) return;
        parent::SQL_EASY_DELETE(table: 'products_reviews', where: ['id' => $id]);
    }

    public static function update($id, $data): void {
        if(empty($id) || empty($data)) return;
        parent::SQL_EASY_UPDATE(table: 'products_reviews', data: $data, where: ['id' => $id]);
    }

    public static function getAll($order = null) {
        return parent::SQL_EASY_SELECT('products_reviews', where: null, limit: null, order: $order);
    }

    public static function getById($id): mixed {
        if(empty($id)) return false;
        return parent::SQL_EASY_SELECT('products_reviews', where: ['id' => $id], limit: null, order: null, object: true);
    }

    public static function getByEmail($email): mixed {
        if(empty($email)) return false;
        return parent::SQL_EASY_SELECT('products_reviews', where: ['email' => $email], limit: null, order: null, object: true);
    }

    


}
<?php 

namespace App\Models;

class products_reviews extends ModelHelper {

    public function create($data): void {
        if(empty($data)) return;
        parent::SQL_EASY_INSERT(table: 'products_reviews', data: $data);
    }
    
    public function delete($id): void {
        if(empty($id)) return;
        parent::SQL_EASY_DELETE(table: 'products_reviews', where: ['id' => $id]);
    }

    public function update($id, $data): void {
        if(empty($id) || empty($data)) return;
        parent::SQL_EASY_UPDATE(table: 'products_reviews', data: $data, where: ['id' => $id]);
    }

    public function getAll($order = null) {
        return parent::SQL_EASY_SELECT('products_reviews', where: null, limit: null, order: $order);
    }

    public function getById($id): mixed {
        if(empty($id)) return false;
        return parent::SQL_EASY_SELECT('products_reviews', where: ['id' => $id], limit: null, order: null, object: true);
    }

    public function getByEmail($email): mixed {
        if(empty($email)) return false;
        return parent::SQL_EASY_SELECT('products_reviews', where: ['email' => $email], limit: null, order: null, object: true);
    }

    


}
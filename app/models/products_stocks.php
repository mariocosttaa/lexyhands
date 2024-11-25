<?php 

namespace App\Models;

class products_stocks extends ModelHelper {

    public static function create($data): bool|object {
        if(empty($data)) return false;
        return parent::SQL_EASY_INSERT(table: 'products_stocks', data: $data);
    }
    
    public static function delete($id): bool|null {
        if(empty($id)) return false;
        return parent::SQL_EASY_DELETE(table: 'products_stocks', where: ['id' => $id]);
    }

    public static  function update($id, $data): void {
        if(empty($id) || empty($data)) return;
        parent::SQL_EASY_UPDATE(table: 'products_stocks', data: $data, where: ['id' => $id]);
    }

    public static function getAll($order = null, $limit = null): mixed {
        return parent::SQL_EASY_SELECT(table: 'products_stocks', where: null, limit: $limit, order: $order);
    }

    public static function getById($id): mixed {
        if(empty($id)) return false;
        return parent::SQL_EASY_SELECT('products_stocks', where: ['id' => $id], limit: null, order: null, object: true);
    }
   
    public static function getAllByProductId($product_id, $order = null, $limit = null): mixed {
        if(empty($product_id)) return false;
        return parent::SQL_EASY_SELECT(table: 'products_stocks', where: ['product_id' => $product_id], limit: $limit, order: $order);
    }

}
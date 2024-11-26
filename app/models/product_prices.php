<?php 

namespace App\Models;

class product_prices extends ModelHelper {

    public static function create($data): int|null|bool {
        if(empty($data)) return false;
        return parent::SQL_EASY_INSERT(table: 'product_prices', data: $data);
    }
    
    public static function delete($id): void {
        if(empty($id)) return;
        parent::SQL_EASY_DELETE(table: 'product_prices', where: ['id' => $id]);
    }

    public static  function update($id, $data): int|null|bool {
        if(empty($id) || empty($data)) return false;
        return parent::SQL_EASY_UPDATE(table: 'product_prices', data: $data, where: ['id' => $id]);
    }


    public static function getAll($order = null, $limit = null): mixed {
        return parent::SQL_EASY_SELECT(table: 'product_prices', where: null, limit: $limit, order: $order);
    }

    public static function getById($id): mixed {
        if(empty($id)) return false;
        return parent::SQL_EASY_SELECT('product_prices', where: ['id' => $id], limit: null, order: null, object: true);
    }

    public static function getByProductId($id): mixed {
        if(empty($id)) return false;
        return parent::SQL_EASY_SELECT('product_prices', where: ['product_id' => $id], limit: null, order: null, object: false);
    }
   
    public static function deleteByProductId(? int $id): bool|null {
        if(empty($id)) return false;
        return parent::SQL_EASY_DELETE('product_prices', where: ['product_id' => $id]);
    }

    public static function getAllByProductId($product_id, $order = null, $limit = null): mixed {
        if(empty($product_id)) return false;
        return parent::SQL_EASY_SELECT(table: 'product_prices', where: ['product_id' => $product_id], limit: $limit, order: $order);
    }

}
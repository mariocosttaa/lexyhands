<?php 

namespace App\Models;

class products extends ModelHelper {

    public static function create($data): void {
        if(empty($data)) return;
        parent::SQL_EASY_INSERT(table: 'products', data: $data);
    }
    
    public static function delete($id): void {
        if(empty($id)) return;
        parent::SQL_EASY_DELETE(table: 'products', where: ['id' => $id]);
    }

    public static  function update($id, $data): void {
        if(empty($id) || empty($data)) return;
        parent::SQL_EASY_UPDATE(table: 'products', data: $data, where: ['id' => $id]);
    }

    public static function getAll($order = null, $limit = null): mixed {
        return parent::SQL_EASY_SELECT(table: 'products', where: null, limit: $limit, order: $order);
    }

    public static function getById($id): mixed {
        if(empty($id)) return false;
        return parent::SQL_EASY_SELECT('products', where: ['id' => $id], limit: null, order: null, object: true);
    }
   
    public static function getAllByServiceId($service_id, $order = null, $limit = null): mixed {
        if(empty($service_id)) return false;
        return parent::SQL_EASY_SELECT(table: 'products', where: ['service_id' => $service_id], limit: $limit, order: $order);
    }

}
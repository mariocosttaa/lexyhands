<?php 

namespace App\Models;

class services extends ModelHelper {

    public static function create($data): void {
        if(empty($data)) return;
        parent::SQL_EASY_INSERT(table: 'services', data: $data);
    }
    
    public static function delete($id): void {
        if(empty($id)) return;
        parent::SQL_EASY_DELETE(table: 'services', where: ['id' => $id]);
    }

    public static  function update($id, $data): void {
        if(empty($id) || empty($data)) return;
        parent::SQL_EASY_UPDATE(table: 'services', data: $data, where: ['id' => $id]);
    }

    public static function getAll($order = null, $limit = null): mixed {
        return parent::SQL_EASY_SELECT(table: 'services', where: null, limit: $limit, order: $order);
    }

    public static function getById($id): mixed {
        if(empty($id)) return false;
        return parent::SQL_EASY_SELECT('services', where: ['id' => $id], limit: null, order: null, object: true);
    }
   
    public static function getAllExceptThis($id, $order, $limit): mixed {
        if(empty($id)) return false;
        return parent::SQL_EASY_SELECT(table: 'services', where: ['id' => [ '!=', $id]], limit: $limit, order: $order, object: false);
    }


}
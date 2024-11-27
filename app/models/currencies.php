<?php

namespace App\Models;

class Currencies extends ModelHelper {

    public static function create(array $data = []): bool {
        if(empty($data)) return false;
        return parent::SQL_EASY_INSERT(table: 'currencies', data: $data);
    }
    
    public static function delete($id): bool|object {
        if(empty($id)) return false;
        return parent::SQL_EASY_DELETE(table: 'currencies', where: ['id' => $id]) ?: false;
    }

    public static  function update($id, $data): void {
        if(empty($id) || empty($data)) return;
        parent::SQL_EASY_UPDATE(table: 'currencies', data: $data, where: ['id' => $id]);
    }

    public static function getAll($order = null, $limit = null): mixed {
        return parent::SQL_EASY_SELECT(table: 'currencies', where: null, limit: $limit, order: $order);
    }

    public static function getById($id): bool|object|null {
        if(empty($id)) return false;
        return parent::SQL_EASY_SELECT('currencies', where: ['id' => $id], limit: null, order: null, object: true);
    }
   
    public static function getByCode(string $code): bool|object|null {
        if(empty($code)) return false;
        $code = strtolower(string: $code);
        return parent::SQL_EASY_SELECT('currencies', where: ['code' => $code], limit: null, order: null, object: true);
    }

}
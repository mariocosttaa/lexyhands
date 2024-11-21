<?php

namespace App\Models;

class roles extends ModelHelper
{
    public static  function create($data): void {
        if(empty($data)) return;
        parent::SQL_EASY_INSERT('roles', $data);
    }
    
    public static  function delete($id): void {
        if(empty($id)) return;
        parent::SQL_EASY_DELETE('roles', where: ['id' => $id]);
    }

    public static  function update($id, $data): void {
        if(empty($id) || empty($data)) return;
        parent::SQL_EASY_UPDATE('roles', data: $data, where: ['id' => $id]);
    }

    public static  function getAll($order = null) {
        return parent::SQL_EASY_SELECT('roles', where: null, limit: null, order: $order);
    }

    public static  function getById($id): mixed {
        if(empty($id)) return false;
        return parent::SQL_EASY_SELECT('roles', where: ['id' => $id], limit: null, order: null, object: true);
    }

}
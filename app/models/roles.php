<?php

namespace App\Models;

class roles extends ModelHelper
{
    public function create($data): void {
        if(empty($data)) return;
        parent::SQL_EASY_INSERT('roles', $data);
    }
    
    public function delete($id): void {
        if(empty($id)) return;
        parent::SQL_EASY_DELETE('roles', where: ['id' => $id]);
    }

    public function update($id, $data): void {
        if(empty($id) || empty($data)) return;
        parent::SQL_EASY_UPDATE('roles', data: $data, where: ['id' => $id]);
    }

    public function getAll($order = null) {
        return parent::SQL_EASY_SELECT('roles', where: null, limit: null, order: $order);
    }

    public function getById($id): mixed {
        if(empty($id)) return false;
        return parent::SQL_EASY_SELECT('roles', where: ['id' => $id], limit: null, order: null, object: true);
    }

}
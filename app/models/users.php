<?php 

namespace App\Models;

class users extends ModelHelper {

    public static function create($data): void {
        if(empty($data)) return;
        parent::SQL_EASY_INSERT('users', $data);
    }
    
    public static function delete($id): void {
        if(empty($id)) return;
        parent::SQL_EASY_DELETE('users', ['id' => $id]);
    }

    public static function update($id, $data): void {
        if(empty($id) || empty($data)) return;
        parent::SQL_EASY_UPDATE('users', data: $data, where: ['id' => $id]);
    }

    public static function getAll($order = null) {
        return parent::SQL_EASY_SELECT(table: 'users', where: null, limit: null, order: $order);
    }

    public static function getById($id): mixed {
        if(empty($id)) return false;
        return parent::SQL_EASY_SELECT('users', where: ['id' => $id], limit: null, order: null, object: true);
    }

    public static function getByUserId(int $user_id, ?bool $forceHave = true): mixed {
        if(empty($user_id)) return false;
        $result =  parent::SQL_EASY_SELECT(table: 'users', where: ['user_id' => $user_id], limit: null, order: null, object: true);
        if($result) {
            $result->names = $result->name . ' ' . $result->surname;
        } else if($forceHave && !$result) {
            $result = [];
            $result = (object) $result;
            $result->name = 'Usuário Apagado';
            $result->names = 'Usuário Apagado';
            $result->user_id = '00000';
            $result->id = '0';
        }

        return $result;
    }


    public static function getByEmail($email): mixed {
        if(empty($email)) return false;
        return parent::SQL_EASY_SELECT('users', where: ['email' => $email], limit: null, order: null, object: true);
    }

    


}
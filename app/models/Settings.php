<?php

namespace App\Models;

class Settings extends ModelHelper {

    public static function tableName(): string {
        return strtolower(str_replace(__NAMESPACE__ . '\\', '', static::class));
    }

    public static  function update(?array $data): int|null|bool {
        if(empty($data)) return false;
        return parent::SQL_EASY_UPDATE(table: self::tableName(), data: $data);
    }

    public static function get(): bool|object {
        return parent::SQL_EASY_SELECT(table: self::tableName(), where: null, limit: 1, order: null, object: true);
    }

    public static function countAll(): ?int {
        return parent::SQL_EASY_COUNT(table: self::tableName(), where: null);
    }

}
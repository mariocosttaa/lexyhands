<?php

namespace App\Models;

class Settings extends ModelHelper {

    public static function tableName(): string {
        return strtolower(str_replace(__NAMESPACE__ . '\\', '', static::class));
    }

    public static  function update(?array $data): int|null|bool {
        if(empty($data)) return false;
        
        // Check if settings record exists
        $existing = self::get();
        
        if ($existing === false) {
            // No settings record exists, create one
            return parent::SQL_EASY_INSERT(table: self::tableName(), data: $data);
        } else {
            // Settings record exists, update it (assuming id = 1 or update first record)
            // Since settings should only have one record, update by id
            if (isset($existing->id)) {
                return parent::SQL_EASY_UPDATE(table: self::tableName(), data: $data, where: ['id' => $existing->id]);
            } else {
                // Fallback: update without WHERE (should only be one row anyway)
                return parent::SQL_EASY_UPDATE(table: self::tableName(), data: $data);
            }
        }
    }

    public static function get(): bool|object {
        return parent::SQL_EASY_SELECT(table: self::tableName(), where: null, limit: 1, order: null, object: true);
    }

    public static function countAll(): ?int {
        return parent::SQL_EASY_COUNT(table: self::tableName(), where: null);
    }

}
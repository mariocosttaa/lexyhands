<?php

namespace App\Models;
use App\Services\SqlEasy;

class ModelHelper {
    public static function getTableName($className) {
        return strtolower($className);
    }

    public static function SQL_EASY_COUNT($table, $where = null) {
        $sqlEasy = new SqlEasy();
        return $sqlEasy->count($table, $where);
    }


    public static function SQL_EASY_INSERT($table, $data = array()) {
        $sqlEasy = new SqlEasy();
        return $sqlEasy->insert($table, $data);
    }

    public static function SQL_EASY_SELECT($table,  $where = array(), $limit = null, $order = null, $object = null, $operator = 'AND') {
        $sqlEasy = new SqlEasy();
        return $sqlEasy->select($table, $where, $limit, $order, $object, operator: $operator);
    }

    public static function SQL_EASY_UPDATE($table, $data = array(), $where = array()) {
        $sqlEasy = new SqlEasy();
        return $sqlEasy->update($table, $data, $where);
    }

    public static function SQL_EASY_DELETE($table, $where = array()) {
        $sqlEasy = new SqlEasy();
        return $sqlEasy->delete($table, $where);
    }

    public static function SQL_EASY_CREATE_TABLE($table, $data = array()) {
        $sqlEasy = new SqlEasy();
        return $sqlEasy->create_table($table, $data);
    }

    public static function SQL_EASY_DELETE_TABLE($table) {
        $sqlEasy = new SqlEasy();
        return $sqlEasy->delete_table($table);
    }

}
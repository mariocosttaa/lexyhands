<?php

namespace App\Models;

class Services_price extends ModelHelper
{
    public static function create(array $data = []): bool
    {
        if (empty($data)) return false;
        return parent::SQL_EASY_INSERT(table: 'services_price', data: $data);
    }

    public static function delete($id): bool
    {
        if (empty($id)) return false;
        return parent::SQL_EASY_DELETE(table: 'services_price', where: ['id' => $id]) ?: false;
    }

    public static function update($id, $data): void
    {
        if (empty($id) || empty($data)) return;
        parent::SQL_EASY_UPDATE(table: 'services_price', data: $data, where: ['id' => $id]);
    }

    public static function getAll($order = null, $limit = null): mixed
    {
        return parent::SQL_EASY_SELECT(table: 'services_price', where: null, limit: $limit, order: $order);
    }

    public static function getById($id): mixed
    {
        if (empty($id)) return false;
        return parent::SQL_EASY_SELECT('services_price', where: ['id' => $id], limit: null, order: null, object: true);
    }

    public static function getAllByServiceId($service_id, $order = 'sort_order ASC, id ASC'): mixed
    {
        if (empty($service_id)) return false;
        $result = parent::SQL_EASY_SELECT(table: 'services_price', where: ['service_id' => $service_id], limit: null, order: $order, object: false);
        return $result ?: [];
    }

    public static function deleteByServiceId($service_id): bool
    {
        if (empty($service_id)) return false;
        return parent::SQL_EASY_DELETE(table: 'services_price', where: ['service_id' => $service_id]) ?: false;
    }
}

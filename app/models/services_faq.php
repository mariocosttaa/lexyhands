<?php 

namespace App\Models;
use App\Models\Services;

class Services_faq extends ModelHelper {

    public static function create($data): void {
        if(empty($data)) return;
        parent::SQL_EASY_INSERT(table: 'services_faq', data: $data);
    }
    
    public static function delete($id): void {
        if(empty($id)) return;
        parent::SQL_EASY_DELETE(table: 'services_faq', where: ['id' => $id]);
    }

    public static  function update($id, $data): void {
        if(empty($id) || empty($data)) return;
        parent::SQL_EASY_UPDATE(table: 'services_faq', data: $data, where: ['id' => $id]);
    }

    public static function getAll($order = null, $limit = null): mixed {
        return parent::SQL_EASY_SELECT(table: 'services_faq', where: null, limit: $limit, order: $order);
    }

    public static function getById($id): mixed {
        if(empty($id)) return false;
        return parent::SQL_EASY_SELECT('services_faq', where: ['id' => $id], limit: null, order: null, object: true);
    }
   
    public static function getAllByServiceId($service_id, $order = null, $limit = null): mixed {
        if(empty($service_id)) return false;
        return parent::SQL_EASY_SELECT(table: 'services_faq', where: ['service_id' => $service_id], limit: $limit, order: $order);
    }

}
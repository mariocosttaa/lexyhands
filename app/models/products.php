<?php 

namespace App\Models;
use App\Models\product_prices as ProductPrices;

class products extends ModelHelper {

    public static function create($data): int|null|bool {
        if(empty($data)) return false;
        return parent::SQL_EASY_INSERT(table: 'products', data: $data);
    }
    
    public static function delete($id): bool|null {
        if(empty($id)) return false;
        return parent::SQL_EASY_DELETE(table: 'products', where: ['id' => $id]);
    }

    public static  function update($id, $data): int|null|bool {
        if(empty($id) || empty($data)) return false;
        return parent::SQL_EASY_UPDATE(table: 'products', data: $data, where: ['id' => $id]);
    }

    public static function getAll($order = null, $limit = null): mixed {
        return parent::SQL_EASY_SELECT(table: 'products', where: null, limit: $limit, order: $order);
    }

    public static function getById($id): mixed {
        if(empty($id)) return false;
        $result = parent::SQL_EASY_SELECT('products', where: ['id' => $id], limit: null, order: null, object: true);
        return $result = self::addKeys(result: $result); 
    }

    public static function countAll(): ?int {
        return parent::SQL_EASY_COUNT(table: 'products', where: null);
    }
   
    public static function getAllByServiceId($service_id, $order = null, $limit = null): mixed {
        if(empty($service_id)) return false;
        return parent::SQL_EASY_SELECT(table: 'products', where: ['service_id' => $service_id], limit: $limit, order: $order);
    }

    public static function getByName(?string $name): bool|object|null {
        if(empty($name)) return false;
        $result = parent::SQL_EASY_SELECT(table: 'products', where: ['name' => $name], limit: null, order: null, object: true);
        return $result = self::addKeys(result: $result); 
    }

    public static function getByIdentificator(?string $identificator): bool|object|null {
        if(empty($identificator)) return false;
        $result = parent::SQL_EASY_SELECT(table: 'products', where: ['identificator' => $identificator], limit: null, order: null, object: true);
        return $result = self::addKeys(result: $result); 
    }
    
    private static function addKeys($result): mixed {
        if(empty($result)) return false;
        
         $result->prices = ProductPrices::getByProductId($result->id);

        return $result;
    }

}
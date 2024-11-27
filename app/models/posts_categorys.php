<?php 

namespace App\Models;
use App\Services\SlugGenerator as Slug;

class Posts_categorys extends ModelHelper {

    public static function create($data): bool|null {
        if(empty($data)) return false;
        return parent::SQL_EASY_INSERT(table: 'posts_categorys', data: $data);
    }
    
    public static function delete($id): void {
        if(empty($id)) return;
        parent::SQL_EASY_DELETE(table: 'posts_categorys', where: ['id' => $id]);
    }

    public static  function update($id, $data): bool|null {
        if(empty($id) || empty($data)) return false;
        return parent::SQL_EASY_UPDATE(table: 'posts_categorys', data: $data, where: ['id' => $id]);
    }

    public static function getAll($order = null, $limit = null, ?int $differnt = null): bool|array {
        if($differnt) {
            return parent::SQL_EASY_SELECT(table: 'posts_categorys', where: ['id' => ['!=', $differnt]], limit: $limit, order: $order, object: false);
        } else {
            return parent::SQL_EASY_SELECT(table: 'posts_categorys', where: null, limit: $limit, order: $order);
        }
    }

    public static function getById($id): mixed {
        if(empty($id)) return false;
        $result = parent::SQL_EASY_SELECT('posts_categorys', where: ['id' => $id], limit: null, order: null, object: true);
        $result = self::addKeys(result: $result);
        return $result;
    }

    public static function getByidentificator(string $identificator): bool|object {
        if(empty($identificator)) return false;
        $result = parent::SQL_EASY_SELECT('posts_categorys', where: ['identificator' => $identificator], limit: null, order: null, object: true);
        $result = self::addKeys(result: $result);
        return $result;
    }


    public static function checkCategoryNameLike(string $categoryName):bool {
        if(empty($categoryName)) return false;
        $result = parent::SQL_EASY_SELECT(table: 'posts_categorys', where: ['name' => ['LIKE', "%$categoryName%"]], limit: null, order: null, object: false);
        return $result ?: false;
    }

    public static function getCategoryByName(string $name) :bool|object {
        if (empty($name)) return false;
        $result = parent::SQL_EASY_SELECT(table: 'posts_categorys', where: ['name' => $name], limit: null, order: null, object: true);
        $result = self::addKeys(result: $result);
        return $result;
    }
   
    private static function addKeys($result): mixed {
        if(empty($result)) return false;
            $result->link = '/' . ( new Slug )->generate(string: $result->name) . '/' . $result->id;

        //para as tags ja virem como array
        if(!empty($result->tags)) { 
            $result->tags = json_decode(json: $result->tags, associative: true); 
        } else {
            $result->tags = []; 
        }

        return $result;
    }

}
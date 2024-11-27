<?php 

namespace App\Models;
use App\Services\SlugGenerator as Slug;
use App\Models\Posts_comments as PostsComments;
use App\Models\Posts_categorys as PostsCategory;

class Posts extends ModelHelper {

    public static function create($data): bool|object {
        if(empty($data)) return false;
        return parent::SQL_EASY_INSERT(table: 'posts', data: $data);
    }
    
    public static function delete($id): void {
        if(empty($id)) return;
        parent::SQL_EASY_DELETE(table: 'posts', where: ['id' => $id]);
    }

    public static  function update($id, $data): bool|object {
        if(empty($id) || empty($data)) return false;
        return parent::SQL_EASY_UPDATE(table: 'posts', data: $data, where: ['id' => $id]);
    }

    public static function getAll($order = null, $limit = null): mixed {
        return parent::SQL_EASY_SELECT(table: 'posts', where: null, limit: $limit, order: $order);
    }

    public static function getById($id): mixed {
        if(empty($id)) return false;
        $result = parent::SQL_EASY_SELECT('posts', where: ['id' => $id], limit: null, order: null, object: true);
        if($result): $result = self::addKeys(result: $result); endif; 
        return $result;
    }
   
    public static function countAll(): ?int {
        return parent::SQL_EASY_COUNT(table: 'posts', where: null);
    }

    public static function getFromIdentificator($id, $identificator, $date) {
        if(empty($id) || empty($identificator) || empty($date)) return false;
        $day = date('d', strtotime(datetime: $date));
        $month = date('m', strtotime(datetime: $date));
        $year = date('Y', strtotime(datetime: $date));
        $result =  parent::SQL_EASY_SELECT(table: 'posts', where: ['id' => $id, 'identificator' => $identificator, 'date' => [ 'day' => $day, 'month' => $month, 'year' => $year ]], limit: null, order: null, object: true);
        
        if($result): $result = self::addKeys(result: $result); endif; 
        return $result;

    }

    public static function checkTittleExist(string $tittle):bool|object {
        if(empty($name)) return false;
        return parent::SQL_EASY_SELECT(table: 'posts', where: ['tittle' => $tittle], limit: null, order: null, object: true);
    }

    public static function getFromIdetificatorOnly(string $identificator):bool|object{
        if(empty($identificator)) return false;
        return parent::SQL_EASY_SELECT(table: 'posts', where: ['identificator' => $identificator], limit: null, order: null, object: true);
    }

    public static function getAllFromCategory(int $category = null, ?string $order = null, ?int $limit = null):bool|array {
        if(empty($category)) return false;
        return parent::SQL_EASY_SELECT(table: 'posts', where: ['category' => $category], limit: $limit, order: $order, object: false);
    }

    public static function searchPosts(?string $param = null):bool|array {
        if(empty($param)) return false;
        $result = parent::SQL_EASY_SELECT(table: 'posts', where: [
            'tittle' => ['LIKE', "%$param%"],
            'tags' => ['LIKE', "%$param%"],
            'content' => ['LIKE', "%$param%"],
            'subtittle' => ['LIKE', "%$param%"],
            'date' => ['LIKE', "%$param%"]
        ], limit: null, order: 'id DESC', object: false,  operator: 'OR');

        if($result): $result = self::addKeys(result: $result); endif; 
        return $result;
    }

    public static function lastPosts(?int $id = null, ?string $order = null, ?int $limit = null): bool|array {
        if($id) {
            $result = parent::SQL_EASY_SELECT(table: 'posts', where: ['id' => ['!=', $id]], limit: $limit, order: $order, object: false);
        } else {
            $result = parent::SQL_EASY_SELECT(table: 'posts', where: null, limit: $limit, order: $order, object: false);
        }
        return $result ?: false;
    }

    public static function getByTaagName(string $name): mixed {
        if(empty($name)) return false;
        $result = parent::SQL_EASY_SELECT(table: 'posts', where: ['tags' => ['LIKE', "%$name%"]], limit: null, order: null, object: false);
        return $result ?: false;
    }



    //essa função n é performática, depois deve se fazer outra nova...
    public static function getAllTags(?int $id = null): array {
        if($id) {
            $result = parent::SQL_EASY_SELECT(table: 'posts', where: ['id' => ['!=', $id]], limit: null, order: null, object: false);
        } else {
            $result = parent::SQL_EASY_SELECT(table: 'posts');
        }
        if (empty($result)) return [];
        $tags = [];
        foreach ($result as $post) {
            if (!empty($post['tags'])) {
                $postTags = json_decode($post['tags'], true);
                foreach ($postTags as $tag) {
                    $tag = ucfirst(strtolower($tag));
                    if (!in_array($tag, $tags)) {
                        $tags[] = $tag;
                    }
                }
            }
        }
        return $tags;
    }




    private static function addKeys($result): mixed {
        if(empty($result)) return false;
        
        if(!empty($result->tittle) || !empty($result->date) || !empty($result->id)):
            $result->link = self::constructPostLink(tittle: $result->tittle, date: $result->date, id: $result->id); endif;

            $result->previusPost = self::getPreviousPostFromThis(id: $result->id);
            $result->nextPost = self::getNextPostFromThis(id: $result->id);
            $result->countComments = PostsComments::countByPost(id: $result->id);
            $result->comments = PostsComments::getByPostId(id: $result->id);
            $result->category = PostsCategory::getById(id: $result->category);

        //para as tags ja virem como array
        if(!empty($result->tags)) { 
            $result->tags = json_decode(json: $result->tags, associative: true); 
        } else {
            $result->tags = []; 
        }

        return $result;
    }

    
    private static function getNextPostFromThis(int $id):mixed {
        if(empty($id)) return false;
        $result = parent::SQL_EASY_SELECT(
            table: 'posts',
            where: ['id' => ['>', $id]],
            limit: 1,
            order: 'id ASC',
            object: true
        );
        if($result) $result->link = self::constructPostLink(tittle: $result->tittle, date: $result->date, id: $result->id);
        return $result;
        
    }

    private static function getPreviousPostFromThis(int $id):mixed {
        if(empty($id)) return false;
        $result = parent::SQL_EASY_SELECT(
            table: 'posts',
            where: ['id' => ['<', $id]],
            limit: 1,
            order: 'id DESC',
            object: true
        );
        if($result) $result->link = self::constructPostLink(tittle: $result->tittle, date: $result->date, id: $result->id);
        return $result;
    }

    private static function constructPostLink(string $tittle, string $date, int $id): string {
        if(empty($tittle) || empty($date) || empty($id)) return false;
        $date = date('d-m-Y', strtotime($date));
        $tittleSlug = (new Slug)->generate(string: $tittle);
        return "/posts/".$tittleSlug."/" . $date ."/". $id;  
    }


}
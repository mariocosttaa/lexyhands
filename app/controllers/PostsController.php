<?php

namespace App\Controllers;

use App\Models\posts as Posts;
use App\Models\posts_category as PostsCategory;
use App\Models\posts_comments as PostsComments;
use App\Services\SlugGenerator as Slug;
use App\Models\posts_categorys as PostsCategorys;

class PostsController extends ControllerHelper
{
    public static function index(): void
    {
        parent::renderView(array: ['type' => 'public', 'view' => 'posts/index.php', 'layoutChange' => ['pageName' => 'Lexy Hands']], strings: [
            'posts' => Posts::getAll(order: 'id DESC'),
        ]);
    }


    public static function view($identificator, $date, $id): void
    {

        $post = Posts::getFromIdentificator(id: $id, identificator: $identificator, date: $date);
        if (!$post) {
            parent::render404(); //página 404
            exit();
        }
        $post = Posts::getById(id: $id);
        parent::renderView(array: ['type' => 'public', 'view' => 'posts/view.php', 'layoutChange' => ['pageName' => $post->tittle]], strings: [
            'post' => $post,
            'lastPosts' => Posts::lastPosts(id: $id, order: 'id DESC', limit: 3),
            'categories' => PostsCategorys::getAll(order: 'id DESC', limit: 4, differnt: $post->category->id),
            'tags' => Posts::getAllTags(id: $id),
        ]);
    }

    public static function search(): void
    {
        $param = isset($_GET['param']) ? $_GET['param'] : null;
        $posts = Posts::searchPosts(param: $param);
        if (!$posts) $posts = Posts::getAll(order: 'id DESC', limit: 10);

        parent::renderView(array: ['type' => 'public', 'view' => 'posts/categories/view.php', 'layoutChange' => ['pageName' => 'Comunidade']], strings: [
            'posts' => $posts,
        ]);
    }


    public function categories(): void
    {
        parent::renderView(array: ['type' => 'public', 'view' => 'posts/categories/index.php', 'layoutChange' => ['pageName' => 'Comunidade']], strings: [
            'categories' => PostsCategorys::getAll('id Desc'),
        ]);
    }

    public function categorysView(string $identificator): void { 
        
        $category = PostsCategorys::getByidentificator(identificator: $identificator);
        if(!$category) {
            parent::render404(); //página 404
            exit();
        }

         parent::renderView(array: ['type' => 'public', 'view' => 'posts/categories/view.php', 'layoutChange' => ['pageName' => 'Comunidade']], strings: [
            'posts' => Posts::getAllFromCategory($category->id, order: 'id DESC'),
            'category' => $category->name,
        ]);
    

    }

    public function tags(): void
    {
        parent::renderView(array: ['type' => 'public', 'view' => 'posts/tags/index.php', 'layoutChange' => ['pageName' => 'Comunidade']], strings: [
            'tags' => Posts::getAllTags(),
        ]);

    }

    public static function tagsView($name): void
    {
        $tag = deslug(string: $name); //ajustar para chamar a função ideal o objecto
        $posts = Posts::getByTaagName(name: $tag);

        if ($posts) {
            parent::renderView(array: ['type' => 'public', 'view' => 'posts/tags/view.php', 'layoutChange' => ['pageName' => $tag]], strings: [
                'posts' => $posts,
                'tag' => $tag,
            ]);
        } else {
            parent::render404();
        }
    }
}

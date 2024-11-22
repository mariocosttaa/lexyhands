<?php 

namespace App\Controllers;
use App\Models\posts_categorys as PostsCategorys;

class CategoriesAdminController extends ControllerHelper { 

    public static function index() {
        parent::renderView(array: ['type' => 'private', 'view' => 'posts/categories/index.php', 'layoutChange' => ['pageName' => 'Comunidade - Categorias']], strings: [
            'categories' => PostsCategorys::getAll('id DESC'),
        ]);
    }

    public static function create(): void {
        parent::renderView(array: ['type' => 'private', 'view' => 'posts/categories/create.php', 'layoutChange' => ['pageName' => 'Comunidade - Criar Categoria']]);
    }

    public static function create_post():void {
        
        $result = \App\Services\FormFilter::validate(data: $_POST, rules: [
            'name' => 'string|max:200|required',
            'description' => 'string|max:200',
            'status' => 'int',
        ], 
        notifyError: true, 
        redirectUrl: '/projects/lexyhands/admin/posts/categories/create');

        if(PostsCategorys::getCategoryByName(name: $result->data->name)) {
            parent::notification(title: 'Erro ao Criar Categoria', message: 'Já existe uma categoria com este nome', level: 'warning', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/projects/lexyhands/admin/posts/categories/create');
            exit();
        }

        $result->data->status = isset($result->data->status) ? 1 : 0;
        $identificator = slug(string: $result->data->name);

        PostsCategorys::create(data: ['name' => $result->data->name,  'identificator' => $identificator, 'description' => $result->data->description, 'status' => $result->data->status]);

        parent::notification(title: 'A Categoria foi Criada !', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/projects/lexyhands/admin/posts/categories');
        exit();

    }

    public static function edit(string $identificator):void {
        $category = PostsCategorys::getByidentificator(identificator: $identificator);
        if (!$category) {
            parent::renderAdmin404();
        }
        parent::renderView(array: ['type' => 'private', 'view' => 'posts/categories/edit.php', 'layoutChange' => ['pageName' => 'Comunidade - Editar Categoria']], strings: [
            'category' => $category,
        ]);
    }

    public static function edit_post(string $identificator):void {
        $category = PostsCategorys::getByidentificator(identificator: $identificator);
        if (!$category) {
            parent::renderAdmin404();
        }

        $result = \App\Services\FormFilter::validate(data: $_POST, rules: [
            'name' => 'string|max:200|required',
            'description' => 'string|max:200',
            'status' => 'int',
        ], 
        notifyError: true, 
        redirectUrl: '/projects/lexyhands/admin/posts/categories/edit/'.$identificator.'');

        if(PostsCategorys::getCategoryByName(name: $result->data->name) && $result->data->name != $category->name) {
            parent::notification(title: 'Erro ao Criar Categoria', message: 'Já existe uma categoria com este nome', level: 'warning', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/projects/lexyhands/admin/posts/categories/create');
            exit();
        }

        $result->data->status = isset($result->data->status) ? 1 : 0;
        $identificator = slug(string: $result->data->name);

        PostsCategorys::update(id: $category->id, data: ['name' => $result->data->name, 'identificator' => $identificator, 'description' => $result->data->description, 'status' => $result->data->status]);

        parent::notification(title: 'A Categoria foi Actualizada !', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/projects/lexyhands/admin/posts/categories/edit/'.$identificator.'');
        exit();

    }

    public static function delete(int $id):void {
        
        $category = PostsCategorys::getById(id: $id);
        if (!$category) {
            parent::renderAdmin404();
        }

        PostsCategorys::delete(id: $category->id);
        parent::notification(title: 'A Categoria foi Excluída !', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/projects/lexyhands/admin/posts/categories');
        exit();

    }


}



<?php

namespace App\Controllers;

use App\Models\Posts;
use App\Models\Posts_categorys as PostsCategory;
use App\Services\FileUpload;

class PostsAdminController extends ControllerHelper
{
    public static function index(): void
    {
        parent::renderView(array: ['type' => 'private', 'view' => 'posts/index.php', 'layoutChange' => ['pageName' => 'Comunidade']], strings: [
            'posts' => Posts::getAll(order: 'id DESC'),
        ]);
    }

    public static function create(): void
    {
        parent::renderView(array: ['type' => 'private', 'view' => 'posts/create.php', 'layoutChange' => ['pageName' => 'Criar Postagem']], strings: [
            'categories' => PostsCategory::getAll('id DESC'),
        ]);
    }

    public static function create_post(): void
    {

        $result = self::validate_post($_POST);
        $images = self::validate_images();

        if (!$images) {
            parent::notification(title: 'Erro ao Criar Postagem !', message: 'É necessário pelomenos uma imagem para continuar', level: 'warning', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/../admin/posts/create');
            exit();
        }

        $identificator = slug($result->data->tittle);
        $video = self::validate_video($identificator);


        if (Posts::checkTittleExist($result->data->tittle)) {
            parent::notification(title: 'Erro ao Criar Postagem !', message: 'Já existe uma Postagem com este Título.', level: 'warning', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/../admin/posts/create');
            exit();
        }

        if (!empty($result->data->tags[0])) {
            $result->data->tags = explode(',', $result->data->tags[0]);
            $result->data->tags = self::validate_tags(tags: $result->data->tags);
            $result->data->tags = json_encode(value: $result->data->tags, flags: JSON_UNESCAPED_UNICODE);
        } else {
            $result->data->tags = null;
        }


        Posts::create(data: [
            'user_id' => parent::User()->user_id,
            'tittle' => $result->data->tittle,
            'identificator' => $identificator,
            'subtittle' => $result->data->subtittle,
            'content' => $result->data->content,
            'category' => $result->data->category,
            'tags' =>  $result->data->tags,
            'images' => $images,
            'video' => $video
        ]);

        parent::notification(title: 'A Postagem foi Criada !', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/../admin/posts');
        exit();
        
    }


    public static function edit(string $identificator): void
    {

        $post = Posts::getFromIdetificatorOnly(identificator: $identificator);
        if (!$post) {
            parent::renderAdmin404();
        }

        parent::renderView(array: ['type' => 'private', 'view' => 'posts/edit.php', 'layoutChange' => ['pageName' => 'Editar Postagem']], strings: [
            'post' => $post,
            'categories' => PostsCategory::getAll('id DESC'),
        ]);
    }


    public static function edit_post(string $identificator): void
    {

        $post = Posts::getFromIdetificatorOnly(identificator: $identificator);
        if (!$post) {
            parent::renderAdmin404();
        }

        $result = self::validate_post($_POST);
        $images = self::validate_images();

        if (!$images) {
            $images = $post->images;
        } else {
            //se tiver sido colcoad uma imagem
            //verifica se ja tem uma antes
            if($post->images) {
                $imagesNew = json_decode(json: $images, associative: true);
                $imagesOld = json_decode(json: $post->images, associative: true);
                $images = array_merge($imagesOld, $imagesNew);
                $images = json_encode(value: $images, flags: JSON_UNESCAPED_UNICODE);
            } else {
                $images = $post->images;
            }
        }

        $identificator = slug($result->data->tittle);
        $video = self::validate_video($identificator);
        if (!$video) {
            $video = $post->video;
        }


        if (Posts::checkTittleExist($result->data->tittle)) {
            parent::notification(title: 'Erro ao Criar Postagem !', message: 'Já existe uma Postagem com este Título.', level: 'warning', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/../admin/posts/create');
            exit();
        }

        if (!empty($result->data->tags[0])) {
            $result->data->tags = explode(',', $result->data->tags[0]);
            $result->data->tags = self::validate_tags(tags: $result->data->tags);
            $result->data->tags = json_encode(value: $result->data->tags, flags: JSON_UNESCAPED_UNICODE);
        } else {
            $result->data->tags = null;
        }
        

        $send = Posts::update(id: $post->id, data: [
            'user_id' => parent::User()->user_id,
            'tittle' => $result->data->tittle,
            'identificator' => $identificator,
            'subtittle' => $result->data->subtittle,
            'content' => $result->data->content,
            'category' => $result->data->category,
            'tags' =>  $result->data->tags,
            'images' => $images,
            'video' => $video
        ]);

        if ($send) {
            parent::notification(title: 'A Postagem foi Actualizada !', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/../admin/posts');
            exit();
        }
    }

    public static function delete(string $identificator): void
    {
        $post = Posts::getFromIdetificatorOnly(identificator: $identificator);
        if (!$post) {
            parent::renderAdmin404();
        }

        //remover imagens
        if(!empty($post->images)) {
            $images = json_decode(json: $post->images, associative: true);
            foreach ($images as $key => $image) {
                (new FileUpload())->remove(relativePath: '/' . $image);
            }
        }

        //remover video
        if(!empty($post->video)) {
            (new FileUpload())->remove(relativePath: '/' . $post->video);
        }

        Posts::delete(id: $post->id);
        parent::notification(title: 'A Postagem foi Excluída !', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/../admin/posts');
        exit();
    }


    public static function fileDelete(string $fileKey, string $identificator):void {

        $post = Posts::getFromIdetificatorOnly(identificator: $identificator);
        if (!$post) {
            parent::renderAdmin404();
        }

        if(!empty($post->images)) {
            $images = json_decode(json: $post->images, associative: true);

            if(count($images) < 2) {
                parent::notification(title: 'Erro ao Excluir Imagem !', message: 'Você não pode excluir a única imagem da postagem.', level: 'warning', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/../admin/posts/create');
                exit();
            }

            if(isset($images[$fileKey])) {
               //apagar imagem
               (new FileUpload())->remove(relativePath: '/' . $images[$fileKey]);
               unset($images[$fileKey]);
            }
           // Reindex the array keys
           $images = array_values($images);
           $images = json_encode(value: $images, flags: JSON_UNESCAPED_UNICODE);  
        } else {
            parent::renderAdmin404(); // não foi encontrado..
            exit();
        }

        Posts::update(id: $post->id, data: ['images' => $images]);

        parent::notification(title: 'A Imagem foi Excluida !', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/../admin/posts/edit/'.$identificator.'');
        exit();
    }

    public static function videoDelete(string $identificator):void {

        $post = Posts::getFromIdetificatorOnly(identificator: $identificator);
        if (!$post) {
            parent::renderAdmin404();
        }

        if(!empty($post->video)) {
            (new FileUpload())->remove(relativePath: '/' . $post->video);
        } else {
            parent::renderAdmin404();
        }

        Posts::update(id: $post->id, data: ['video' => null]);
        parent::notification(title: 'O Video foi Excluido !', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/../admin/posts/edit/'.$identificator.'');
        exit();

    }


    private static function validate_tags(array $tags): array|false|null
    {
        foreach ($tags as $key => $tag) {
            $tag = preg_replace('/\s+/', '', $tag);
            if (!preg_match('/^[a-zA-Z0-9_]+$/', $tag)) {
                parent::notification(
                    title: 'Erro ao Criar Postagem !',
                    message: 'As tags devem conter apenas letras, números e underline (_).',
                    level: 'warning',
                    type: 'sweetalert',
                    position: 'top-end',
                    timeout: 3000,
                    redirectUrl: '/../admin/posts/create'
                );
                exit();
            }
            $tags[$key] = $tag;
        }

        if($tags == 'null') {
            return null;
        }  else {
            return $tags;
        }
    }

    private static function validate_post(array $data): mixed
    {
        // Validando os dados com notificação de erro
        $result = \App\Services\FormFilter::validate(
            data: $data,
            rules: [
                'tittle' => 'string|max:200|required',
                'subtittle' => 'string|max:200',
                'content' => 'string',
                'category' => 'int|required',
                'tags' => 'array',
            ],
            notifyError: true,
            redirectUrl: '/../admin/services/create'
        );
        return $result;
    }

    private static function validate_images(): array|bool|string|null
    {
        // tratamento da imagem
        if (!empty($_FILES['images']['size'][0]) && $_FILES['images']['size'][0] > 0) {

            $uploadService = new FileUpload(uploadDir: 'projects/lexyhands/public/assets/images/posts');
            $image = $uploadService->upload(files: $_FILES['images'], params: [
                'rename' => true,
                'multiple' => true,
                'maxSize' => 2, // em MB
                'overwrite' => false,
                'allowedExtensions' => ['jpg', 'png', 'gif'],
                'convert' => 'png', // Converte para PNG
                'alert' => true,
                'url' => '/../admin/posts/create',
                'returnJson' => true
            ]);
        } else {
            $image = null;
        }

        return $image;
    }

    private static function validate_video(string $identificator): array|bool|string|null
    {
        // tratamento da imagem
        if ($_FILES['video']['size'] > 0) {
            $uploadService = new FileUpload(uploadDir: 'projects/lexyhands/public/assets/videos/posts/' . $identificator . '');
            $file = $uploadService->upload(files: $_FILES['video'], params: [
                'rename' => true,
                'multiple' => false,
                'maxSize' => 500, // em MB
                'overwrite' => false,
                'allowedExtensions' => ['mp4', 'avi', 'mkv'],
                'alert' => true,
                'url' => '/../admin/posts/create',
                'returnJson' => false
            ]);
        } else {
            $file = null;
        }

        return $file;
    }
}

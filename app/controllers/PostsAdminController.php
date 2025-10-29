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
            $result->data->tags = self::validate_tags(tags: $result->data->tags, redirectUrl: '/../admin/posts/edit/'.$identificator);
            $result->data->tags = json_encode(value: $result->data->tags, flags: JSON_UNESCAPED_UNICODE);
        } else {
            $result->data->tags = null;
        }


        Posts::create(data: [
            'author_id' => parent::User()->user_id,
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

        // Save old identificator for redirect URLs in case of errors
        $oldIdentificator = $identificator;
        
        $result = self::validate_post($_POST, redirectUrl: '/../admin/posts/edit/'.$oldIdentificator);
        $images = self::validate_images();

        // Safely get existing images
        $existingImages = null;
        if (property_exists($post, 'images') && isset($post->images)) {
            $existingImages = !empty($post->images) ? $post->images : null;
        }

        if (!$images) {
            $images = $existingImages;
        } else {
            //se tiver sido colcoad uma imagem
            //verifica se ja tem uma antes
            if($existingImages) {
                $imagesNew = json_decode(json: $images, associative: true);
                $imagesOld = json_decode(json: $existingImages, associative: true);
                $images = array_merge($imagesOld, $imagesNew);
                $images = json_encode(value: $images, flags: JSON_UNESCAPED_UNICODE);
            } else {
                // Keep new images - no old images to merge
            }
        }

        $identificator = slug($result->data->tittle);
        $video = self::validate_video($identificator);
        
        // Safely get existing video
        if (!$video) {
            $existingVideo = null;
            if (property_exists($post, 'video') && isset($post->video)) {
                $existingVideo = !empty($post->video) ? $post->video : null;
            }
            $video = $existingVideo;
        }


        // Check if title exists but exclude current post
        // Only check if title has changed
        if ($result->data->tittle !== $post->tittle) {
            $existingPost = Posts::checkTittleExist($result->data->tittle);
            if ($existingPost && is_object($existingPost) && $existingPost->id != $post->id) {
                parent::notification(title: 'Erro ao Editar Postagem !', message: 'Já existe uma Postagem com este Título.', level: 'warning', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/../admin/posts/edit/'.$oldIdentificator);
                exit();
            }
        }

        if (!empty($result->data->tags[0])) {
            $result->data->tags = explode(',', $result->data->tags[0]);
            $result->data->tags = self::validate_tags(tags: $result->data->tags, redirectUrl: '/../admin/posts/edit/'.$oldIdentificator);
            $result->data->tags = json_encode(value: $result->data->tags, flags: JSON_UNESCAPED_UNICODE);
        } else {
            $result->data->tags = null;
        }
        

        $send = Posts::update(id: $post->id, data: [
            'author_id' => parent::User()->user_id,
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
        if(property_exists($post, 'images') && !empty($post->images)) {
            $images = json_decode(json: $post->images, associative: true);
            if (is_array($images)) {
                foreach ($images as $key => $image) {
                    (new FileUpload())->remove(relativePath: '/' . $image);
                }
            }
        }

        //remover video
        if(property_exists($post, 'video') && !empty($post->video)) {
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

        if(property_exists($post, 'images') && !empty($post->images)) {
            $images = json_decode(json: $post->images, associative: true);

            if(!is_array($images) || count($images) < 2) {
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

        if(property_exists($post, 'video') && !empty($post->video)) {
            (new FileUpload())->remove(relativePath: '/' . $post->video);
        } else {
            parent::renderAdmin404();
        }

        Posts::update(id: $post->id, data: ['video' => null]);
        parent::notification(title: 'O Video foi Excluido !', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/../admin/posts/edit/'.$identificator.'');
        exit();

    }


    private static function validate_tags(array $tags, ?string $redirectUrl = null): array|false|null
    {
        foreach ($tags as $key => $tag) {
            // Remove only multiple spaces, keep single spaces and hyphens
            $tag = trim($tag);
            // Allow letters, numbers, underscores, hyphens, and common Portuguese characters
            if (!preg_match('/^[a-zA-ZáàâãéêíóôõúçÁÀÂÃÉÊÍÓÔÕÚÇ0-9_\-\s]+$/u', $tag)) {
                parent::notification(
                    title: 'Erro ao Criar Postagem !',
                    message: 'As tags contêm caracteres inválidos. Use apenas letras, números, hífen (-) e underscore (_).',
                    level: 'warning',
                    type: 'sweetalert',
                    position: 'top-end',
                    timeout: 3000,
                    redirectUrl: $redirectUrl ?? '/../admin/posts/create'
                );
                exit();
            }
            // Normalize spaces to single space
            $tag = preg_replace('/\s+/', ' ', $tag);
            $tags[$key] = $tag;
        }

        if($tags == 'null') {
            return null;
        }  else {
            return $tags;
        }
    }

    private static function validate_post(array $data, ?string $redirectUrl = null): mixed
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
            redirectUrl: $redirectUrl ?? '/../admin/posts/create'
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

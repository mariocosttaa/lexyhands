<?php

namespace App\Controllers;

use App\Models\Settings;
use App\Services\FileUpload;

class SettingsAdminController extends ControllerHelper
{

    public static function index(): void
    {
        parent::renderView(array: ['type' => 'private', 'view' => 'settings/index.php', 'layoutChange' => ['pageName' => 'Configurações']], strings: [
            'settings' =>  Settings::get(),
        ]);
    }

    public static function general(): void
    {
        $result = \App\Services\FormFilter::validate($_POST, rules: [
            'site_name' => 'string|max:200|required',
            'email' => 'email|max:200|required',
            'phone' => 'string',
        ], notifyError: true, redirectUrl: '/../admin/settings');

        //actualizar
        Settings::update(data: ['site_name' => $result->data->site_name, 'email' =>  $result->data->email, 'phone' => $result->data->phone]);

        //notificação
        parent::notification(title: 'Configurações Gerais Actualizadas!', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/../admin/settings');
        exit();
    }

    public static function logos(): void {

        function uploadImage(?array $param, ?string $rename): ? string {
            $uploadService = new FileUpload(uploadDir: 'projects/lexyhands/public/assets/website/');
                $image = $uploadService->upload(files: $param, params: [
                'rename' => $rename,
                'multiple' => false,
                'maxSize' => 5, // em MB
                'overwrite' => true,
                'allowedExtensions' => ['jpg', 'png', 'jpeg'],
                'convert' => 'png', // Converte para PNG
                'alert' => true,
                'url' => '/../admin/settings',
                'returnJson' => false
            ]);
            return $image;
        }

        // tratamento da imagem
        if (!empty($_FILES['site_logo']['size'][0]) && $_FILES['site_logo']['size'][0] > 0) {
            $site_logo = uploadImage($_FILES['site_logo'], rename: 'logo');
        }  else {
            $site_logo = Settings::get()->site_logo;
        }

        if (!empty($_FILES['site_logo_dark']['size'][0]) && $_FILES['site_logo_dark']['size'][0] > 0) {
            $site_logo_dark = uploadImage($_FILES['site_logo_dark'], 'logo-dark');
        }  else {
            $site_logo_dark = Settings::get()->site_logo_dark;
        }

        if(isset($_POST['show_image'])) {
            $show_images = 1;
        } else {
            $show_images = 0;
        }

        //enviando
        if(!empty($site_logo) || !empty($site_logo_dark)) {
            Settings::update(data: ['show_logo' => $show_images, 'site_logo' => $site_logo, 'site_logo_dark' => $site_logo_dark]);
        }

        //notificação        
        parent::notification(title: 'Logotipo(s) Actualizados!', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/../admin/settings');
        exit();

    }

}

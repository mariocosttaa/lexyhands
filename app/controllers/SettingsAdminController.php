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

        //actualizar (update both contact_email/contact_phone and email/phone for compatibility)
        Settings::update(data: [
            'site_name' => $result->data->site_name, 
            'contact_email' => $result->data->email,
            'email' => $result->data->email,
            'contact_phone' => $result->data->phone ?? null,
            'phone' => $result->data->phone ?? null
        ]);

        //notificação
        parent::notification(title: 'Configurações Gerais Actualizadas!', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/../admin/settings');
        exit();
    }

    public static function logos(): void {

        function uploadImage(?array $param, ?string $rename): ? string {
            if (empty($param) || !isset($param['name']) || (is_array($param['name']) && empty($param['name'][0])) || (!is_array($param['name']) && empty($param['name']))) {
                return null;
            }
            
            $uploadService = new FileUpload(uploadDir: 'public/assets/website/');
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

        // Get existing settings
        $existingSettings = Settings::get();
        $existingSiteLogo = ($existingSettings !== false && isset($existingSettings->site_logo)) ? $existingSettings->site_logo : null;
        $existingSiteLogoDark = ($existingSettings !== false && isset($existingSettings->site_logo_dark)) ? $existingSettings->site_logo_dark : null;

        // tratamento da imagem site_logo
        $site_logo = null;
        if (isset($_FILES['site_logo']) && 
            ((is_array($_FILES['site_logo']['size']) && !empty($_FILES['site_logo']['size'][0]) && $_FILES['site_logo']['size'][0] > 0) ||
             (!is_array($_FILES['site_logo']['size']) && !empty($_FILES['site_logo']['size']) && $_FILES['site_logo']['size'] > 0))) {
            $uploadedLogo = uploadImage($_FILES['site_logo'], rename: 'logo');
            if (!empty($uploadedLogo)) {
                $site_logo = $uploadedLogo;
            }
        }
        
        // If no new upload, keep existing
        if (empty($site_logo)) {
            $site_logo = $existingSiteLogo;
        }

        // tratamento da imagem site_logo_dark
        $site_logo_dark = null;
        if (isset($_FILES['site_logo_dark']) && 
            ((is_array($_FILES['site_logo_dark']['size']) && !empty($_FILES['site_logo_dark']['size'][0]) && $_FILES['site_logo_dark']['size'][0] > 0) ||
             (!is_array($_FILES['site_logo_dark']['size']) && !empty($_FILES['site_logo_dark']['size']) && $_FILES['site_logo_dark']['size'] > 0))) {
            $uploadedLogoDark = uploadImage($_FILES['site_logo_dark'], rename: 'logo-dark');
            if (!empty($uploadedLogoDark)) {
                $site_logo_dark = $uploadedLogoDark;
            }
        }
        
        // If no new upload, keep existing
        if (empty($site_logo_dark)) {
            $site_logo_dark = $existingSiteLogoDark;
        }

        if(isset($_POST['show_image'])) {
            $show_images = 1;
        } else {
            $show_images = 0;
        }

        //enviando - sempre atualiza, mesmo se não houver novos uploads (para atualizar show_logo)
        $updateData = ['show_logo' => $show_images];
        if (!empty($site_logo)) {
            $updateData['site_logo'] = $site_logo;
        }
        if (!empty($site_logo_dark)) {
            $updateData['site_logo_dark'] = $site_logo_dark;
        }
        
        Settings::update(data: $updateData);

        //notificação        
        parent::notification(title: 'Logotipo(s) Actualizados!', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/../admin/settings');
        exit();

    }

    public static function social_media(): void
    {
        $result = \App\Services\FormFilter::validate($_POST, rules: [
            'whatssap' => 'string|max:50',
            'facebook' => 'string|max:500',
            'youtube' => 'string|max:500',
            'linkedin' => 'string|max:500',
            'pinterest' => 'string|max:500',
        ], notifyError: true, redirectUrl: '/../admin/settings');

        // Update settings with social media links
        // Also update facebook_url and linkedin_url if they exist in table for compatibility
        $dataToUpdate = [
            'whatssap' => $result->data->whatssap ?? null,
            'whatsapp' => $result->data->whatssap ?? null, // Also update whatsapp if exists
            'facebook' => $result->data->facebook ?? null,
            'facebook_url' => $result->data->facebook ?? null, // Also update facebook_url for compatibility
            'youtube' => $result->data->youtube ?? null,
            'linkedin' => $result->data->linkedin ?? null,
            'linkedin_url' => $result->data->linkedin ?? null, // Also update linkedin_url for compatibility
            'pinterest' => $result->data->pinterest ?? null,
        ];

        Settings::update(data: $dataToUpdate);

        //notificação
        parent::notification(title: 'Redes Sociais Actualizadas!', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/../admin/settings');
        exit();
    }

}

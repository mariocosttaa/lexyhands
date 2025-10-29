<?php

namespace App\Controllers;

use App\Services\FileUpload;
use App\Models\Services as Services;
use App\Models\Services_price as ServicesPrice;
use App\Services\SlugGenerator;

class ServicesAdminController extends ServicesController
{
    public static function index(): void
    {
        parent::renderView(array: ['type' => 'private', 'view' => 'services/index.php', 'layoutChange' => ['pageName' => 'Serviços']], strings: [
            'services' => \App\Models\Services::getAll(order: 'id DESC'),
        ]);
    }

    public static function create(): void
    {
        parent::renderView(array: ['type' => 'private', 'view' => 'services/create.php', 'layoutChange' => ['pageName' => 'Criar Serviço']]);
    }

    public static function create_post(): void
    {
        // Validando os dados com notificação de erro
        $result = self::validate_post(data: $_POST);
        $image = self::validate_image();

        if(Services::checkNameExist($result->data->name)) {
            parent::notification(title: 'Erro ao Criar Serviço !', message: 'Já existe um Serviço com este Nome.', level: 'warning', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '../services/create');
            exit();
        }

        $identificator = slug(string: $result->data->name);

        // Process includes
        $includes = self::process_includes($_POST['includes'] ?? []);
        
        // Create service
        $send = Services::create(data: [
            'name' => $result->data->name, 
            'identificator' => $identificator, 
            'description' => $result->data->description, 
            'content' => $result->data->content, 
            'featured_image' => $image,
            'includes' => !empty($includes) ? json_encode($includes) : null
        ]);
        
        if ($send) {
            // Process prices
            self::process_prices($send, $_POST['prices'] ?? []);
            parent::notification(title: 'O serviço foi Criado !', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '../services');
            exit();
        }
    }

    public static function edit($slugName):void {

        $service = Services::getBySlugName($slugName);
        if(!$service) {
            parent::renderAdmin404();
            exit();
        }

        $includes = !empty($service->includes) ? json_decode($service->includes, true) : [];
        $service->includes_array = $includes;

        parent::renderView(array: ['type' => 'private', 'view' => 'services/edit.php', 'layoutChange' => ['pageName' => 'Editar Serviço']], strings: [
            'service' => $service,
            'service_prices' => ServicesPrice::getAllByServiceId($service->id)
        ]);
    }

    public static function edit_post($slugName):void {

        $result = self::validate_post(data: $_POST);
        $service = Services::getBySlugName(name: $slugName);
        if(!$service) {
            parent::notification(title: 'Erro ao Editar Serviço !', message: 'Não conseguimos Editar o Serviço especificado !', level: 'warning', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/../admin/services');
            exit();
        }
        
        //se o nome existir retorna erro
        if(Services::checkNameExist($result->data->name) && $result->data->name != $service->name) {
            parent::notification(title: 'Erro ao Editar Serviço !', message: 'Já existe um Serviço com este Nome.', level: 'warning', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/../admin/services/edit/'.$slugName.'');
            exit();
        }

        $image = self::validate_image() ?: ($service->featured_image ?? null);
        $identificator = slug(string: $result->data->name);

        // Process includes
        $includes = self::process_includes($_POST['includes'] ?? []);

        Services::update($service->id, data: [
            'name' => $result->data->name, 
            'identificator' => $identificator, 
            'description' => $result->data->description, 
            'content' => $result->data->content, 
            'featured_image' => $image,
            'includes' => !empty($includes) ? json_encode($includes) : null
        ]);

        // Process prices
        self::process_prices($service->id, $_POST['prices'] ?? []);

        parent::notification(title: 'O serviço foi Actualizado !', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/../admin/services/');
        exit();
    }


    public static function delete($slugName):void {
        
        $service = Services::getBySlugName(name: $slugName);
        if(!$service) {
            parent::notification(title: 'Erro ao Excluir Serviço !', message: 'Não conseguimos Excluir o Serviço específicado !', level: 'warning', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/../admin/services');
            exit();
        }

        Services::delete(id: $service->id);
        parent::notification(title: 'O serviço foi Excluido !', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/../admin/services/');

    }






    private static function validate_post(array $data, ): mixed {
        // Validando os dados com notificação de erro
        $result = \App\Services\FormFilter::validate(
            data: $data,
            rules: [
                'name' => 'string|max:200|required',
                'description' => 'string|max:200',
                'content' => 'string',
            ],
            notifyError: true,
            redirectUrl: '/../admin/services/create'
        );
        return $result;
    }

    private static function validate_image(): array|bool|string|null {
        // tratamento da imagem
        if (!empty($_FILES['image']['size'] > 0)) {
            $uploadService = new FileUpload(uploadDir: 'public/assets/images/services');
            $image = $uploadService->upload(files: $_FILES['image'], params: [
                'rename' => true,
                'multiple' => false,
                'maxSize' => 2, // em MB
                'overwrite' => false,
                'allowedExtensions' => ['jpg', 'png', 'gif'],
                'convert' => 'png', // Converte para PNG
                'alert' => true,
                'url' => '/../admin/services/create',
                'returnJson' => false
            ]);
        } else {
            $image = null;
        }

        return $image;
    }

    private static function process_includes(array $includes_data): array
    {
        $includes = [];
        if (!empty($includes_data) && is_array($includes_data)) {
            foreach ($includes_data as $include) {
                $include = trim($include);
                if (!empty($include)) {
                    $includes[] = $include;
                }
            }
        }
        return $includes;
    }

    private static function process_prices(int $service_id, array $prices_data): void
    {
        // Delete existing prices
        ServicesPrice::deleteByServiceId($service_id);

        if (!empty($prices_data) && is_array($prices_data)) {
            foreach ($prices_data as $price_data) {
                if (!empty($price_data['price'])) {
                    ServicesPrice::create([
                        'service_id' => $service_id,
                        'name' => null, // Not used anymore
                        'description' => $price_data['description'] ?? null,
                        'price' => floatval($price_data['price']),
                        'currency_code' => $price_data['currency'] ?? 'EUR',
                        'duration' => intval($price_data['duration'] ?? 60),
                        'is_active' => isset($price_data['is_active']) ? (bool)$price_data['is_active'] : true,
                        'sort_order' => intval($price_data['sort_order'] ?? 0)
                    ]);
                }
            }
        }
    }

}

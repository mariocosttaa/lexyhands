<?php

namespace App\Controllers;
use App\Models\Services as Service;
use App\Models\Services_faq as ServiceFaq;
use App\Models\Posts as Posts;

class ServicesController extends ControllerHelper
{
    public static function index(): void
    {
        parent::renderView(array: ['type' => 'public', 'view' => 'services/index.php', 'page' => 'Serviços'], strings: [
            'services' => \App\Models\Services::getAll(order: 'id DESC'),
        ]);
    }

    public static function view($slugName): void
    {

        // Validando os dados com notificação de erro
        \App\Services\FormFilter::validate(data: ['slugName' => $slugName],
            rules: [
                'slugName' => 'string|max:255|required',
            ],
            notifyError: true,
            redirectUrl: ($_ENV['APP_URL'] ?? '') . '/services'
        );


        $service = Service::getBySlugName($slugName);

        //id n encontrado
        if(!$service){
            parent::render404();
            exit();
        }
        
        parent::renderView(array: ['type' => 'public', 'view' => 'services/view.php', 'page' => 'Serviços'], strings: [
            'service' => $service,
            'othersServices' => \App\Models\Services::getAllExceptThis(id: $service->id, order: 'id DESC', limit: 6),
            'settigns' => parent::settings(),
            'service_faq' => ServiceFaq::getAllByServiceId(service_id: $service->id, order: 'id DESC'),
            'service_prices' => \App\Models\Services_price::getAllByServiceId($service->id),
        ]);
    }
}

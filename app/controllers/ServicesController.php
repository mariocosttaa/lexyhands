<?php

namespace App\Controllers;
use App\Models\services as Service;
use App\Models\services_faq as ServiceFaq;
use App\Models\posts as Posts;

class ServicesController extends ControllerHelper
{
    public static function index(): void
    {
        parent::renderView(array: ['type' => 'public', 'view' => 'services/index.php', 'page' => 'Serviços'], strings: [
            'services' => \App\Models\services::getAll(order: 'id DESC'),
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
            redirectUrl: 'http://localhost/projects/lexyhands/services'
        );


        $service = Service::getBySlugName($slugName);

        //id n encontrado
        if(!$service){
            parent::render404();
            exit();
        }
        
        parent::renderView(array: ['type' => 'public', 'view' => 'services/view.php', 'page' => 'Serviços'], strings: [
            'service' => $service,
            'othersServices' => \App\Models\services::getAllExceptThis(id: $service->id, order: 'id DESC', limit: 6),
            'settigns' => parent::settings(),
            'service_faq' => ServiceFaq::getAllByServiceId(service_id: $service->id, order: 'id DESC'),
        ]);
    }
}

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

    public static function view($id): void
    {

        // Validando os dados com notificação de erro
        \App\Services\FormFilter::validate(data: ['id' => $id],
            rules: [
                'id' => 'int|required',
            ],
            notifyError: true,
            redirectUrl: 'http://localhost/projects/lexyhands/services'
        );

        //id n encontrado
        if(Service::getById($id) == null){
            parent::notification(tittle: 'O serviço não foi encontrado', message: 'Verifique se o serviço existe', level: 'error', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '../services');
            exit();
        }

        parent::renderView(array: ['type' => 'public', 'view' => 'services/view.php', 'page' => 'Serviços'], strings: [
            'service' => \App\Models\services::getById($id),
            'othersServices' => \App\Models\services::getAllExceptThis(id: $id, order: 'id DESC', limit: 6),
            'settigns' => parent::settings(),
            'service_faq' => ServiceFaq::getAllByServiceId(service_id: $id, order: 'id DESC'),
        ]);
    }
}

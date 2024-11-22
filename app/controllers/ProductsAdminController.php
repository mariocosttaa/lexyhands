<?php

namespace App\Controllers;

class ProductsAdminController extends ControllerHelper
{

    public static function index(): void
    {
        parent::renderView(array: ['type' => 'private', 'view' => 'products/index.php', 'layoutChange' => ['pageName' => 'Productos']]);
    }

    public static function create(): void
    {
        parent::renderView(array: ['type' => 'private', 'view' => 'products/create.php', 'layoutChange' => ['pageName' => 'Criar Producto']]);
    }

    public static function create_post(): void
    {

        // Validação dos dados do formulário
        $result = \App\Services\FormFilter::validate($_POST, [
            // Nome do produto
            'name' => 'string|max:255|required',

            // Descrição curta
            'short_description' => 'string|max:255',

            // Preço real e fake (valores numéricos)
            'real_price' => 'numeric|min:0.01|required',
            'fake_price' => 'numeric|min:0.01',

            // Moeda (valor fixo da lista)
            'currency' => 'string|required',

            // Especificações técnicas (texto opcional)
            'specifications' => 'string',

            // Dimensões do produto (valores numéricos, opcionais)
            'product_length' => 'numeric|min:0',
            'product_width' => 'numeric|min:0',
            'product_height' => 'numeric|min:0',

            // Peso do produto (valor numérico, opcional)
            'product_weight' => 'numeric|min:0',

            // Material e cor do produto (textos opcionais)
            'product_material' => 'string|max:255',
            'product_color' => 'string|max:255',

            // Outras características (texto opcional)
            'other_features' => 'string',

            // Estoque ilimitado (checkbox)
            'unlimited_stock' => 'bool',

            // Quantidade total de estoque (se não for ilimitado)
            'stock_quantity' => 'int|min:0',

            // Variações de estoque (arrays opcionais)
            'variant_size' => 'array',
            'variant_color' => 'array',
            'variant_stock' => 'array',

            // Estado (checkbox)
            'status' => 'bool|required',
        ]);
   


        // Supondo que a validação já ocorreu e os dados validados estão em $result->data
        $data = $result->data;

        // Atualizar os valores conforme dependências
        if ($data->unlimited_stock) {
            // Se o estoque for ilimitado, zere o campo de quantidade
            $data->stock_quantity = null;
        } else {
            // Certifique-se de que estoque limitado tenha uma quantidade válida
            if (!isset($data->stock_quantity) || $data->stock_quantity < 0) {
                $data->stock_quantity = 0; // Defina um valor padrão
            }
        }

        // Verifique se as variações estão habilitadas e ajusta conforme necessário
        if (!empty($data->variant_size) || !empty($data->variant_color)) {
            // Se houver variações, estoque geral não deve ser usado
            $data->stock_quantity = null;
            $data->unlimited_stock = false; // Marque como estoque limitado por segurança
        } else {
            // Se não houver variações, as variações de estoque devem ser nulas
            $data->variant_stock = null;
        }

        // Ajustar as especificações técnicas e outras strings baseadas em lógica específica
        if (empty($data->specifications)) {
            $data->specifications = "Não especificado"; // Texto padrão
        }

        if (empty($data->other_features)) {
            $data->other_features = null; // Zere se não houver dados
        }

        // Valide os campos numéricos opcionais
        $data->product_length = isset($data->product_length) && $data->product_length >= 0 ? $data->product_length : null;
        $data->product_width = isset($data->product_width) && $data->product_width >= 0 ? $data->product_width : null;
        $data->product_height = isset($data->product_height) && $data->product_height >= 0 ? $data->product_height : null;
        $data->product_weight = isset($data->product_weight) && $data->product_weight >= 0 ? $data->product_weight : null;

        // Verificar e ajustar as variações de estoque
        if (!empty($data->variant_stock) && is_array($data->variant_stock)) {
            foreach ($data->variant_stock as $key => $stock) {
                if ($stock < 0) {
                    $data->variant_stock[$key] = 0; // Não permita valores negativos
                }
            }
        } else {
            $data->variant_stock = null; // Zere se não houver variações
        }

        // Atualizar o preço fake, se necessário
        if (isset($data->fake_price) && $data->fake_price <= $data->real_price) {
            $data->fake_price = null; // Remove o preço fake inválido
        }

        // Garantir consistência na moeda
        if (!in_array($data->currency, ['USD', 'EUR', 'AOA'])) {
            $data->currency = 'USD'; // Defina uma moeda padrão válida
        }

        // Resultado final
        print_r(value: $data);

     }


}

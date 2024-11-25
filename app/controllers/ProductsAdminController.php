<?php

namespace App\Controllers;

use App\Services\Money;
use App\Services\FileUpload;

use App\Models\products as Products;
use App\Models\product_prices as ProductPrices;
use App\Models\products_stocks as ProductStocks;
use App\Models\currencies as Currencies;

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
            'short_description' => 'string|max:255|required',
            'description' => 'string|max:4000|required',

            //preço do producto
            'price' => 'array|required',
            'fake_price' => 'array',
            'currency' => 'array|required',
            'prices_description' => 'array',

            //especificações do prodcuto (opcionais)
            'specifications' => 'string|max:4000',
            'product_length' => 'float',
            'product_width' => 'float',
            'product_height' => 'float',
            'product_weight' => 'float',
            'product_material' => 'string|max:255',
            'product_color' => 'array',
            'other_features' => 'string|max:500',

            //estoque
            'unlimited_stock' => 'bool',
            'general_stock' => 'int',

            //estoque por tamanho
            'size' => 'array',
            'size_stock' => 'array',

            //estoque por cor
            'color' => 'array',
            'color_stock' => 'array',

            //estoque por tamanho e cor
            'variant_size' => 'array',
            'variant_color' => 'array',
            'variant_stock' => 'array',

        ], notifyError: true, redirectUrl: '/projects/lexyhands/admin/products');


        //tratamento dos preços
        $product_prices = self::prices_verify(prices: $result->data->price, fake_prices: $result->data->fake_price,  prices_description: $result->data->prices_description, currencies: $result->data->currency);
        
        //tratamento das informações sobre o producto
        $specifications = self::specifications(
            specifications: $result->data->specifications,
            product_length: $result->data->product_length,
            product_width: $result->data->product_width,
            product_height: $result->data->product_height,
            product_weight: $result->data->product_weight,
            product_material: $result->data->product_material,
            product_color: $result->data->product_color,
            other_features: $result->data->other_features
        );

        $result->data->colors = self::colors_verify($result->data->product_color);

        //tratamento dos stocks
        $products_stocks = self::stockMagement(
            unlimited_stock: $result->data->unlimited_stock,
            general_stock: $result->data->general_stock,
            color: $result->data->color,
            color_stock: $result->data->color_stock,
            size: $result->data->size,
            size_stock: $result->data->size_stock,
            variant_size: $result->data->variant_size,
            variant_color: $result->data->variant_color,
            variant_stock: $result->data->variant_stock
        );
        $images = self::validate_images();

        //criando o prodcuto
        $product =  Products::create(data: [
            'name' => $result->data->name,
            'description' => $result->data->description,
            'short_description' => $result->data->short_description,
            'specifications' => $specifications,
            'images' => $images,
            'status' => true,
        ]);

        
        if ($product) {
            //criando os preços
            foreach ($product_prices as $price) {
                $price = (object) $price;
                ProductPrices::create([
                    'product_id' => $product,
                    'price' => $price->price,
                    'price_promo' => $price->price_promo,
                    'description' =>  $price->description,
                    'currency' => $price->currency,
                    'status' => true,
                ]);
            }
            //criar os stocks
            ProductStocks::create(data: [
                'product_id' => $product,
                'unlimited_stocks' => $products_stocks->unlimited_stocks,
                'stock' => $products_stocks->stock,
                'stock_with_size' => $products_stocks->stock_with_size ?: null,
                'stock_with_color' => $products_stocks->stock_with_color ?: null,
                'stock_with_size_and_color' => $products_stocks->stock_with_size_and_color ?: null,
            ]);
        }
        
        parent::notification(title: 'Producto Criado !', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/projects/lexyhands/admin/products');
        exit();

    }



    private static function prices_verify($prices, $fake_prices, $prices_description, $currencies): array|null
    {
        //verificar se o array n esta vazio
        if (!empty($prices)) {
            //verificar se é array o preço e o da moeda
            if (is_array(value: $prices) && is_array(value: $currencies)) {

                $money = new Money();
                $prices_formated = [];
                $error_in_price = [];

                foreach ($prices as $key => $value) {
                    //obtendo o valor monetário
                    $currency = Currencies::getByCode($currencies[$key]);
                    $price = $money->sanitizeAmount(amount: $value);
                    $fake_price = $money->sanitizeAmount(amount: $fake_prices[$key]);
                    $prices_description = $prices_description[$key];

                    if (!empty($price) && ($currency)) {
                        $prices_formated[] = [
                            'currency' => $currency->code,
                            'price' => $price,
                        ];
                        //se tiver fake price
                        if (!empty($fake_price)) {
                            $prices_formated[$key]['price_promo'] = $fake_price;
                        }
                        
                        //descrição
                        $prices_formated[$key]['description'] = $prices_description ?: null;
                        
                    } else {
                        $error_in_price[] =  "Ocorreu algum erro ao processar o preço ou moeda indicado (  Preço: {$prices[$key]}  / Moeda: {$currencies[$key]} )";
                    }
                }

                //se tiver algum erro
                if (!empty($error_in_price)) {
                    //retorna erro
                    parent::notification(title: 'Erro de Validação', message: implode('<br>', $error_in_price), level: 'error', type: 'sweetalert', position: 'top-end', timeout: 7000, redirectUrl: '/projects/lexyhands/admin/products/create');
                    exit();
                }
            } else {
                //retorna erro
                parent::notification(title: 'O(s) preços ou a moeda indicada não são válidos.', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 7000, redirectUrl: '/projects/lexyhands/admin/products/create');
                exit();
            }
        } else {
            //retorna erro
            parent::notification(title: 'É necessário indicar pelomenos um Preço', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 7000, redirectUrl: '/projects/lexyhands/admin/products/create');
            exit();
        }

        return $prices_formated;
    }


    private static function specifications($specifications, $product_length, $product_width, $product_height, $product_weight, $product_material, $product_color, $other_features): ? string  {
        $specifications = [
            'specifications' => $specifications ?: null,
            'length' => $product_length ?: null,
            'width' => $product_width ?: null,
            'height' => $product_height ?: null,
            'weight' => $product_weight ?: null,
            'material' => $product_material ?: null,
            'color' => $product_color ?: null,
            'other_features' => $other_features ?: null,
        ];

        return json_encode(value: $specifications, flags: JSON_UNESCAPED_UNICODE);
    }

    private static function colors_verify(?array $color): mixed
    {

        if (empty($colors)) return null;

        //verificar se o array n esta vazio
        if (!empty($color)) {
            if (is_array(value: $color) && count(value: $color) > 30) {
                parent::notification(title: 'São permitidas no máximo 30 definições de cores.', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 7000, redirectUrl: '/projects/lexyhands/admin/products/create');
                exit();
            } else {
                return json_encode(value: $color, flags: JSON_UNESCAPED_UNICODE);
            }
        } else {
            return null;
        }
    }

    private static function stockMagement($unlimited_stock, $general_stock, $color, $color_stock, $size, $size_stock, $variant_size, $variant_color, $variant_stock): object
    {
        $return = [
            'unlimited_stocks' => 0, //false
            'stock' => 0,
            'stock_with_color' => "",
            'stock_with_size' => "",
            'stock_with_size_and_color' => "",
        ];

        $error = [];

        if ($unlimited_stock) {
            $return['unlimited_stocks'] = true;
            $return['stock'] = 9999;
        } else if (!empty($general_stock) && is_numeric($general_stock)) {
            $return['stock'] = $general_stock;
        } else if (
            is_array($size) && is_array($size_stock)
            && count(array_filter($size, fn($v) => !empty($v))) > 0
            && count(array_filter($size_stock, fn($v) => !empty($v))) > 0
        ) {

            // Stock por tamanho
            $return['stock_with_size'] = [];
            foreach ($size as $key => $value) {
                $stock_total = is_numeric($size_stock[$key] ?? null) ? $size_stock[$key] : null;
                $size_value = $value;

                if (!empty($stock_total) && !empty($size_value)) {
                    $return['stock_with_size'][] = [
                        'size' => $size_value,
                        'stock' => $stock_total
                    ];
                } else {
                    $error[] = "O tamanho ou quantidade de estoque não podem estar vazios na definição de stock por tamanho.";
                }
            }
            if (isset($return['stock_with_size'])) {
                foreach ($return['stock_with_size'] as $key => $value) {
                    $return['stock'] += $value['stock'];
                }
            }
            if (!empty($error)) {
                //retorna erro
                parent::notification(title: 'Erro de Validação', message: implode('<br>', $error), level: 'error', type: 'sweetalert', position: 'top-end', timeout: 7000, redirectUrl: '/projects/lexyhands/admin/products/create');
                exit();
            }
        } else if (
            is_array($color) && is_array($color_stock)
            && count(array_filter($color, fn($v) => !empty($v))) > 0
            && count(array_filter($color_stock, fn($v) => !empty($v))) > 0
        ) {

            // Stock por cor
            $return['stock_with_color'] = [];
            foreach ($color as $key => $value) {
                $stock_total = is_numeric($color_stock[$key] ?? null) ? $color_stock[$key] : null;
                $color_value = $value;

                if (!empty($stock_total) && !empty($color_value)) {
                    $return['stock_with_color'][] = [
                        'color' => $color_value,
                        'stock' => $stock_total
                    ];
                } else {
                    $error[] = "A cor ou quantidade de estoque não podem estar vazios na definição de stock por cor.";
                }
            }

            if (isset($return['stock_with_color'])) {
                foreach ($return['stock_with_color'] as $key => $value) {
                    $return['stock'] += $value['stock'];
                }
            }

            if (!empty($error)) {
                parent::notification(title: 'Erro de Validação', message: implode('<br>', $error), level: 'error', type: 'sweetalert', position: 'top-end', timeout: 7000, redirectUrl: '/projects/lexyhands/admin/products/create');
                exit();
            }
        } else if (
            is_array($variant_size) && is_array($variant_color) && is_array($variant_stock)
            && count(array_filter($variant_size, fn($v) => !empty($v))) > 0
            && count(array_filter($variant_color, fn($v) => !empty($v))) > 0
            && count(array_filter($variant_stock, fn($v) => !empty($v))) > 0
        ) {

            // Stock por tamanho e cor
            $return['stock_with_size_and_color'] = [];
            foreach ($variant_stock as $key => $value) {
                $stock_total = is_numeric($variant_stock[$key] ?? null) ? $variant_stock[$key] : null;
                $size_value = $variant_size[$key] ?? null;
                $color_value = $variant_color[$key] ?? null;

                if (!empty($stock_total) && !empty($size_value) && !empty($color_value)) {
                    $return['stock_with_size_and_color'][] = [
                        'color' => $color_value,
                        'size' => $size_value,
                        'stock' => $stock_total
                    ];
                } else {
                    $error[] = "O tamanho, cor ou quantidade de estoque não podem estar vazios na definição de stock por tamanho e cor.";
                }
            }
            if (isset($return['stock_with_size_and_color'])) {
                foreach ($return['stock_with_size_and_color'] as $key => $value) {
                    $return['stock'] += $value['stock'];
                }
            }
        } else {
            parent::notification(title: 'Erro de Validação', message: implode('<br>', $error), level: 'error', type: 'sweetalert', position: 'top-end', timeout: 7000, redirectUrl: '/projects/lexyhands/admin/products/create');
            exit();
        }


        return $return = (object) $return;
    }


    private static function validate_images(): ?string
    {
        // tratamento da imagem
        if (!empty($_FILES['images']['size'][0]) || $_FILES['images']['size'] > 0) {

            $uploadService = new FileUpload(uploadDir: 'projects/lexyhands/public/assets/images/products');
            $image = $uploadService->upload(files: $_FILES['images'], params: [
                'rename' => true,
                'multiple' => true,
                'maxSize' => 2, // em MB
                'overwrite' => false,
                'allowedExtensions' => ['jpg', 'png', 'gif'],
                'convert' => 'png', // Converte para PNG
                'alert' => true,
                'url' => '/projects/lexyhands/admin/products/create',
                'returnJson' => true
            ]);
        } else {
            $image = null;
        }

        return $image;
    }
}

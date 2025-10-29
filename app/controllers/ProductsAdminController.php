<?php

namespace App\Controllers;

use App\Services\Money;
use App\Services\FileUpload;
use App\Services\SlugGenerator;

use App\Models\Products as Products;
use App\Models\Product_prices as ProductPrices;
use App\Models\Products_stocks as ProductStocks;
use App\Models\Currencies as Currencies;

class ProductsAdminController extends ControllerHelper
{

    public static function index(): void
    {
        parent::renderView(array: ['type' => 'private', 'view' => 'products/index.php', 'layoutChange' => ['pageName' => 'Productos']], strings: [
            'products' => Products::getAll(order: 'id DESC'),
        ]);
    }

    public static function create(): void
    {
        parent::renderView(array: ['type' => 'private', 'view' => 'products/create.php', 'layoutChange' => ['pageName' => 'Criar Producto']]);
    }

    public static function create_post(): void
    {

        $result = self::sanitazeValues();

        //tratamento dos preços
        $product_prices = self::prices_verify(prices: $result->data->price, fake_prices: $result->data->fake_price,  prices_description: $result->data->prices_description, currencies: $result->data->currency);

        //tratamento das informações sobre o producto
        $specifications = self::specifications(specifications: $result->data->specifications, product_length: $result->data->product_length, product_width: $result->data->product_width, product_height: $result->data->product_height, product_weight: $result->data->product_weight, product_material: $result->data->product_material, product_color: $result->data->product_color, other_features: $result->data->other_features);
        $result->data->colors = self::colors_verify($result->data->product_color);

        //tratamento dos stocks
        $products_stocks = self::stockMagement(unlimited_stock: $result->data->unlimited_stock, general_stock: $result->data->general_stock, color: $result->data->color, color_stock: $result->data->color_stock, size: $result->data->size, size_stock: $result->data->size_stock, variant_size: $result->data->variant_size, variant_color: $result->data->variant_color, variant_stock: $result->data->variant_stock);
         $images = self::validate_images();
        

        if(Products::getByName($result->data->name)) {
            //retorna erro
            parent::notification(title: 'Já existe um Produto com este Nome', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 7000, redirectUrl: '/../admin/products/create');
            exit();
        }

        $identificator = slug($result->data->name);

        //criando o prodcuto
        $product = Products::create(data: ['name' => $result->data->name, 'identificator' => $identificator, 'description' => $result->data->description, 'short_description' => $result->data->short_description, 'specifications' => $specifications, 'images' => $images, 'status' => true,]);

        if ($product) {
            //criando os preços
            foreach ($product_prices as $price) {
                $price = (object) $price;
                ProductPrices::create(['product_id' => $product, 'price' => $price->price, 'price_promo' => $price->price_promo ?? null, 'description' =>  $price->description ?? null, 'currency_code' => $price->currency, 'is_active' => true,]);
            }
            //criar os stocks
            ProductStocks::create(data: ['product_id' => $product, 'unlimited_stocks' => $products_stocks->unlimited_stocks, 'stock' => $products_stocks->stock, 'stock_with_size' => $products_stocks->stock_with_size ?: null, 'stock_with_color' => $products_stocks->stock_with_color ?: null, 'stock_with_size_and_color' => $products_stocks->stock_with_size_and_color ?: null,]);
        }

        parent::notification(title: 'Producto Criado !', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/../admin/products');
        exit();
    }

    public static function edit(?string $identificator): void {
        
        $product = Products::getByIdentificator(identificator: $identificator);
        if (!$product) {
            parent::renderAdmin404();
        }

        parent::renderView(array: ['type' => 'private', 'view' => 'products/edit.php', 'layoutChange' => ['pageName' => 'Editar Producto']], strings: [
            'product' => $product,
            'stocks' => ProductStocks::getByProductId(id: $product->id),
            'currencies' => Currencies::getAll(),
        ]);
    }

    public static function edit_post(?string $identificator): void {

        $product = Products::getByIdentificator(identificator: $identificator);
        if (!$product) {
            parent::renderAdmin404();
        }

        $id = $product->id;

        $result = self::sanitazeValues();

        //pegar os preços antigos
        $old_prices = ProductPrices::getByProductId(id: $id);

        //tratamento dos preços
        $product_prices = self::prices_verify(prices: $result->data->price, fake_prices: $result->data->fake_price,  prices_description: $result->data->prices_description, currencies: $result->data->currency);

        //tratamento das informações sobre o producto
        $specifications = self::specifications(specifications: $result->data->specifications, product_length: $result->data->product_length, product_width: $result->data->product_width, product_height: $result->data->product_height, product_weight: $result->data->product_weight, product_material: $result->data->product_material, product_color: $result->data->product_color, other_features: $result->data->other_features);
        $result->data->colors = self::colors_verify($result->data->product_color);

        //tratamento dos stocks
        $products_stocks = self::stockMagement(unlimited_stock: $result->data->unlimited_stock, general_stock: $result->data->general_stock, color: $result->data->color, color_stock: $result->data->color_stock, size: $result->data->size, size_stock: $result->data->size_stock, variant_size: $result->data->variant_size, variant_color: $result->data->variant_color, variant_stock: $result->data->variant_stock);
        $images = self::validate_images();

        // Safely get existing images
        $existingImages = null;
        if (property_exists($product, 'images') && isset($product->images)) {
            $existingImages = !empty($product->images) ? $product->images : null;
        }

        if (!$images) {
            $images = $existingImages;
        } else if($existingImages) {
            //se tiver sido colcoad uma imagem
            //verifica se ja tem uma antes
            $imagesNew = json_decode(json: $images, associative: true);
            $imagesOld = json_decode(json: $existingImages, associative: true);
            $images = array_merge($imagesOld, $imagesNew);
            $images = json_encode(value: $images, flags: JSON_UNESCAPED_UNICODE);
        } else {
            // Keep new images
        }
        

        $productByName = Products::getByName($result->data->name);
        if($productByName !== false && $productByName !== null && $productByName->id != $id) {
            //retorna erro
            parent::notification(title: 'Já existe um Produto com este Nome', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 7000, redirectUrl: '/../admin/products/edit/'.$identificator.'');
            exit();
        }

        $identificator = slug($result->data->name);

        //sctualizada o prodcuto
        $product = Products::update(id: $id, data: ['name' => $result->data->name, 'identificator' => $identificator, 'description' => $result->data->description, 'short_description' => $result->data->short_description, 'specifications' => $specifications, 'images' => $images, 'status' => true,]);

        if ($product) {
            //criando os preços
            foreach ($product_prices as $key => $price) {
                $price = (object) $price;
                $price_id = isset($result->data->price_id[$key]) ? $result->data->price_id[$key] : null;
                $price_id = ProductPrices::getById($price_id);

                if (!empty(($price_id))) {
                    ProductPrices::update(id: $price_id->id, data: ['product_id' => $product, 'price' => $price->price, 'price_promo' => $price->price_promo ?? null, 'description' =>  $price->description ?? null, 'currency_code' => $price->currency, 'is_active' => true,]);
                } else {
                    ProductPrices::create(data: ['product_id' => $product, 'price' => $price->price, 'price_promo' => $price->price_promo ?? null, 'description' =>  $price->description ?? null, 'currency_code' => $price->currency, 'is_active' => true]);
                }
            }
            //actuaizar os stocks
            ProductStocks::update(id: $id, data: ['product_id' => $product, 'unlimited_stocks' => $products_stocks->unlimited_stocks, 'stock' => $products_stocks->stock, 'stock_with_size' => $products_stocks->stock_with_size ?: null, 'stock_with_color' => $products_stocks->stock_with_color ?: null, 'stock_with_size_and_color' => $products_stocks->stock_with_size_and_color ?: null]);
        }

        parent::notification(title: 'Producto Actualizado !', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/../admin/products');
        exit();
    }

    public static function delete(?string $identificator): void {
        $product = Products::getByIdentificator(identificator: $identificator);
       
        if (!$product) {
            parent::renderAdmin404();
        }
        $id = $product->id;
        
        //remover imagens
        if(property_exists($product, 'images') && !empty($product->images)) {
            $images = json_decode(json: $product->images, associative: true);
            foreach ($images as $image) {
                (new FileUpload())->remove(relativePath: '/' . $image);
            }
        }

        //apagando producto
        $product = Products::delete(id: $id);
        if($product) {
            //apagando os preços
            ProductPrices::deleteByProductId(id: $id);
            //apagando os stocks
            ProductStocks::deleteByProductId(id: $id);
        }

        parent::notification(title: 'Producto Apagado !', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/../admin/products');
        exit();
    }

    public static function filesDelete(?int $fileKey, string $identificator): void {
        
        $product = Products::getByIdentificator(identificator: $identificator);
        if (!$product) {
            parent::renderAdmin404();
        }

        if(property_exists($product, 'images') && !empty($product->images)) {
            $images = json_decode(json: $product->images, associative: true);

            if(count($images) < 2) {
                parent::notification(title: 'Erro ao Excluir Imagem !', message: 'Você não pode excluir a única imagem do Producto.', level: 'warning', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/../admin/products/create');
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

        Products::update(id: $product->id, data: ['images' => $images]);

        parent::notification(title: 'A Imagem foi Excluida !', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 3000, redirectUrl: '/../admin/products/edit/'.$identificator.'');
        exit();
    }

    private static function sanitazeValues(): array|object
    {
        // Validação dos dados do formulário
        $result = \App\Services\FormFilter::validate($_POST, [

            //edit
            'price_id' => 'array',

            // Nome do produto
            'name' => 'string|max:255|required',
            'short_description' => 'string|max:255',
            'description' => 'string|max:4000',

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
        ], notifyError: true, redirectUrl: '/../admin/products/create');

        return $result;
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
                    $prices_description = isset($prices_description[$key]) ? $prices_description[$key] : null;

                    if (!empty($price) && !empty($currency)) {
                        $prices_formated[] = [
                            'currency' => $currency->code,
                            'price' => $price,
                            'price_promo' => $fake_price ?: null,
                            'description' => $prices_description
                        ];
                    } else {
                        $error_in_price[] =  "Ocorreu algum erro ao processar o preço ou moeda indicado (  Preço: {$prices[$key]}  / Moeda: {$currencies[$key]} )";
                    }
                }
            } else {
                //retorna erro
                parent::notification(title: 'O(s) preços ou a moeda indicada não são válidos.', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 7000, redirectUrl: '/../admin/products/create');
                exit();
            }
        } else {
            //retorna erro
            parent::notification(title: 'É necessário indicar pelomenos um Preço', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 7000, redirectUrl: '/../admin/products/create');
            exit();
        }


        //se tiver algum erro
        if (!empty($error_in_price)) {
            //retorna erro
            parent::notification(title: 'Erro de Validação', message: implode('<br>', $error_in_price), level: 'error', type: 'sweetalert', position: 'top-end', timeout: 7000, redirectUrl: '/../admin/products/create');
            exit();
        }

        return $prices_formated;
    }


    private static function specifications($specifications, $product_length, $product_width, $product_height, $product_weight, $product_material, $product_color, $other_features): ?string
    {
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
        //verificar se o array n esta vazio
        if (!empty($color) && is_array($color)) {
            if (count($color) > 30) {
                parent::notification(title: 'São permitidas no máximo 30 definições de cores.', message: null, level: 'success', type: 'sweetalert', position: 'top-end', timeout: 7000, redirectUrl: '/../admin/products/create');
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
                parent::notification(title: 'Erro de Validação', message: implode('<br>', $error), level: 'error', type: 'sweetalert', position: 'top-end', timeout: 7000, redirectUrl: '/../admin/products/create');
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
                parent::notification(title: 'Erro de Validação', message: implode('<br>', $error), level: 'error', type: 'sweetalert', position: 'top-end', timeout: 7000, redirectUrl: '/../admin/products/create');
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
            if (!empty($error)) {
                parent::notification(title: 'Erro de Validação', message: implode('<br>', $error), level: 'error', type: 'sweetalert', position: 'top-end', timeout: 7000, redirectUrl: '/../admin/products/create');
                exit();
            }
        }
        // Se nenhum tipo de estoque foi definido, o estoque permanece 0 (permitido)
        
        // Convert arrays to JSON for storage
        if (is_array($return['stock_with_size']) && !empty($return['stock_with_size'])) {
            $return['stock_with_size'] = json_encode($return['stock_with_size'], JSON_UNESCAPED_UNICODE);
        } else {
            $return['stock_with_size'] = null;
        }
        
        if (is_array($return['stock_with_color']) && !empty($return['stock_with_color'])) {
            $return['stock_with_color'] = json_encode($return['stock_with_color'], JSON_UNESCAPED_UNICODE);
        } else {
            $return['stock_with_color'] = null;
        }
        
        if (is_array($return['stock_with_size_and_color']) && !empty($return['stock_with_size_and_color'])) {
            $return['stock_with_size_and_color'] = json_encode($return['stock_with_size_and_color'], JSON_UNESCAPED_UNICODE);
        } else {
            $return['stock_with_size_and_color'] = null;
        }

        return $return = (object) $return;
    }


    private static function validate_images(): ?string
    {
        // tratamento da imagem
        if ($_FILES['images']['size'][0] > 0) {

            $uploadService = new FileUpload(uploadDir: 'projects/lexyhands/public/assets/images/products');
            $image = $uploadService->upload(files: $_FILES['images'], params: [
                'rename' => true,
                'multiple' => true,
                'maxSize' => 2, // em MB
                'overwrite' => false,
                'allowedExtensions' => ['jpg', 'png', 'gif'],
                'convert' => 'png', // Converte para PNG
                'alert' => true,
                'url' => '/../admin/products/create',
                'returnJson' => true
            ]);
        } else {
            $image = null;
        }

        return $image;
    }
}

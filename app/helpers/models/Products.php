<?php

use App\Models\Products as Product;
use App\Models\Product_prices as ProductPrices;


//product
function getProduct($id): mixed {
    return Product::getById($id);
}




//prices
function getPricebyProductId(int $id): array|bool {
    if(empty($id)) return false;
    return ProductPrices::getAllByProductId(product_id: $id);
}
function getPrices($id): mixed {
    return ProductPrices::getAllByProductId(product_id: $id);
}
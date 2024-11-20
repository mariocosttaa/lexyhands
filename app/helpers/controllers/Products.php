<?php

use App\Models\products as Product;
use App\Models\product_prices as Prices;

function getProduct($id): mixed {
    return Product::getById($id);
}

function getPrices($id): mixed {
    return Prices::getAllByProductId(product_id: $id);
}


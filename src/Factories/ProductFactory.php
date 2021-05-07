<?php

namespace Devolon\ShoppingCart\Factories;

use Exception;
use Devolon\ShoppingCart\Product\Product;
use Devolon\ShoppingCart\Product\ProductWithSpecialPrice;

class ProductFactory {
    const PRODUCT = "product";
    const PRODUCT_WITH_SPECIAL_PRICE = "productWithSpecialPrice";

    public function getInstance(string $productName, $data) {
        switch ($productName) {
            case self::PRODUCT:
                $product = new Product($data['name'], $data['price']);
            break;
            case self::PRODUCT_WITH_SPECIAL_PRICE:
                $product = new ProductWithSpecialPrice($data['name'], $data['price']);

                if (isset($data['specialPrices'])) {
                    foreach ($data['specialPrices'] as $specialPrice) {
                        $specialPrice = explode('-', $specialPrice);
                        $product->setSpecialPrice((int)$specialPrice[0], (int)$specialPrice[1]);
                    }
                }
            break;
            default:
                throw new Exception("$productName Product Type Not Found.");
            break;    
        }

        return $product;
    }
}
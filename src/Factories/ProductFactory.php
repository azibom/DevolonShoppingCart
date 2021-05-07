<?php

namespace Devolon\ShoppingCart\Factories;

use Exception;
use Devolon\ShoppingCart\Product\Product;
use Devolon\ShoppingCart\Product\ProductWithSpecialPrice;

class ProductFactory {
    public function getInstance(string $productName, $data) {
        switch ($productName) {
            case "product":
                $product = new Product($data['name'], $data['price']);
            break;
            case "productWithSpecialPrice":
                $product = new ProductWithSpecialPrice($data['name'], $data['price']);

                foreach ($data['specialPrices'] as $specialPrice) {
                    $specialPrice = explode('-', $specialPrice);
                    $product->setSpecialPrice((int)$specialPrice[0], (int)$specialPrice[1]);
                }
            break;
            default:
                throw new Exception("$productName product Type Not Found.");
            break;    
        }

        return $product;
    }
}
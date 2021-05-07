<?php

namespace Devolon\ShoppingCart\Factories;

use Exception;
use Devolon\ShoppingCart\Product\Product;
use Devolon\ShoppingCart\Product\ProductWithSpecialPrice;

class ProductFactory
{
    const PRODUCT                    = "product";
    const PRODUCT_WITH_SPECIAL_PRICE = "productWithSpecialPrice";

    /**
     * getInstance function
     *
     * @param string $productName
     * @param array  $data
     *
     * @return Product
     */
    public function getInstance(string $productName, array $data) {
        if ($productName === self::PRODUCT) {
            $product = new Product($data['name'], $data['price']);
        } elseif ($productName === self::PRODUCT_WITH_SPECIAL_PRICE) {
            $product = new ProductWithSpecialPrice($data['name'], $data['price']);
            if (isset($data['specialOffer'])) {
                foreach ($data['specialOffer'] as $specialOffer) {
                    $specialOffer = explode('-', $specialOffer);
                    $specialOfferCount = (int) $specialOffer[0];
                    $specialOfferPrice = (int) $specialOffer[1];
                    $product->setSpecialPrice($specialOfferCount, $specialOfferPrice);
                }
            }
        } else {
            throw new Exception("$productName Product Type Not Found.");
        }

        return $product;
    }
}

<?php

namespace Devolon\ShoppingCart\Supermarket;

use Devolon\ShoppingCart\Product\Product;
use Devolon\ShoppingCart\Product\ProductWithSpecialPrice;

class Supermarket {
    private $order;
    private $products = [];

    public function setProducts(array $products)
    {
        foreach ($products as $product) {
            if (count($product) > 2) {
                $productObject = new ProductWithSpecialPrice($product[0], $product[1]);
                for ($i=2; $i < count($product); $i++) { 
                    $specialOffer = explode('-', $product[$i]);
                    $productObject->setSpecialPrice((int)$specialOffer[0], (int)$specialOffer[1]);
                }

                $this->products[$product[0]] = $productObject;
            } else {
                $this->products[$product[0]] = new Product($product[0], $product[1]);
            }

        }
    }

    public function setOrder(array $productNames)
    {
        $this->order = array_count_values($productNames);
    }

    public function calculateTotalPrice()
    {
        $totalPrice = 0;
        foreach ($this->order as $productName => $productCount) {
            $totalPrice += $this->products[$productName]->calculatePrice($productCount);
        }

        return $totalPrice;
    }
}

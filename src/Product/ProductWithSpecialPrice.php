<?php

namespace Devolon\ShoppingCart\Product;

use Devolon\ShoppingCart\Contrancts\ProductInterface;

class ProductWithSpecialPrice extends Product implements ProductInterface{
    private $specialPrices = [];

    public function setSpecialPrice($count, $price)
    {
        $this->specialPrices[$count] = $price;
    }

    public function calculatePrice(int $count)
    {
        $price = 0;
        krsort($this->specialPrices);
        foreach ($this->specialPrices as $productCount => $productPrice) {
            if ($count >= $productCount) {
                $price += ((int)($count / $productCount) * $productPrice);
                $count = $count % $productCount;
            }

            $price += $count * $this->price;
        }

        return $price;
    }
}
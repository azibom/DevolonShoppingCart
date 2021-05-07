<?php

namespace Devolon\ShoppingCart\Product;

use Devolon\ShoppingCart\Contrancts\ProductInterface;

class ProductWithSpecialPrice extends Product implements ProductInterface
{
    private $specialPrices = [];

    /**
     * setSpecialPrice function
     *
     * @param integer $count
     * @param integer $price
     *
     * @return void
     */
    public function setSpecialPrice(int $count, int $price) {
        $this->specialPrices[$count] = $price;
    }

    /**
     * calculatePrice function
     *
     * @param integer $count
     *
     * @return int
     */
    public function calculatePrice(int $count) {
        $price = 0;
        krsort($this->specialPrices);
        foreach ($this->specialPrices as $productCount => $productPrice) {
            if ($count >= $productCount) {
                $price += ((int) ($count / $productCount) * $productPrice);
                $count  = $count % $productCount;
            }
        }

        $price += $count * $this->price;

        return $price;
    }
}

<?php

namespace Devolon\ShoppingCart\Product;

use Devolon\ShoppingCart\Contracts\ProductInterface;

class Product implements ProductInterface
{
    protected $name;
    protected $price;

    /**
     * __construct function
     *
     * @param string $name
     * @param integer $price
     */
    public function __construct(string $name, int $price) {
        $this->name  = $name;
        $this->price = $price;
    }

    /**
     * calculatePrice function
     *
     * @param integer $productCount
     *
     * @return int
     */
    public function calculatePrice(int $productCount) {
        return $productCount * $this->price;
    }
}

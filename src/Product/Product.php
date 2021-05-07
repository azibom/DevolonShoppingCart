<?php

namespace Devolon\ShoppingCart\Product;

use Devolon\ShoppingCart\Contrancts\ProductInterface;

class Product implements ProductInterface {
    protected $name;
    protected $price;
    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function calculatePrice(int $productCount)
    {
        return $productCount * $this->price;
    }
}

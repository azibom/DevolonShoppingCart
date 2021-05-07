<?php

namespace Devolon\ShoppingCart\Contrancts;

interface ProductInterface {
    public function __construct($name, $price);
    public function calculatePrice(int $productCount);
}
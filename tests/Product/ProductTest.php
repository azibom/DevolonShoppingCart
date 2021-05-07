<?php

use PHPUnit\Framework\TestCase;
use Devolon\ShoppingCart\Product\Product;

class ProductTest extends TestCase 
{
    public function testCalculatePrice() {
        $product = new Product('A', 2);
        $price = $product->calculatePrice(10);
        $this->assertEquals(20, $price);
    }
}
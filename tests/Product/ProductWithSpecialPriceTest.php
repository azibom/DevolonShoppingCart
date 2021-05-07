<?php

use PHPUnit\Framework\TestCase;
use Devolon\ShoppingCart\Product\ProductWithSpecialPrice;

class ProductWithSpecialPriceTest extends TestCase 
{
    public function testCalculatePrice() {
        $product = new ProductWithSpecialPrice('A', 1);
        $price = $product->calculatePrice(10);
        $this->assertEquals(10, $price);

        $product = new ProductWithSpecialPrice('B', 10);
        $product->setSpecialPrice(3, 25);
        $price = $product->calculatePrice(4);
        $this->assertEquals(35, $price);

        $product = new ProductWithSpecialPrice('B', 10);
        $product->setSpecialPrice(3, 29);
        $product->setSpecialPrice(6, 56);
        $price = $product->calculatePrice(10);
        $this->assertEquals(95, $price);
    }
}
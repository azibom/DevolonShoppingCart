<?php

use PHPUnit\Framework\TestCase;
use Devolon\ShoppingCart\Product\Product;
use Devolon\ShoppingCart\Supermarket\Supermarket;
use Devolon\ShoppingCart\Factories\ProductFactory;
use Devolon\ShoppingCart\Product\ProductWithSpecialPrice;

class SupermarketTest extends TestCase 
{
    public function testSetOrderAndGetOrder() {
        $productFactoryStub = $this->createMock(ProductFactory::class);
        $supermarket = new Supermarket($productFactoryStub);
        $supermarket->setOrder(['A', 'A']);
        $order = $supermarket->getOrder();

        $this->assertEquals($order, ['A' => 2]);
    }

    public function testSetProductsAndGetProductsWithProduct() {
        $productFactoryStub = $this->createMock(ProductFactory::class);
        $productFactoryStub->method('getInstance')->willReturn(new Product('A', 10));

        $supermarket = new Supermarket($productFactoryStub);
        $supermarket->setProducts([
            ['A', 10],
        ]);

        $products = $supermarket->getProducts();
        $this->assertEquals(count($products), 1);
        $this->assertTrue($products['A'] instanceof Product);
    }

    public function testSetProductsAndGetProductsWithProductWithSpecialPrice() {
        $productFactoryStub = $this->createMock(ProductFactory::class);
        $product = new ProductWithSpecialPrice('B', 10);
        $product->setSpecialPrice(3, 25);
        $productFactoryStub->method('getInstance')->willReturn($product);

        $supermarket = new Supermarket($productFactoryStub);
        $supermarket->setProducts([
            ['B', 10, '3-25'],
        ]);

        $products = $supermarket->getProducts();
        $this->assertEquals(count($products), 1);
        $this->assertTrue($products['B'] instanceof ProductWithSpecialPrice);
    }

    public function testCalculateTotalPrice() {
        $productFactoryStub = $this->createMock(ProductFactory::class);
        $productStub = $this->createMock(Product::class);

        $productStub->method('calculatePrice')->willReturn(30);
        $productFactoryStub->method('getInstance')->willReturn($productStub);

        $supermarket = new Supermarket($productFactoryStub);
        $supermarket->setProducts([
            ['A', 10],
        ]);

        $supermarket->setOrder(['A', 'A', 'A']);
        $price = $supermarket->calculateTotalPrice();
        $this->assertEquals($price, 30);
    }
}
<?php

use PHPUnit\Framework\TestCase;
use Devolon\ShoppingCart\Product\Product;
use Devolon\ShoppingCart\Factories\ProductFactory;
use Devolon\ShoppingCart\Product\ProductWithSpecialPrice;

class ProductFactoryTest extends TestCase 
{
    private $productFactory;
    public function __construct()
    {
        parent::__construct();
        $this->productFactory = new ProductFactory;
    }

    public function testGetInstanceWithProduct() {
        $data = [
            'name'  => 'A',
            'price' => 10,
        ];

        $product = $this->productFactory->getInstance(ProductFactory::PRODUCT, $data);
        $this->assertTrue($product instanceof Product);
    }

    public function testGetInstanceWithProductWithSpecialPrice() {
        $data = [
            'name'  => 'A',
            'price' => 10,
        ];

        $product = $this->productFactory->getInstance(ProductFactory::PRODUCT_WITH_SPECIAL_PRICE, $data);
        $this->assertTrue($product instanceof ProductWithSpecialPrice);

        $data = [
            'name'  => 'B',
            'price' => 10,
            'specialOffer' => [
                '3-29',
                '6-55',
            ]
        ];

        $product = $this->productFactory->getInstance(ProductFactory::PRODUCT_WITH_SPECIAL_PRICE, $data);
        $this->assertTrue($product instanceof ProductWithSpecialPrice);
    }

    public function testGetInstanceWithIncorrectProductType() {
        $message = '';
        $data = [
            'name'  => 'A',
            'price' => 10,
        ];

        try {
            $this->productFactory->getInstance("New Type!", $data);
        } catch (\Throwable $th) {
            $message = $th->getMessage();
        }

        $this->assertEquals($message , 'New Type! Product Type Not Found.');
    }
}
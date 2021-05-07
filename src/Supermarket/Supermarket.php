<?php

namespace Devolon\ShoppingCart\Supermarket;

use Devolon\ShoppingCart\Factories\ProductFactory;

class Supermarket {
    private $order;
    private $products = [];
    private $productFactory;

    public function __construct(ProductFactory $productFactory)
    {
        $this->productFactory = $productFactory;
    }

    public function setProducts(array $products)
    {
        foreach ($products as $product) {
            $data = [
                'name'  => $product[0],
                'price' => $product[1],
            ];

            if (count($product) > 2) {
                $data['specialPrices'] = array_slice($product, 2);
                $this->products[$product[0]] = $this->productFactory->getInstance(ProductFactory::PRODUCT_WITH_SPECIAL_PRICE, $data);
            } else {
                $this->products[$product[0]] = $this->productFactory->getInstance(ProductFactory::PRODUCT, $data);
            }
        }
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function setOrder(array $productNames)
    {
        $this->order = array_count_values($productNames);
    }

    public function getOrder()
    {
        return $this->order;
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

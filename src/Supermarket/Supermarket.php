<?php

namespace Devolon\ShoppingCart\Supermarket;

use Devolon\ShoppingCart\Factories\ProductFactory;

class Supermarket
{
    const INDEX_OF_PRODUCT_NAME  = 0;
    const INDEX_OF_PRODUCT_PRICE = 1;

    private $order;
    private $products = [];
    private $productFactory;

    /**
     * __construct function
     *
     * @param ProductFactory $productFactory
     */
    public function __construct(ProductFactory $productFactory) {
        $this->productFactory = $productFactory;
    }

    /**
     * setProducts function
     *
     * @param array $products
     *
     * @return void
     */
    public function setProducts(array $products) {
        foreach ($products as $product) {
            $productName  = $product[self::INDEX_OF_PRODUCT_NAME];
            $productPrice = $product[self::INDEX_OF_PRODUCT_PRICE];

            $data = [
                'name'  => $productName,
                'price' => $productPrice,
            ];

            if ($this->isProductWithSpecialPrice($product)) {
                $data['specialOffer']         = array_slice($product, 2);
                $this->products[$productName] = $this->productFactory->getInstance(ProductFactory::PRODUCT_WITH_SPECIAL_PRICE, $data);
            } else {
                $this->products[$productName] = $this->productFactory->getInstance(ProductFactory::PRODUCT, $data);
            }
        }
    }

    /**
     * getProducts function
     *
     * @return array
     */
    public function getProducts() {
        return $this->products;
    }

    /**
     * setOrder function
     *
     * @param array $productNames
     *
     * @return void
     */
    public function setOrder(array $productNames) {
        $this->order = array_count_values($productNames);
    }

    /**
     * getOrder function
     *
     * @return array
     */
    public function getOrder() {
        return $this->order;
    }

    /**
     * calculateTotalPrice function
     *
     * @return int
     */
    public function calculateTotalPrice() {
        $totalPrice = 0;
        foreach ($this->order as $productName => $productCount) {
            $totalPrice += $this->products[$productName]->calculatePrice($productCount);
        }

        return $totalPrice;
    }

    /**
     * isProductWithSpecialPrice function
     *
     * @param array $product
     *
     * @return boolean
     */
    private function isProductWithSpecialPrice(array $product) {
        return count($product) > 2;
    }
}

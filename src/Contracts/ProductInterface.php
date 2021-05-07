<?php

namespace Devolon\ShoppingCart\Contracts;

interface ProductInterface
{
    /**
     * __construct function
     *
     * @param string $name
     * @param integer $price
     */
    public function __construct(string $name, int $price);

    /**
     * calculatePrice function
     *
     * @param integer $productCount
     *
     * @return int
     */
    public function calculatePrice(int $productCount);
}

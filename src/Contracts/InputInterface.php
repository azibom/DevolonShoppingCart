<?php

namespace Devolon\ShoppingCart\Contracts;

interface InputInterface
{
    /**
     * getProducts function
     *
     * @return array
     */
    public function getProducts();

    /**
     * getOrder function
     *
     * @return array
     */
    public function getOrder();
}

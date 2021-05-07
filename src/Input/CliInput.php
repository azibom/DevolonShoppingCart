<?php

namespace Devolon\ShoppingCart\Input;

use Devolon\ShoppingCart\Contracts\InputInterface;

class CliInput implements InputInterface
{
    private $productsData = [];
    private $order;

    /**
     * getProducts function
     *
     * @return array
     */
    public function getProducts() {
        $count = (int) fgets(STDIN);
        for ($i = 0; $i < $count; $i++) {
            $this->productsData[] = explode(' ', str_replace(PHP_EOL, '', fgets(STDIN)));
        }

        return $this->productsData;
    }

    /**
     * getOrder function
     *
     * @return array
     */
    public function getOrder() {
        $this->order = explode(' ', str_replace(PHP_EOL, '', fgets(STDIN)));

        return $this->order;
    }
}

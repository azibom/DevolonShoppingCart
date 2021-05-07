<?php

namespace Devolon\ShoppingCart\Input;

use Devolon\ShoppingCart\Contrancts\InputInterface;

class CliInput implements InputInterface {
    private $productsData = [];
    private $order;

    public function getProducts()
    {
        $count = (int)fgets(STDIN);
        for ($i=0; $i < $count; $i++) { 
            $this->productsData[] = explode(' ', str_replace(PHP_EOL, '', fgets(STDIN)));
        }

        return $this->productsData;
    }

    public function getOrder()
    {
        $this->order = explode(' ', str_replace(PHP_EOL, '', fgets(STDIN)));
        
        return $this->order;
    }
}

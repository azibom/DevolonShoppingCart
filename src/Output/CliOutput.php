<?php

namespace Devolon\ShoppingCart\Output;

use Devolon\ShoppingCart\Contracts\OutputInterface;

class CliOutput implements OutputInterface
{
    /**
     * print function
     *
     * @param mixed $message
     * @return string
     */
    public function print($message) {
        echo $message . PHP_EOL;
    }
}

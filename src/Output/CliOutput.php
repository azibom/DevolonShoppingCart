<?php

namespace Devolon\ShoppingCart\Output;

use Devolon\ShoppingCart\Contrancts\OutputInterface;

class CliOutput implements OutputInterface {
    public function print($message)
    {
        echo $message . PHP_EOL;
    }
}

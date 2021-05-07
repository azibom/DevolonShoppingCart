<?php
require './vendor/autoload.php';

use Devolon\ShoppingCart\Input\CliInput;
use Devolon\ShoppingCart\Supermarket\Supermarket;

$inputer = new CliInput;
$productsData = $inputer->getProducts();
$order        = $inputer->getOrder();
$supermarket = new Supermarket;
$supermarket->setProducts($productsData);
$supermarket->setOrder($order);

echo $supermarket->calculateTotalPrice() . PHP_EOL;
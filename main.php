<?php
require './vendor/autoload.php';

use Devolon\ShoppingCart\Input\CliInput;
use Devolon\ShoppingCart\Supermarket\Supermarket;
use Devolon\ShoppingCart\Factories\ProductFactory;

$inputer      = new CliInput;
$productsData = $inputer->getProducts();
$order        = $inputer->getOrder();

$productFactory = new ProductFactory;
$supermarket    = new Supermarket($productFactory);
$supermarket->setProducts($productsData);
$supermarket->setOrder($order);

echo $supermarket->calculateTotalPrice() . PHP_EOL;
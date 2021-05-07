<?php
require './vendor/autoload.php';

use Devolon\ShoppingCart\Input\CliInput;
use Devolon\ShoppingCart\Output\CliOutput;
use Devolon\ShoppingCart\Supermarket\Supermarket;
use Devolon\ShoppingCart\Factories\ProductFactory;

$input        = new CliInput;
$productsData = $input->getProducts();
$order        = $input->getOrder();

$productFactory = new ProductFactory;
$supermarket    = new Supermarket($productFactory);
$supermarket->setProducts($productsData);
$supermarket->setOrder($order);

$output = new CliOutput;
$output->print($supermarket->calculateTotalPrice());
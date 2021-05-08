# DevolonShoppingCart
### Problem Description
we should implement the code for a supermarket checkout that calculates the total price of some
items.
An item has the following attributes: <br>
    ● Name <br>
    ● Unit Price <br>
Our goods are priced individually. Some items are multi-priced: buy n of them, and they’ll cost
you less than buying them individually. For example, item ‘A’ might cost $50 individually, but this
week we have a special offer: buy three ‘A’s and they’ll cost you $130.
Here is an example of prices: <br>

| Name | Unit Price | Special Price |
| :---         |     :---:      |          ---: |
| A     | $50       | 3 for $130 |
| B     | $30       | 2 for $45 |
| C     | $20       ||
| D     | $15       ||

Our checkout accepts items in any order, so that if we scan a B, an A, and another B, we’ll
recognize two B’s and price them at 45 (for a total price so far of 95). Because the pricing
changes frequently, we need to be able to pass in a set of pricing rules each time we start
handling a checkout transaction. <br>
Here are some examples of cases:

| Items | Total
| :---         |     :---:      |
| A, B     | $80       |
| A, A     | $100       |
| A, A, A     | $130       |
| C, D, B, A     | $115       |

## Code Description

### Code Structure
Our project code are in the `src` directory so lets check files in this directory
```
.
├── Contracts
│   ├── InputInterface.php
│   ├── OutputInterface.php
│   └── ProductInterface.php
├── Factories
│   └── ProductFactory.php
├── Input
│   └── CliInput.php
├── Output
│   └── CliOutput.php
├── Product
│   ├── Product.php
│   └── ProductWithSpecialPrice.php
└── Supermarket
    └── Supermarket.php

6 directories, 9 files
```
#### 1.Contracts
We use `Contracts` directory and define our `Interfaces` in it
#### 2.Factories
We use `Factories` directory and difine our factory method implementation on it (I define product factory method for creating diffrent type of the product)
#### 3.Input And Output
We use `Input And Output` for get the data and show them to the client. <br>
I seprate the Input and Output from the code logic and we can for example just define a new Input class and implement the `InputInterface` and use it in our app  
#### 4.Product
We use `product` class to define our products and also use `ProductWithSpecialPrice` class to difine our product with special price (that is child of `product` and that is a adapter class and have one method to get the special price and overwrite the `calculatePrice` too)
#### 5.Supermarket
We set products and order in `Supermarket` class and also it get the total price from our products and gathers together and that is the core of our project

### How does it works
lets look at the `main.php` file to answer this question
```php
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
```
First we `new` the `CliInput` class and get the `order` and `productsData` from it.
Then we `new` the `ProductFactory` and inject it to the new supermarket class, and supermarket class use it to make the new product objects. 
Then we use `setProducts` and `setOrder` to set the products and order data and finally with `calculateTotalPrice` we calculate the price and show it with help of `print` in `CliOutput`.

### How can I run it
I define a `Dockerfile` for the project and you can use it like this: <br>
Go to the root of the project (where you can see `Dockerfile`) and then run this commands
```
docker build -t php-cli-img .
docker run -it --rm php-cli-img
```
And now you need to set the inputs, for example to sth like this
```
2
A 10
B 20 3-59
A A A B B B
```
It means you have two products and the price of `A` is `10` and the price of `B` is `20` and if you buy `3` numbers of `B` you can pay `59` instead of `60`. <br>
And the end line also show you the order, in this case you buy `3` of `B` and `3` of `A`
#### Output
```
89
```
And your output will be the total price

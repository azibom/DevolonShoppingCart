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
And the end line also show you the order, in this case you buy `3` of `B` and `3` of `A`. <br>
(If you want for example read the input from the file you can just make the new Input class and implement it from InputInterface and just use it easily, because that part is completly separated from the other part of the code, also you can do it with output)
#### Output
```
89
```
And your output will be the total price

### Code Quality

#### Code styles
I use `phpcs` for check the style of the code and I also use my rules which is in `phpcs.xml` and you can check it with this command 
```
docker run -it --rm php-cli-img vendor/bin/phpcs --standard=./phpcs.xml
```

#### Unit tests
I use `phpunit` for writing unit tests and my code coverage is 100% right now
```
PHPUnit 8.5.15 by Sebastian Bergmann and contributors.

.........                                                           9 / 9 (100%)

Time: 134 ms, Memory: 6.00 MB

OK (9 tests, 14 assertions)


Code Coverage Report:     
  2021-05-08 10:22:59     
                          
 Summary:                 
  Classes: 100.00% (4/4)  
  Methods: 100.00% (12/12)
  Lines:   100.00% (47/47)

\Devolon\ShoppingCart\Factories::Devolon\ShoppingCart\Factories\ProductFactory
  Methods: 100.00% ( 1/ 1)   Lines: 100.00% ( 12/ 12)
\Devolon\ShoppingCart\Product::Devolon\ShoppingCart\Product\Product
  Methods: 100.00% ( 2/ 2)   Lines: 100.00% (  4/  4)
\Devolon\ShoppingCart\Product::Devolon\ShoppingCart\Product\ProductWithSpecialPrice
  Methods: 100.00% ( 2/ 2)   Lines: 100.00% ( 10/ 10)
\Devolon\ShoppingCart\Supermarket::Devolon\ShoppingCart\Supermarket\Supermarket
  Methods: 100.00% ( 7/ 7)   Lines: 100.00% ( 21/ 21)
```
And you can run it with this command
```
docker run -it --rm php-cli-img vendor/bin/phpunit
```

#### Feature tests
I use behat for writing the feature test and I define some scenarios and test the all project functionality in it <br> My scenarios are like this
```
Scenario: Buy Products And ProductWithSpecialPrices
    Given there is one product with name A and cost 10
    Given there is one special price on product A and if you buy 3 of them you should pay 25
    Given there is one product with name B and cost 20
    And  our order is like this AABAA
    And  set products in supermarket
    Then Our total cost should be 55
```
And you can run these tests with this command
```
docker run -it --rm php-cli-img vendor/bin/behat
```
output
```
Feature: ShoppingCart
    In order to buy some products and calculate the price of them
    And I need to first define some products
    And I need to create an order
    Then I can get the total price

  Scenario: Buy Products                               
    Given there is one product with name A and cost 10 
    Given there is one product with name B and cost 20 
    And our order is like this ABABAB                  
    And set products in supermarket                    
    Then Our total cost should be 90                   

  Scenario: Buy ProductWithSpecialPrices                                                     
    Given there is one product with name A and cost 10                                       
    Given there is one product with name B and cost 20                                       
    Given there is one special price on product A and if you buy 3 of them you should pay 29 
    Given there is one special price on product A and if you buy 6 of them you should pay 55 
    Given there is one special price on product B and if you buy 3 of them you should pay 58 
    And our order is like this AAAAAAAAAABBBB                                                
    And set products in supermarket                                                          
    Then Our total cost should be 172                                                        

  Scenario: Buy Products And ProductWithSpecialPrices                                        
    Given there is one product with name A and cost 10                                       
    Given there is one special price on product A and if you buy 3 of them you should pay 25 
    Given there is one product with name B and cost 20                                       
    And our order is like this AABAA                                                         
    And set products in supermarket                                                          
    Then Our total cost should be 55                                                         

3 scenarios (3 passed)
19 steps (19 passed)
0m0.04s (10.26Mb)
```

### use Makefile
I also define a Makefile for myself to make life easier and that is like this
```
setup:
	docker build -t php-cli-img .
run:
	docker run -it --rm php-cli-img
unitTest:
	docker run -it --rm php-cli-img vendor/bin/phpunit
behavioralTest:		
	docker run -it --rm php-cli-img vendor/bin/behat
codeStyleChecker:		
	docker run -it --rm php-cli-img vendor/bin/phpcs --standard=./phpcs.xml
```
And if you want you can use it for example run the project like this
```
make setup
make run
```
Or check the style just with this command
```
make codeStyleChecker
```

### About me
Because this is a task for hiring, I also write a little about myself :) <br> <br>

A Happy Software Engineer who has skills in Python, PHP, js and Machine Learning. Mohammad has been trying hard to be better than yesterday everyday. <br>

Linkedin : https://www.linkedin.com/in/azibom/ <br>
Dev.To : https://dev.to/azibom <br>
Github : https://github.com/azibom <br>
Stackoverflow : https://stackoverflow.com/users/13060981/azibom <br>
Kaggle : https://www.kaggle.com/moresha <br>



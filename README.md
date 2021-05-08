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




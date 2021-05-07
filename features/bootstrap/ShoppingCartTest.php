<?php

use PHPUnit\Framework\Assert;
use Behat\Behat\Context\Context;
use Devolon\ShoppingCart\Supermarket\Supermarket;
use Devolon\ShoppingCart\Factories\ProductFactory;

class ShoppingCartTest implements Context
{
    private $products = [];
    private $supermarket;
    
    public function __construct()
    {
        $this->supermarket = new Supermarket(new ProductFactory);
    }

    /**
     * @Given there is one product with name :arg1 and cost :arg2
     */
    public function thereIsOneProductWithNameAndCost($arg1, $arg2)
    {
        $this->products[$arg1] = [$arg1, $arg2];
    }

    /**
     * @Given our order is like this :arg1
     */
    public function ourOrderIsLikeThis($arg1)
    {
        $this->supermarket->setOrder(str_split($arg1));
    }

    /**
     * @Then Our total cost should be :arg1
     */
    public function ourTotalCostShouldBe($arg1)
    {
        Assert::assertSame($this->supermarket->calculateTotalPrice(), (int)$arg1);
    }

    /**
     * @Given set products in supermarket
     */
    public function setProductsInSupermarket()
    {
        $this->supermarket->setProducts($this->products);
    }

    /**
     * @Given there is one special price on product :arg1 and if you buy :arg2 of them you should pay :arg3
     */
    public function thereIsOneSpecialPriceOnProductAndIfYouBuyOfThemYouShouldPay($arg1, $arg2, $arg3)
    {
        $this->products[$arg1] = array_merge($this->products[$arg1], ["$arg2-$arg3"]);
    }
}

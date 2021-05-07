<?php

class Supermarket {
    private $order;
    private $products = [];

    public function setProducts(array $products)
    {
        foreach ($products as $product) {
            if (count($product) > 2) {
                $productObject = new ProductWithSpecialPrice($product[0], $product[1]);
                for ($i=2; $i < count($product); $i++) { 
                    $specialOffer = explode('-', $product[$i]);
                    $productObject->setSpecialPrice((int)$specialOffer[0], (int)$specialOffer[1]);
                }

                $this->products[$product[0]] = $productObject;
            } else {
                $this->products[$product[0]] = new Product($product[0], $product[1]);
            }

        }
    }

    public function setOrder(array $productNames)
    {
        $this->order = array_count_values($productNames);
    }

    public function calculateTotalPrice()
    {
        $totalPrice = 0;
        foreach ($this->order as $productName => $productCount) {
            $totalPrice += $this->products[$productName]->calculatePrice($productCount);
        }

        return $totalPrice;
    }
}

class Product {
    protected $name;
    protected $price;
    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function calculatePrice(int $productCount)
    {
        return $productCount * $this->price;
    }
}


class ProductWithSpecialPrice extends Product {
    private $specialPrices = [];

    public function setSpecialPrice($count, $price)
    {
        $this->specialPrices[$count] = $price;
    }

    public function calculatePrice(int $count)
    {
        $price = 0;
        krsort($this->specialPrices);
        foreach ($this->specialPrices as $productCount => $productPrice) {
            if ($count >= $productCount) {
                $price += ((int)($count / $productCount) * $productPrice);
                $count = $count % $productCount;
            }

            $price += $count * $this->price;
        }

        return $price;
    }
}

$count = (int)fgets(STDIN);
$productsData = [];
for ($i=0; $i < $count; $i++) { 
    $productsData[] = explode(' ', str_replace(PHP_EOL, '', fgets(STDIN)));
}

$input = explode(' ', str_replace(PHP_EOL, '', fgets(STDIN)));

$supermarket = new Supermarket;
$supermarket->setProducts($productsData);
$supermarket->setOrder($input);
echo $supermarket->calculateTotalPrice() . PHP_EOL;
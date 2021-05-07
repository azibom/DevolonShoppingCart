Feature: ShoppingCart
    In order to buy some products and calculate the price of them
    And I need to first define some products
    And I need to create an order 
    Then I can get the total price 

    Scenario: Buy Products
        Given there is one product with name A and cost 10
        Given there is one product with name B and cost 20
        And  our order is like this ABABAB
        And  set products in supermarket
        Then Our total cost should be 90

    Scenario: Buy ProductWithSpecialPrices
        Given there is one product with name A and cost 10
        Given there is one product with name B and cost 20
        Given there is one special price on product A and if you buy 3 of them you should pay 29
        Given there is one special price on product A and if you buy 6 of them you should pay 55
        Given there is one special price on product B and if you buy 3 of them you should pay 58
        And  our order is like this AAAAAAAAAABBBB
        And  set products in supermarket
        Then Our total cost should be 172

    Scenario: Buy Products And ProductWithSpecialPrices
        Given there is one product with name A and cost 10
        Given there is one special price on product A and if you buy 3 of them you should pay 25
        Given there is one product with name B and cost 20
        And  our order is like this AABAA
        And  set products in supermarket
        Then Our total cost should be 55

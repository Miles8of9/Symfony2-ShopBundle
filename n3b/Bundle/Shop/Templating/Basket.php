<?php

namespace n3b\Bundle\Shop\Templating;

use Symfony\Component\Templating\Helper\Helper;
use n3b\Bundle\Shop\Service\Basket as BasketService;

class Basket extends Helper
{
    protected $basket;

    public function __construct(BasketService $bs)
    {
        $this->basket = $bs->getBasket();
    }

    public function getName()
    {
        return 'basket';
    }

    public function getItems()
    {
        return $this->basket->getItems();
    }
}

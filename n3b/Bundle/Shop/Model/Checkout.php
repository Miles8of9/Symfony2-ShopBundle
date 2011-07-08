<?php

namespace n3b\Bundle\Shop\Model;

use n3b\Bundle\Shop\Entity\BasketItem;
use n3b\Bundle\Shop\Entity\CheckoutItem;

abstract class Checkout
{
    
    public function __construct()
    {
    }

    public function addBasketItem(BasketItem $item)
    {
        $cItem = new CheckoutItem();
        $cItem->setProduct($item->getProduct());
        $cItem->setPrice(1111);
        $cItem->setQuantity($item->getQuantity());
        $cItem->setCheckout($this);

        $this->addItems($cItem);
    }
}

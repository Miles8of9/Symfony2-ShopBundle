<?php

namespace n3b\Bundle\Shop\Model;

use n3b\Bundle\Shop\Entity\BasketItem;
use Doctrine\Common\Collections\ArrayCollection;

abstract class Basket
{

    protected function __construct()
    {

    }

    public function isInBasket(Product $product)
    {
        foreach($this->getItems() as $item)
            if($product == $item->getProduct())
                return $item;
        return null;
    }

    public function addProduct(Product $product)
    {
        if($item = $this->isInBasket($product))
            $item->setQuantity($item->getQuantity() + 1);
        else {
            $item = new BasketItem();
            $item->setProduct($product);
            $item->setQuantity(1);

            $item->setBasket($this);
            $this->addItems($item);
        }

        return $item;
    }
}


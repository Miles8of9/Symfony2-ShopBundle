<?php

namespace n3b\Bundle\Shop\Model;

use n3b\Bundle\Shop\Entity\BasketItem;

abstract class Basket {

    protected function __construct()
    {
    }
    
    public function isInBasket(Product $product)
    {
        foreach ($this->getItems() as $item)
            if ($product == $item->getProduct())
                return $item;
        return null;
    }

    public function addProduct(Product $product, $em)
    {
        //$this->repo->increaseQuantity($this->basket->getId(), $product->getId());
        //return true;

        // предположительно, если в корзине нет товаров, она отсутствует в БД.
        if(!count($this->getItems()))
            $em->persist($this);

        if ($item = $this->isInBasket($product)) {
            $item->setQuantity($item->getQuantity() + 1);
        } else {
            $item = new BasketItem();
            $item->setProduct($product);
            $item->setQuantity(1);

            $item->setBasket($this);
            $this->addItems($item);

            $em->persist($item);
        }
        $em->flush();
    }
}


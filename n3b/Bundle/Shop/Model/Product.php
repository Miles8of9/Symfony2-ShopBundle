<?php

namespace n3b\Bundle\Shop\Model;

abstract class Product {

    protected function __construct()
    {
    }

    public function __toString()
    {
        return $this->getTitle();
    }

    public function getPrice($formatted = false)
    {
        $prices = $this->getPrices();

        $price = $prices[0]->getValue() * $prices[0]->getCurrency()->getValue();

        if($formatted)
            return str_replace(',00', '', number_format($price, 2, ',', ' '));

        return $price;
    }

    public function getImgSrc($image, $type = 0)
    {
        if(!$image)
            return '/bundles/n3bshop/images/blank_mal.jpg';

        return 'http://smartphoto.ru:81/uploads' . $image->getSubdir() . '/' . \preg_replace('/^(.+)(\.\w+)$/', '\\1' . '_' . $type . '\\2', $image->getFilename());
    }
}

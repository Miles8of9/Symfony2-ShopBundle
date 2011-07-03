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
}

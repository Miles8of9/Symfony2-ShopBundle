<?php

namespace n3b\Bundle\Shop\Exchange\Interfaces;

interface ProductInterface
{
    public function getId();

    public function getTitle();

    public function getArticle();

    public function getPrices();

    public function getQuantity();

    public function getActive();
}

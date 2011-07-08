<?php

namespace n3b\Bundle\Shop\Service;

class Customer
{
    protected $services;

    public function __construct($services)
    {
        $this->services = $services;
    }

    public function index()
    {
        return $this->services['templating']->renderResponse('n3bShopBundle:Customer:index.html.php');
    }
}
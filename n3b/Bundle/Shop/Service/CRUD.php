<?php

namespace n3b\Bundle\Shop\Service;

use n3b\Bundle\Shop\Form\CustomerLoginType;

class CRUD
{
    protected $services;

    public function __construct($services)
    {
        $this->services = $services;
    }
}
<?php

namespace n3b\Bundle\Shop\Service;

use Symfony\Component\Security\Core\SecurityContext;

class Customer
{
    protected $services;

    public function __construct($services)
    {
        $this->services = $services;
    }

    public function index()
    {
        return $this->services['templating']->renderResponse(
            'n3bShopBundle:Customer:index.html.php',
            array('customer' => $this->services['sc']->getToken()->getUser(),
            ));
    }

    public function login()
    {
        if ($this->services['request']->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $this->services['request']->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $this->services['request']->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->services['templating']->renderResponse('n3bShopBundle:Customer:login.html.php', array(
            'last_username' => $this->services['request']->getSession()->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }
}
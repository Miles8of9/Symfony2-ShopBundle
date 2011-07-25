<?php

namespace n3b\Bundle\Shop\Event;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class EventListener
{
    protected $services;

    public function __construct($services)
    {
        $this->services = $services;
    }

    public function onCoreRequest(GetResponseEvent $event)
    {
        $this->services['basket']->init(
            $event->getRequest()->cookies->get('bsid'),
            $event->getRequest()->cookies->get('dontShowBasket'),
            $event->getRequest()->isXmlHttpRequest()
            );
    }

    public function onCoreResponse(FilterResponseEvent $event)
    {
        $event->getResponse()->headers->setCookie($this->services['basket']->getBasketCookie());
    }
}

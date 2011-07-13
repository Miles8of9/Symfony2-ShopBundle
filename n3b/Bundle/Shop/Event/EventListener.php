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
        $this->services['basket']->init($event->getRequest());

        // для ajax запросов
        if(!$event->getRequest()->isXmlHttpRequest())
            return;

        foreach($this->services['basket']->getAjaxCallbacks() as $requestedValue => $callback)
            if($request = $event->getRequest()->get($requestedValue))
                $this->services['basket']->$callback($request, false);
    }

    public function onCoreResponse(FilterResponseEvent $event)
    {
        $event->getResponse()->headers->setCookie($this->services['basket']->getBasketCookie());
    }
}

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
        $this->services['basket']->init($event->getRequest()->cookies->get('bsid'));

        // для ajax запросов
        if(!$event->getRequest()->isXmlHttpRequest())
            return;

        foreach($this->services['basket']->getAjaxCallbacks() as $reqParam => $callback)
            if($reqVal = $event->getRequest()->get($reqParam))
                $this->services['basket']->$callback($reqVal, false);
    }

    public function onCoreResponse(FilterResponseEvent $event)
    {
        $event->getResponse()->headers->setCookie($this->services['basket']->getBasketCookie());
    }
}

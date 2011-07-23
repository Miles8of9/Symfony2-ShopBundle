<?php

namespace n3b\Bundle\Shop\Exchange;

use n3b\Bundle\Shop\Exchange\Interfaces\ServiceCenterInterface;
use n3b\Bundle\Shop\Entity\ServiceCenter;

class ServiceCenterImporter
{
    protected $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function import(ServiceCenterInterface $impSC)
    {
        if(!$sc = $this->em->getRepository('n3bShopBundle:ServiceCenter')->find($impSC->getId())) {
            $sc = new ServiceCenter();
            $sc->setId($impSC->getId());
            $this->em->persist($sc);
        }

        $sc->setTitle($impSC->getTitle());
        $sc->setUrl($impSC->getUrl());
        $sc->setMail($impSC->getMail());
        $sc->setWorkingTime($impSC->getWorkingTime());
        $sc->setAdds($impSC->getAdds());
        $sc->setPhones($impSC->getPhones());
    }
}

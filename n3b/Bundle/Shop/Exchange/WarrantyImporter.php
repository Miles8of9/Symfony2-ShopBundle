<?php

namespace n3b\Bundle\Shop\Exchange;

use n3b\Bundle\Shop\Exchange\Interfaces\WarrantyInterface;
use n3b\Bundle\Shop\Entity\Warranty;

class WarrantyImporter
{
    protected $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function import(WarrantyInterface $impW, $references = false)
    {
        if(!$w = $this->em->getRepository('n3bShopBundle:Warranty')->find($impW->getId())) {
            $w = new Warranty();
            $w->setId($impW->getId());
            $this->em->persist($w);
        }

        if(!$references) {

            $w->setTitle($impW->getTitle());
            $w->setDescription($impW->getDescription());
            $w->setDuration($impW->getDuration());
            $w->setOficial($impW->isOfficial());
            
        } else {
            
        }
    }
}

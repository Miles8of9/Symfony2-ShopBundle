<?php

namespace n3b\Bundle\Shop\Exchange;

use n3b\Bundle\Shop\Exchange\Interfaces\ProductInterface;
use n3b\Bundle\Shop\Entity\Product;
use n3b\Bundle\Shop\Entity\ProductPrice;
use n3b\Bundle\Shop\Entity\ProductAdditional;

class ProductImporter
{
    protected $em;
    protected $currencies;
    protected $types;

    public function __construct($em)
    {
        $this->em = $em;
        $this->types = $this->em->getRepository('n3bShopBundle:Price')->findAll();
        $this->currencies = $this->em->getRepository('n3bShopBundle:Currency')->findAll();

        foreach($this->types as $k => $v) {
            $this->types[$v->getTitle()] = $v;
            unset($this->types[$k]);
        }

        foreach($this->currencies as $k => $v) {
            $this->currencies[$v->getTitle()] = $v;
            unset($this->currencies[$k]);
        }
    }

    public function import(ProductInterface $impP, $references = false)
    {
        if(!$p = $this->em->getRepository('n3bShopBundle:Product')->find($impP->getId())) {
            $p = new Product();
            $p->setId($impP->getId());
            $this->em->persist($p);
        }

        if(!$references) {

            $p->setTitle($impP->getTitle());
            $p->setActive($impP->getActive());
            $p->setQuantity($impP->getQuantity());

            if(!$p->getAdditional())
                $p->setAdditional(new ProductAdditional());

            $p->getAdditional()->setArt($impP->getArticle());

            foreach($impP->getPrices() as $k => $v) {
                if(!\array_key_exists($v['type'], $this->types) || !\array_key_exists($v['currency'], $this->currencies))
                    continue;

                $prc = new ProductPrice();
                $prc->setPrice($this->types[$v['type']]);
                $prc->setCurrency($v['currency']);
                $prc->setValue($v['value']);

                $p->addPrices($prc);
                $prc->setProduct($p);
            }

            $p->slugify();

        } else {

            

        }
    }
}

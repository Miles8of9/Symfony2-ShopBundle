<?php

namespace n3b\Bundle\Shop\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use n3b\Bundle\Shop\Entity\Price;

class LoadPriceData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load($em)
    {
        $price = new Price();
        $price->setTitle('Розничная');
        $price2 = new Price();
        $price2->setTitle('Оптовая');

        $em->persist($price);
        $em->persist($price2);
        $em->flush();

        $this->addReference('price1', $price);
        $this->addReference('price2', $price2);
    }

    public function getOrder()
    {
        return 20;
    }
}

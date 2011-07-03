<?php

namespace n3b\Bundle\Shop\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use n3b\Bundle\Shop\Entity\Currency;

class LoadCurrencyData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load($em)
    {
        $c = new Currency();
        $c->setTitle('RUB');
        $c->setValue(1);
        $c2 = new Currency();
        $c2->setTitle('USD');
        $c2->setValue(29.5);

        $em->persist($c);
        $em->persist($c2);
        $em->flush();

        $this->addReference('currency1', $c);
        $this->addReference('currency2', $c2);
    }

    public function getOrder()
    {
        return 20;
    }
}

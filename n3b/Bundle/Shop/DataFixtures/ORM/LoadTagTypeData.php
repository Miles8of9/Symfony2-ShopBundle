<?php

namespace n3b\Bundle\Shop\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use n3b\Bundle\Shop\Entity\TagType;

class LoadTagData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load($em)
    {
        $type = new TagType();
        $type->setTitle('Категория');

        $type2 = new TagType();
        $type2->setTitle('Бренд');

        $em->persist($type);
        $em->persist($type2);
        $em->flush();

        $this->addReference('category-tagtype', $type);
        $this->addReference('brand-tagtype', $type2);
    }

    public function getOrder()
    {
        return 10;
    }
}

<?php

namespace n3b\Bundle\Shop\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use n3b\Bundle\Shop\Entity\Tag;

class LoadTagTypeData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load($em)
    {
        for($i = 1; $i <= 3; $i++) {
            $cat[$i] = new Tag();
            $cat[$i]->setTitle('Категория ' . $i);
            $cat[$i]->setType($this->getReference('category-tagtype'));
            $cat[$i]->slugify();

            if($i > 1) {
                $cat[1]->addChildren($cat[$i]);
                $cat[$i]->setParent($cat[1]);
            }

            $em->persist($cat[$i]);

            $this->addReference('category' . $i, $cat[$i]);
        }

        for($i = 1; $i <= 4; $i++) {
            $brand = new Tag();
            $brand->setTitle('Бренд '.$i);
            $brand->setType($this->getReference('brand-tagtype'));
            $brand->slugify();
            $this->addReference('brand'.$i, $brand);

            $em->persist($brand);
        }

        $em->flush();
    }

    public function getOrder()
    {
        return 20;
    }
}

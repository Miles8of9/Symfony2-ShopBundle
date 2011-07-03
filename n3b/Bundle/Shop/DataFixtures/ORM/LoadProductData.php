<?php

namespace n3b\Bundle\Shop\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use n3b\Bundle\Shop\Entity\Product;
use n3b\Bundle\Shop\Entity\ProductPrice;

class LoadProductData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load($em)
    {
        for($i = 1; $i <= 12; $i++) {
            $p[$i] = new Product();
            $p[$i]->setTitle('продукт '.$i);
            $p[$i]->setQuantity(50);
            $p[$i]->slugify();

            $pr1 = new ProductPrice();
            $pr1->setCurrency($em->merge($this->getReference('currency1')));
            $pr1->setPrice($em->merge($this->getReference('price1')));
            $pr1->setValue(14.2);
            $pr2 = new ProductPrice();
            $pr2->setCurrency($em->merge($this->getReference('currency1')));
            $pr2->setPrice($em->merge($this->getReference('price2')));
            $pr2->setValue(11.2);

            $p[$i]->addPrices($pr1);
            $pr1->setProduct($p[$i]);
            $p[$i]->addPrices($pr2);
            $pr2->setProduct($p[$i]);
            $em->persist($pr1);
            $em->persist($pr2);

             $cat = $em->merge($this->getReference('category'.(ceil($i/6) + 1)));
                $p[$i]->addTags($cat);
                $cat->addProducts($p[$i]);


            $brand = $em->merge($this->getReference('brand'.ceil($i/3)));
            $p[$i]->addTags($brand);
            $brand->addProducts($p[$i]);

            $em->persist($p[$i]);
        }

        $em->flush();

    }

    public function getOrder()
    {
        return 30;
    }
}

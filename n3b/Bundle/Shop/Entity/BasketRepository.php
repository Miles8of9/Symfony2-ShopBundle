<?php

namespace n3b\Bundle\Shop\Entity;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use n3b\Bundle\Shop\Entity\Basket;

class BasketRepository extends EntityRepository
{
    //TODO INSERT ... ON DUPLICATE KEY UPDATE (если доктрина уже поддерживает комбинированные ключи-ссылки)
    public function addProduct($bsid, $productId)
    {
    }

    public function getCompleteBasket($bsid)
    {
        $dql = "
            SELECT b, i, p, pp, ppc, ppp FROM n3bShopBundle:Basket b
            JOIN b.items i
            JOIN i.product p
            JOIN p.prices pp
            JOIN pp.currency ppc
            JOIN pp.price ppp
            WHERE b.bsid = ?1";

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter(1, $bsid);
        $res = $query->getOneOrNullResult();

        return $res;
    }
}
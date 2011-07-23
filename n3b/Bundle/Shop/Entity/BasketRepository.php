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

    public function getCompleteBasket($bsid, $priceId)
    {
        $dql = "
            SELECT b, i, p, mi, pp, ppc, ppp FROM n3bShopBundle:Basket b
            JOIN b.items i
            JOIN i.product p
            LEFT JOIN p.mainImage mi
            JOIN p.prices pp
            JOIN pp.price ppp WITH ppp.id = :price_id
            JOIN pp.currency ppc
            WHERE b.bsid = :basket_sid";

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameters(array(
            'basket_sid' => $bsid,
            'price_id' => $priceId,
            ));

        $res = $query->getOneOrNullResult();

        return $res;
    }
}
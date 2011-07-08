<?php

namespace n3b\Bundle\Shop\Entity;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductRepository extends EntityRepository
{
    //TODO поискать более емкие варианты
    public function getByIds(array $ids, $priceId)
    {
        $dql =
            "SELECT p, pp, ppc, ppp FROM n3bShopBundle:Product p
                JOIN p.prices pp
                JOIN pp.price ppp WITH ppp.id = :price_id
                JOIN pp.currency ppc
                WHERE p.id IN (:product_ids)";

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameters(array(
            'product_ids' => $ids,
            'price_id' => array($priceId),
            ));

        $res = $query->getResult();

        if(!$res)
            throw new NotFoundHttpException('нихуа нетуть');

        return $res;
    }

    public function getIdsByTags(array $slugs)
    {
        $dql =
            "SELECT partial p.{id} FROM n3bShopBundle:Product p ";

        foreach($slugs as $k => $v) {
            if($k == 0)
                $dql .= " JOIN p.tags t$k WITH t$k.slug = ?$k AND t$k.type = 1";
            else
                $dql .= " JOIN p.tags t$k WITH t$k.slug = ?$k ";
        }

        $query = $this->getEntityManager()->createQuery($dql);

        foreach($slugs as $k => $v)
            $query->setParameter($k, $v);

        $res = $query->getArrayResult();

        if(!$res)
            throw new NotFoundHttpException('нихуа нетуть');
        
        $ids = array_map(function ($a) { return $a['id']; }, $res);

        return $ids;
    }

    public function getProductCard($slug)
    {
        $dql =
            "SELECT p, pp, ppc, ppp FROM n3bShopBundle:Product p
                JOIN p.prices pp
                JOIN pp.currency ppc
                JOIN pp.price ppp
                WHERE p.slug = ?1";

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter(1, $slug);
        $res = $query->getArrayResult();

        if(!$res)
            throw new NotFoundHttpException('нихуа нетуть');

        return $res;
    }
}
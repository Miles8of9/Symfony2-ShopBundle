<?php

namespace n3b\Bundle\Shop\Entity;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductRepository extends EntityRepository
{

    public function getByIds(array $ids, $priceId)
    {
        $dql =
            "SELECT p, mi, pa, pp, ppc, ppp FROM n3bShopBundle:Product p
                JOIN p.prices pp
                LEFT JOIN p.additional pa
                LEFT JOIN p.mainImage mi
                JOIN pp.price ppp WITH ppp.id = :price_id
                JOIN pp.currency ppc
                WHERE p.id IN (:ids)";

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameters(array(
            'ids' => $ids,
            'price_id' => array($priceId),
        ));

        $res = $query->getResult();

        if(!$res)
            throw new NotFoundHttpException('По какой-то причине ничего не найдено');

        return $res;
    }

    public function getIdsByTags(array $slugs, $outOfStock)
    {
        $dql =
            "SELECT partial p.{id} FROM n3bShopBundle:Product p ";

        foreach($slugs as $k => $v) {
            if($k == 0)
                $dql .= " JOIN p.tags t$k WITH t$k.slug = ?$k AND t$k.type = 1 AND t$k.active = 1";
            else
                $dql .= " JOIN p.tags t$k WITH t$k.slug = ?$k  AND t$k.active = 1";
        }

        $dql .= $outOfStock ? " WHERE p.quantity = 0" : " WHERE p.quantity > 0";
        $dql .= " AND p.active = 1";

        $query = $this->getEntityManager()->createQuery($dql);

        foreach($slugs as $k => $v)
            $query->setParameter($k, $v);

        $res = $query->getArrayResult();

        if(!$res && $outOfStock)
            throw new NotFoundHttpException('Нет товаров по заданным условиям');

        return $res ? array_map(function ($a) {return $a['id'];}, $res) : null;
    }

    public function getProductCard($slug)
    {
        $dql =
            "SELECT p, mi, pa, pf, pff, pp, ppc, ppp FROM n3bShopBundle:Product p
                JOIN p.prices pp
                LEFT JOIN p.mainImage mi
                LEFT JOIN p.features pf
                LEFT JOIN pf.feature pff
                LEFT JOIN p.additional pa
                JOIN pp.currency ppc
                JOIN pp.price ppp
                WHERE p.slug = :slug
                ORDER BY pff.groupTitle";

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('slug', $slug);
        $res = $query->getOneOrNullResult();

        if(\is_null($res))
            throw new NotFoundHttpException('Такой товар не найден');

        return $res;
    }

    public function getSpecials()
    {
        $dql =
            "SELECT p, mi, pa, pp, ppc, ppp, pf FROM n3bShopBundle:Product p
                JOIN p.prices pp
                LEFT JOIN p.additional pa
                LEFT JOIN p.mainImage mi
                JOIN pp.price ppp WITH ppp.id = 1
                JOIN pp.currency ppc
                JOIN p.flags pf
                WHERE pf.onIndexPage = 1";

        $query = $this->getEntityManager()->createQuery($dql);

        $res = $query->getResult();

        if(!$res)
            throw new NotFoundHttpException('нихуа нетуть');

        return $res;
    }
}
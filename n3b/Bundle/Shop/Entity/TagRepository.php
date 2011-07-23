<?php

namespace n3b\Bundle\Shop\Entity;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TagRepository extends EntityRepository
{

    public function getTagsByType($types)
    {
        $dql =
            "SELECT t, c, tt FROM n3bShopBundle:Tag t
                JOIN t.type tt
				LEFT JOIN t.children c
                WHERE tt.id IN (?1) AND t.parent IS NULL
                ORDER BY tt.id, t.title, c.title";

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter(1, $types);

        $res = $query->getResult();

        if(!$res)
            throw new NotFoundHttpException ();

        return $res;
    }

    public function getByProductIds(array $ids, array $types)
    {
        $dql =
            "SELECT t, c, tt FROM n3bShopBundle:Tag t
                JOIN t.products p WITH p.id IN (:ids)
                JOIN t.type tt
				LEFT JOIN t.children c
                WHERE tt.id IN (:types) AND t.parent IS NULL
                ORDER BY tt.id, t.title, c.title";

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameters(array('ids' => $ids, 'types' => $types));

        $res = $query->getResult();

        if(!$res)
            throw new NotFoundHttpException ();

        return $res;
    }
}
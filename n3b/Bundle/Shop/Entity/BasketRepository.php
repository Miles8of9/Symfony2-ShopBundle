<?php

namespace n3b\Bundle\Shop\Entity;

use Doctrine\ORM\EntityRepository;

class BasketRepository extends EntityRepository
{
    /*
	public function increaseQuantity($basketId, $productId)
    {
        $dql = "
        	UPDATE n3b\Bundle\Shop\Entity\BasketItem bi
			SET bi.quantity = bi.quantity + 1
        	WHERE bi.basket = :basketId AND bi.product = :productId
        ";

        $query = $this->getEntityManager()->createQuery($dql);

		return $query->execute(array('basketId' => $basketId, 'productId' => $productId));
    }
     * 
     */
}
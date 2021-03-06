<?php

namespace n3b\Bundle\Shop\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class BasketItem
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="Basket", inversedBy="items")
     */
    protected $basket;
    /**
     * @ORM\ManyToOne(targetEntity="Product")
     */
    protected $product;
    /**
     * @ORM\Column(type="integer")
     */
    protected $quantity = 1;

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * Get quantity
     *
     * @return integer $quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set basket
     *
     * @param n3b\Bundle\Shop\Entity\Basket $basket
     */
    public function setBasket(\n3b\Bundle\Shop\Entity\Basket $basket)
    {
        $this->basket = $basket;
    }

    /**
     * Get basket
     *
     * @return n3b\Bundle\Shop\Entity\Basket $basket
     */
    public function getBasket()
    {
        return $this->basket;
    }

    /**
     * Set product
     *
     * @param n3b\Bundle\Shop\Entity\Product $product
     */
    public function setProduct(\n3b\Bundle\Shop\Entity\Product $product)
    {
        $this->product = $product;
    }

    /**
     * Get product
     *
     * @return n3b\Bundle\Shop\Entity\Product $product
     */
    public function getProduct()
    {
        return $this->product;
    }
}
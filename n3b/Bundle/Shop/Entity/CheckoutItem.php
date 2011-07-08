<?php

namespace n3b\Bundle\Shop\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class CheckoutItem
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="Checkout", inversedBy="items")
     */
    protected $checkout;
    /**
     * @ORM\ManyToOne(targetEntity="Product")
     */
    protected $product;
    /**
     * @ORM\Column(type="integer")
     */
    protected $quantity;
    /**
     * @ORM\Column(type="decimal", scale="2")
     */
    protected $price;

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
     * Set price
     *
     * @param decimal $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Get price
     *
     * @return decimal $price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set checkout
     *
     * @param n3b\Bundle\Shop\Entity\Checkout $checkout
     */
    public function setCheckout(\n3b\Bundle\Shop\Entity\Checkout $checkout)
    {
        $this->checkout = $checkout;
    }

    /**
     * Get checkout
     *
     * @return n3b\Bundle\Shop\Entity\Checkout $checkout
     */
    public function getCheckout()
    {
        return $this->checkout;
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
<?php

namespace n3b\Bundle\Shop\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use n3b\Bundle\Shop\Model\Checkout as BaseCheckout;

/**
 * @ORM\Entity
 */
class Checkout extends BaseCheckout
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="orders", cascade={"persist"})
     */
    protected $customer;
    /**
     * @ORM\OneToOne(targetEntity="Delivery", mappedBy="checkout", orphanRemoval="true", cascade={"persist", "remove"})
     */
    protected $delivery;
    /**
     * @ORM\OneToMany(targetEntity="CheckoutItem", mappedBy="checkout", orphanRemoval="true", cascade={"persist", "remove"})
     */
    protected $items;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;

    public function __construct()
    {
        $this->created = new \DateTime();
    }

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
     * Set created
     *
     * @param datetime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * Get created
     *
     * @return datetime $created
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set delivery
     *
     * @param n3b\Bundle\Shop\Entity\Delivery $delivery
     */
    public function setDelivery(\n3b\Bundle\Shop\Entity\Delivery $delivery)
    {
        $this->delivery = $delivery;
    }

    /**
     * Get delivery
     *
     * @return n3b\Bundle\Shop\Entity\Delivery $delivery
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * Set customer
     *
     * @param n3b\Bundle\Shop\Entity\Customer $customer
     */
    public function setCustomer(\n3b\Bundle\Shop\Entity\Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Get customer
     *
     * @return n3b\Bundle\Shop\Entity\Customer $customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    public function unsetDelivery()
    {
        $this->delivery = null;
    }

    /**
     * Add products
     *
     * @param n3b\Bundle\Shop\Entity\ProductOrdered $products
     */
    public function addProducts(\n3b\Bundle\Shop\Entity\ProductOrdered $products)
    {
        $this->products[] = $products;
    }

    /**
     * Get products
     *
     * @return Doctrine\Common\Collections\Collection $products
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Add items
     *
     * @param n3b\Bundle\Shop\Entity\CheckoutItem $items
     */
    public function addItems(\n3b\Bundle\Shop\Entity\CheckoutItem $items)
    {
        $this->items[] = $items;
    }

    /**
     * Get items
     *
     * @return Doctrine\Common\Collections\Collection $items
     */
    public function getItems()
    {
        return $this->items;
    }
}
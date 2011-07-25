<?php

namespace n3b\Bundle\Shop\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class ProductFlags
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\OneToOne(targetEntity="Product", mappedBy="flags")
     */
    protected $product;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $freeDelivery;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $heavy;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $onIndexPage;

    public function __construct()
    {
        $this->freeDelivery = false;
        $this->heavy = false;
        $this->onIndexPage = false;
    }
    /**
     * Set id
     *
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * Set freeDelivery
     *
     * @param boolean $freeDelivery
     */
    public function setFreeDelivery($freeDelivery)
    {
        $this->freeDelivery = $freeDelivery;
    }

    /**
     * Get freeDelivery
     *
     * @return boolean $freeDelivery
     */
    public function isFreeDelivery()
    {
        return $this->freeDelivery;
    }

    /**
     * Set heavy
     *
     * @param boolean $heavy
     */
    public function setHeavy($heavy)
    {
        $this->heavy = $heavy;
    }

    /**
     * Get heavy
     *
     * @return boolean $heavy
     */
    public function isHeavy()
    {
        return $this->heavy;
    }

    /**
     * Set onIndexPage
     *
     * @param boolean $onIndexPage
     */
    public function setOnIndexPage($onIndexPage)
    {
        $this->onIndexPage = $onIndexPage;
    }

    /**
     * Get onIndexPage
     *
     * @return boolean $onIndexPage
     */
    public function isOnIndexPage()
    {
        return $this->onIndexPage;
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

    /**
     * Get freeDelivery
     *
     * @return boolean $freeDelivery
     */
    public function getFreeDelivery()
    {
        return $this->freeDelivery;
    }

    /**
     * Get heavy
     *
     * @return boolean $heavy
     */
    public function getHeavy()
    {
        return $this->heavy;
    }

    /**
     * Get onIndexPage
     *
     * @return boolean $onIndexPage
     */
    public function getOnIndexPage()
    {
        return $this->onIndexPage;
    }
}
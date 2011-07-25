<?php

namespace n3b\Bundle\Shop\Entity;

use Doctrine\ORM\Mapping as ORM;
use n3b\Bundle\Shop\Model\Basket as BaseBasket;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="n3b\Bundle\Shop\Entity\BasketRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Basket extends BaseBasket
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", length="40", unique="true")
     */
    protected $bsid;
    /**
     * @ORM\OneToMany(targetEntity="BasketItem", mappedBy="basket", orphanRemoval=true, cascade={"persist", "remove"})
     */
    protected $items;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated;

    public function __construct()
    {
        $this->updated = new \DateTime("now");
        $this->items = new ArrayCollection();
        $this->bsid = sha1($_SERVER['REMOTE_ADDR'] . microtime(true));
    }

    /**
     * @ORM\PreUpdate
     */
    public function updated()
    {
        $this->updated = new \DateTime("now");
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
     * Set bsid
     *
     * @param string $bsid
     */
    public function setBsid($bsid)
    {
        $this->bsid = $bsid;
    }

    /**
     * Get bsid
     *
     * @return string $bsid
     */
    public function getBsid()
    {
        return $this->bsid;
    }

    /**
     * Set updated
     *
     * @param datetime $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * Get updated
     *
     * @return datetime $updated
     */
    public function getUpdated()
    {
        return $this->updated;
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
     * @param n3b\Bundle\Shop\Entity\BasketItem $items
     */
    public function addItems(\n3b\Bundle\Shop\Entity\BasketItem $items)
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
<?php

namespace n3b\Bundle\Shop\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use n3b\Bundle\Shop\Model\Product as BaseProduct;
use n3b\Bundle\Shop\Util\StringUtil;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="n3b\Bundle\Shop\Entity\ProductRepository")
 */
class Product extends BaseProduct
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column
     */
    protected $title;
    /**
     * @ORM\Column(unique="true")
     */
    protected $slug;
    /**
     * @ORM\Column(type="integer")
     */
    protected $quantity;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $active;
    /**
     * @ORM\OneToMany(targetEntity="ProductPrice", mappedBy="product", orphanRemoval=true, cascade={"persist", "remove"})
     */
    protected $prices;
    /**
     * @ORM\OneToOne(targetEntity="ProductAdditional")
     */
    protected $additional;
    /**
     * @ORM\ManyToMany(targetEntity="Tag")
     */
    protected $tags;
    /**
     * @ORM\OneToOne(targetEntity="File")
     */
    protected $mainImage;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated;

    public function __construct()
    {
        $this->updated = new \DateTime("now");
        $this->active = true;
        $this->tags = new ArrayCollection();
        $this->prices = new ArrayCollection();
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
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return string $slug
     */
    public function getSlug()
    {
        return $this->slug;
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
     * Add prices
     *
     * @param n3b\Bundle\Shop\Entity\ProductPrice $prices
     */
    public function addPrices(\n3b\Bundle\Shop\Entity\ProductPrice $prices)
    {
        $this->prices[] = $prices;
    }

    /**
     * Get prices
     *
     * @return Doctrine\Common\Collections\Collection $prices
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * Set additional
     *
     * @param n3b\Bundle\Shop\Entity\ProductAdditional $additional
     */
    public function setAdditional(\n3b\Bundle\Shop\Entity\ProductAdditional $additional)
    {
        $this->additional = $additional;
    }

    /**
     * Get additional
     *
     * @return n3b\Bundle\Shop\Entity\ProductAdditional $additional
     */
    public function getAdditional()
    {
        return $this->additional;
    }

    /**
     * Add tags
     *
     * @param n3b\Bundle\Shop\Entity\Tag $tags
     */
    public function addTags(\n3b\Bundle\Shop\Entity\Tag $tags)
    {
        $this->tags[] = $tags;
    }

    /**
     * Get tags
     *
     * @return Doctrine\Common\Collections\Collection $tags
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set active
     *
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * Get active
     *
     * @return boolean $active
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @ORM\PrePersist
     */
    public function slugify()
    {
        $this->setSlug(StringUtil::slugify($this->getTitle()));
    }
}
<?php

namespace n3b\Bundle\Shop\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use n3b\Bundle\Shop\Model\Tag as BaseTag;
use n3b\Bundle\Shop\Util\StringUtil;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="n3b\Bundle\Shop\Entity\TagRepository")
 */
class Tag extends BaseTag
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
     * @ORM\Column(type="string", length="255", unique="true")
     */
    protected $slug;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $active;
    /**
     * @ORM\OneToOne(targetEntity="TagAdditional", orphanRemoval="true", cascade={"persist", "remove"})
     */
    protected $additional;
    /**
     * @ORM\ManyToOne(targetEntity="TagType")
     */
    protected $type;
    /**
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="tags")
     */
    protected $products;
    /**
     * @ORM\OneToMany(targetEntity="Tag", mappedBy="parent", orphanRemoval=true, cascade={"persist", "remove"})
     */
    protected $children;
    /**
     * @ORM\ManyToOne(targetEntity="Tag", inversedBy="children")
     */
    protected $parent;
    /**
     * @ORM\Column(nullable="true")
     */
    protected $external;

    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->products = new ArrayCollection();
        $this->active = true;
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
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add children
     *
     * @param n3b\Bundle\Shop\Entity\Tag $children
     */
    public function addChildren(\n3b\Bundle\Shop\Entity\Tag $children)
    {
        $this->children[] = $children;
    }

    /**
     * Get children
     *
     * @return Doctrine\Common\Collections\Collection $children
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param n3b\Bundle\Shop\Entity\Tag $parent
     */
    public function setParent(\n3b\Bundle\Shop\Entity\Tag $parent)
    {
        $this->parent = $parent;
    }

    /**
     * Get parent
     *
     * @return n3b\Bundle\Shop\Entity\Tag $parent
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set type
     *
     * @param n3b\Bundle\Shop\Entity\TagType $type
     */
    public function setType(\n3b\Bundle\Shop\Entity\TagType $type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return n3b\Bundle\Shop\Entity\TagType $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add products
     *
     * @param n3b\Bundle\Shop\Entity\Product $products
     */
    public function addProducts(\n3b\Bundle\Shop\Entity\Product $products)
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
     * Set additional
     *
     * @param n3b\Bundle\Shop\Entity\TagAdditional $additional
     */
    public function setAdditional(\n3b\Bundle\Shop\Entity\TagAdditional $additional)
    {
        $this->additional = $additional;
    }

    /**
     * Get additional
     *
     * @return n3b\Bundle\Shop\Entity\TagAdditional $additional
     */
    public function getAdditional()
    {
        return $this->additional;
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

    /**
     * Set external
     *
     * @param string $external
     */
    public function setExternal($external)
    {
        $this->external = $external;
    }

    /**
     * Get external
     *
     * @return string $external
     */
    public function getExternal()
    {
        return $this->external;
    }

    public function removeParent()
    {
        $this->parent = null;
    }
}
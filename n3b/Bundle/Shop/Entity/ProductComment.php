<?php

namespace n3b\Bundle\Shop\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class ProductComment
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="comments")
     */
    protected $product;
	/**
	 * @ORM\Column(type="string")
	 */
	protected $userName;
	/**
	 * @ORM\Column(type="text", length="4000")
	 */
	protected $text;
	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $created;
	/**
	 * @ORM\OneToMany(targetEntity="ProductComment", mappedBy="parent", orphanRemoval=true, cascade={"persist", "remove"})
	 */
	protected $children;
	/**
	 * @ORM\ManyToOne(targetEntity="ProductComment", inversedBy="children")
	 */
	protected $parent;

	public function __construct()
	{
		$this->created = new \DateTime();
		$this->userName = 'Аноним';
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
     * Set userName
     *
     * @param string $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * Get userName
     *
     * @return string $userName
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set article
     *
     * @param text $article
     */
    public function setArticle($article)
    {
        $this->article = $article;
    }

    /**
     * Get article
     *
     * @return text $article
     */
    public function getArticle()
    {
        return $this->article;
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
     * Add children
     *
     * @param n3b\Bundle\Shop\Entity\ProductComment $children
     */
    public function addChildren(\n3b\Bundle\Shop\Entity\ProductComment $children)
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
     * @param n3b\Bundle\Shop\Entity\ProductComment $parent
     */
    public function setParent(\n3b\Bundle\Shop\Entity\ProductComment $parent)
    {
        $this->parent = $parent;
    }

    /**
     * Get parent
     *
     * @return n3b\Bundle\Shop\Entity\ProductComment $parent
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set text
     *
     * @param text $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Get text
     *
     * @return text $text
     */
    public function getText()
    {
        return $this->text;
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
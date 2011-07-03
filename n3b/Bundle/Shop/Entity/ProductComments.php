<?php

namespace n3b\Bundle\Shop\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class ProductComments
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @ORM\Column(type="string")
	 */
	protected $userName;
	/**
	 * @ORM\Column(type="text", length="4000")
	 */
	protected $article;
	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $created;
	/**
	 * @ORM\OneToMany(targetEntity="ProductComments", mappedBy="parent", orphanRemoval=true, cascade={"persist", "remove"})
	 */
	protected $children;
	/**
	 * @ORM\ManyToOne(targetEntity="ProductComments", inversedBy="children")
	 * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
	 */
	protected $parent;

	public function __construct()
	{
		$this->created = new \Symfony\Component\Validator\Constraints\DateTime('now');
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
     * @param n3b\Bundle\Shop\Entity\ProductComments $children
     */
    public function addChildren(\n3b\Bundle\Shop\Entity\ProductComments $children)
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
     * @param n3b\Bundle\Shop\Entity\ProductComments $parent
     */
    public function setParent(\n3b\Bundle\Shop\Entity\ProductComments $parent)
    {
        $this->parent = $parent;
    }

    /**
     * Get parent
     *
     * @return n3b\Bundle\Shop\Entity\ProductComments $parent
     */
    public function getParent()
    {
        return $this->parent;
    }
}
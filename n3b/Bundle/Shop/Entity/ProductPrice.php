<?php 

namespace n3b\Bundle\Shop\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class ProductPrice
{
	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="decimal", scale="2")
     */
    protected $value;

    /**
     * @ORM\ManyToOne(targetEntity="Price")
     */
    protected $price;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="prices")
     */
    protected $product;

    /**
     * @ORM\ManyToOne(targetEntity="Currency")
     */
    protected $currency;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated;

    public function __construct()
    {
		$this->updated = new \DateTime("now");
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
     * Set value
     *
     * @param decimal $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Get value
     *
     * @return decimal $value
     */
    public function getValue()
    {
        return $this->value;
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
     * Set price
     *
     * @param n3b\Bundle\Shop\Entity\Price $price
     */
    public function setPrice(\n3b\Bundle\Shop\Entity\Price $price)
    {
        $this->price = $price;
    }

    /**
     * Get price
     *
     * @return n3b\Bundle\Shop\Entity\Price $price
     */
    public function getPrice()
    {
        return $this->price;
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
     * Set currency
     *
     * @param n3b\Bundle\Shop\Entity\Currency $currency
     */
    public function setCurrency(\n3b\Bundle\Shop\Entity\Currency $currency)
    {
        $this->currency = $currency;
    }

    /**
     * Get currency
     *
     * @return n3b\Bundle\Shop\Entity\Currency $currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }
}
<?php

namespace n3b\Bundle\Shop\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class ProductFeature
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="Feature", inversedBy="productFeatures")
     */
    protected $feature;
    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="protuctFeatures")
     */
    protected $product;
    /**
     * @ORM\Column
     */
    protected $value;

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
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Get value
     *
     * @return string $value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set feature
     *
     * @param n3b\Bundle\Shop\Entity\Feature $feature
     */
    public function setFeature(\n3b\Bundle\Shop\Entity\Feature $feature)
    {
        $this->feature = $feature;
    }

    /**
     * Get feature
     *
     * @return n3b\Bundle\Shop\Entity\Feature $feature
     */
    public function getFeature()
    {
        return $this->feature;
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
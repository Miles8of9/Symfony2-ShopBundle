<?php

namespace n3b\Bundle\Shop\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class ProductAdditional
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\OneToOne(targetEntity="Product", mappedBy="additional")
     */
    protected $product;
    /**
     * @ORM\Column(type="text", length="4000", nullable="true")
     */
    protected $description;
    /**
     * @ORM\Column(nullable="true")
     */
    protected $art;
    /**
     * @ORM\ManyToOne(targetEntity="Warranty", inversedBy="productAdditional")
     */
    protected $warranty;

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
     * Set fullDescription
     *
     * @param text $fullDescription
     */
    public function setFullDescription($fullDescription)
    {
        $this->fullDescription = $fullDescription;
    }

    /**
     * Get fullDescription
     *
     * @return text $fullDescription
     */
    public function getFullDescription()
    {
        return $this->fullDescription;
    }

    /**
     * Set articul
     *
     * @param string $articul
     */
    public function setArticul($articul)
    {
        $this->articul = $articul;
    }

    /**
     * Get articul
     *
     * @return string $articul
     */
    public function getArticul()
    {
        return $this->articul;
    }

    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set art
     *
     * @param string $art
     */
    public function setArt($art)
    {
        $this->art = $art;
    }

    /**
     * Get art
     *
     * @return string $art
     */
    public function getArt()
    {
        return $this->art;
    }

    /**
     * Add productFeatures
     *
     * @param n3b\Bundle\Shop\Entity\ProductFeature $productFeatures
     */
    public function addProductFeatures(\n3b\Bundle\Shop\Entity\ProductFeature $productFeatures)
    {
        $this->productFeatures[] = $productFeatures;
    }

    /**
     * Get productFeatures
     *
     * @return Doctrine\Common\Collections\Collection $productFeatures
     */
    public function getProductFeatures()
    {
        return $this->productFeatures;
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
     * Set warranty
     *
     * @param n3b\Bundle\Shop\Entity\Warranty $warranty
     */
    public function setWarranty(\n3b\Bundle\Shop\Entity\Warranty $warranty)
    {
        $this->warranty = $warranty;
    }

    /**
     * Get warranty
     *
     * @return n3b\Bundle\Shop\Entity\Warranty $warranty
     */
    public function getWarranty()
    {
        return $this->warranty;
    }

    /**
     * Add warranty
     *
     * @param n3b\Bundle\Shop\Entity\Warranty $warranty
     */
    public function addWarranty(\n3b\Bundle\Shop\Entity\Warranty $warranty)
    {
        $this->warranty[] = $warranty;
    }
}
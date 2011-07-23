<?php

namespace n3b\Bundle\Shop\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 */
class Warranty {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\Column
     */
    protected $title;
    /**
     * @ORM\Column(type="text", length="4000")
     */
    protected $description;
    /**
     * @ORM\Column(type="integer")
     */
    protected $duration;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $oficial;
    /**
     * @ORM\ManyToMany(targetEntity="ServiceCenter", inversedBy="warranties")
     */
    protected $services;
    /**
     * @ORM\OneToMany(targetEntity="ProductAdditional", mappedBy="warranty", orphanRemoval="true")
     */
    protected $productAdditional;
    
    public function __construct()
    {
        $this->services = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set duration
     *
     * @param integer $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * Get duration
     *
     * @return integer $duration
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set oficial
     *
     * @param boolean $oficial
     */
    public function setOficial($oficial)
    {
        $this->oficial = $oficial;
    }

    /**
     * Get oficial
     *
     * @return boolean $oficial
     */
    public function getOficial()
    {
        return $this->oficial;
    }

    /**
     * Add productAdditional
     *
     * @param n3b\Bundle\Shop\Entity\ProductAdditional $productAdditional
     */
    public function addProductAdditional(\n3b\Bundle\Shop\Entity\ProductAdditional $productAdditional)
    {
        $this->productAdditional[] = $productAdditional;
    }

    /**
     * Get productAdditional
     *
     * @return Doctrine\Common\Collections\Collection $productAdditional
     */
    public function getProductAdditional()
    {
        return $this->productAdditional;
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
     * Add services
     *
     * @param n3b\Bundle\Shop\Entity\ServiceCenter $services
     */
    public function addServices(\n3b\Bundle\Shop\Entity\ServiceCenter $services)
    {
        $this->services[] = $services;
    }

    /**
     * Get services
     *
     * @return Doctrine\Common\Collections\Collection $services
     */
    public function getServices()
    {
        return $this->services;
    }
}
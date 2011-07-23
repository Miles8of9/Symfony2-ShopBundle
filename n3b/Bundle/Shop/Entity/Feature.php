<?php

namespace n3b\Bundle\Shop\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Feature
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
     * @ORM\Column(type="text", length="4000", nullable="true")
     */
    protected $description;
    /**
     * @ORM\Column(nullable="true")
     */
    protected $groupTitle;

    /**
     * @ORM\OneToMany(targetEntity="ProductFeature", mappedBy="feature", orphanRemoval="true", cascade={"persist", "remove"})
     */
    protected $productFeatures;

    public function __construct()
    {
        $this->productFeatures = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set group
     *
     * @param string $group
     */
    public function setGroup($group)
    {
        $this->group = $group;
    }

    /**
     * Get group
     *
     * @return string $group
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set groupTitle
     *
     * @param string $groupTitle
     */
    public function setGroupTitle($groupTitle)
    {
        $this->groupTitle = $groupTitle;
    }

    /**
     * Get groupTitle
     *
     * @return string $groupTitle
     */
    public function getGroupTitle()
    {
        return $this->groupTitle;
    }
}
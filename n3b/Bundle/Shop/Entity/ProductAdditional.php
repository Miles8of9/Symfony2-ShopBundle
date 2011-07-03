<?php

namespace n3b\Bundle\Shop\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class ProductAdditional {
	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

	/**
     * @ORM\Column(type="text", length="4000")
     */
    protected $description;

    /**
     * @ORM\Column(type="string")
     */
    protected $art;

	/**
     * @ORM\ManyToMany(targetEntity="File")
     */
    protected $images;

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
}
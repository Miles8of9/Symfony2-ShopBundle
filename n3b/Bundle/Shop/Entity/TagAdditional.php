<?php

namespace n3b\Bundle\Shop\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class TagAdditional
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="text", length="4000", nullable="true")
     */
    protected $description;
    /**
     * @ORM\OneToOne(targetEntity="File")
     */
    protected $image;

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
     * Set image
     *
     * @param n3b\Bundle\Shop\Entity\File $image
     */
    public function setImage(\n3b\Bundle\Shop\Entity\File $image)
    {
        $this->image = $image;
    }

    /**
     * Get image
     *
     * @return n3b\Bundle\Shop\Entity\File $image
     */
    public function getImage()
    {
        return $this->image;
    }
}
<?php

namespace n3b\Bundle\Shop\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class DeliveryAdds
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
    protected $addsFull;
    /**
     * @ORM\OneToMany(targetEntity="Delivery", mappedBy="adds", orphanRemoval="true", cascade={"persist", "remove"})
     */
    protected $delivery;
    public function __construct()
    {
        $this->delivery = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set addsFull
     *
     * @param string $addsFull
     */
    public function setAddsFull($addsFull)
    {
        $this->addsFull = $addsFull;
    }

    /**
     * Get addsFull
     *
     * @return string $addsFull
     */
    public function getAddsFull()
    {
        return $this->addsFull;
    }

    /**
     * Add delivery
     *
     * @param n3b\Bundle\Shop\Entity\Delivery $delivery
     */
    public function addDelivery(\n3b\Bundle\Shop\Entity\Delivery $delivery)
    {
        $this->delivery[] = $delivery;
    }

    /**
     * Get delivery
     *
     * @return Doctrine\Common\Collections\Collection $delivery
     */
    public function getDelivery()
    {
        return $this->delivery;
    }
}
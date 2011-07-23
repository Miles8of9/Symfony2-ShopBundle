<?php

namespace n3b\Bundle\Shop\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 */
class ServiceCenter
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\Column(unique="true")
     */
    protected $title;
    /**
     * @ORM\Column
     */
    protected $adds;
    /**
     * @ORM\Column
     */
    protected $phones;
    /**
     * @ORM\Column
     */
    protected $url;
    /**
     * @ORM\Column
     */
    protected $mail;
    /**
     * @ORM\Column
     */
    protected $workingTime;
    /**
     * @ORM\ManyToMany(targetEntity="Warranty", mappedBy="services", cascade={"persist", "remove"})
     */
    protected $warranties;

    public function __construct()
    {
        $this->warranties = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set adds
     *
     * @param string $adds
     */
    public function setAdds($adds)
    {
        $this->adds = $adds;
    }

    /**
     * Get adds
     *
     * @return string $adds
     */
    public function getAdds()
    {
        return $this->adds;
    }

    /**
     * Set phones
     *
     * @param string $phones
     */
    public function setPhones($phones)
    {
        $this->phones = $phones;
    }

    /**
     * Get phones
     *
     * @return string $phones
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * Set url
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Get url
     *
     * @return string $url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set mail
     *
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * Get mail
     *
     * @return string $mail
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set workingTime
     *
     * @param string $workingTime
     */
    public function setWorkingTime($workingTime)
    {
        $this->workingTime = $workingTime;
    }

    /**
     * Get workingTime
     *
     * @return string $workingTime
     */
    public function getWorkingTime()
    {
        return $this->workingTime;
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
     * Add warranties
     *
     * @param n3b\Bundle\Shop\Entity\Warranty $warranties
     */
    public function addWarranties(\n3b\Bundle\Shop\Entity\Warranty $warranties)
    {
        $this->warranties[] = $warranties;
    }

    /**
     * Get warranties
     *
     * @return Doctrine\Common\Collections\Collection $warranties
     */
    public function getWarranties()
    {
        return $this->warranties;
    }
}
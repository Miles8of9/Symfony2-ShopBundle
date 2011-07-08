<?php

namespace n3b\Bundle\Shop\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use n3b\Bundle\Shop\Model\Customer as BaseCustomer;

/**
 * @ORM\Entity
 */
class Customer extends BaseCustomer
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(unique="true", nullable="true")
     * @Assert\NotBlank(groups={"registration"})
     * @Assert\Blank(groups={"pass_through"})
     */
    protected $login;
    /**
     * @ORM\Column(nullable="true")
     * @Assert\NotBlank(groups={"registration"})
     * @Assert\Blank(groups={"pass_through"})
     */
    protected $password;
    /**
     * @ORM\Column
     */
    protected $username;
    /**
     * @ORM\Column
     */
    protected $userphone;
    /**
     * @ORM\OneToMany(targetEntity="Checkout", mappedBy="customer", orphanRemoval=true, cascade={"persist", "remove"})
     */
    protected $orders;
    public function __construct()
    {
        $this->orders = new ArrayCollection();
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
     * Set login
     *
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * Get login
     *
     * @return string $login
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get password
     *
     * @return string $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set username
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get username
     *
     * @return string $username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set userphone
     *
     * @param string $userphone
     */
    public function setUserphone($userphone)
    {
        $this->userphone = $userphone;
    }

    /**
     * Get userphone
     *
     * @return string $userphone
     */
    public function getUserphone()
    {
        return $this->userphone;
    }

    /**
     * Add orders
     *
     * @param n3b\Bundle\Shop\Entity\Checkout $orders
     */
    public function addOrders(\n3b\Bundle\Shop\Entity\Checkout $orders)
    {
        $this->orders[] = $orders;
    }

    /**
     * Get orders
     *
     * @return Doctrine\Common\Collections\Collection $orders
     */
    public function getOrders()
    {
        return $this->orders;
    }
}
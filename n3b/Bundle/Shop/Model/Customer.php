<?php

namespace n3b\Bundle\Shop\Model;

abstract class Customer {

    protected $passwordCheck;

    public function __construct()
    {
    }

    public function getPasswordCheck()
    {
        return $this->passwordCheck;
    }

    public function setPasswordCheck($password)
    {
        $this->passwordCheck = $password;
    }
}

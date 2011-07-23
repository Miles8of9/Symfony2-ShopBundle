<?php

namespace n3b\Bundle\Shop\Exchange\Interfaces;

interface ServiceCenterInterface
{
    public function getId();
    
    public function getTitle();
    
    public function getAdds();

    public function getPhones();

    public function getUrl();

    public function getMail();

    public function getWorkingTime();
}

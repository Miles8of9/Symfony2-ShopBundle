<?php

namespace n3b\Bundle\Shop\Exchange\Xml1C;

use n3b\Bundle\Shop\Exchange\Interfaces\ServiceCenterInterface;

class ServCenter extends Prototype implements ServiceCenterInterface
{

    public function getId()
    {
        return (int) $this->proto->serv_center_id;
    }

    public function getTitle()
    {
        return (string) $this->proto->serv_center_name;
    }

    public function getAdds()
    {
        return (string) $this->proto->serv_center_address;
    }

    public function getPhones()
    {
        return trim(
            (string) $this->proto->serv_center_phone_1 . ' ' .
            (string) $this->proto->serv_center_phone_2 . ' ' .
            (string) $this->proto->serv_center_phone_3 . ' ' .
            (string) $this->proto->serv_center_phone_4 . ' ' .
            (string) $this->proto->serv_center_phone_5 . ' ' .
            (string) $this->proto->serv_center_phone_6 . ' ' .
            (string) $this->proto->serv_center_phone_7
        );
    }

    public function getUrl()
    {
        return (string) $this->proto->serv_center_url;
    }

    public function getMail()
    {
        return (string) $this->proto->serv_center_mail;
    }

    public function getWorkingTime()
    {
        return (string) $this->proto->serv_center_timing;
    }
}

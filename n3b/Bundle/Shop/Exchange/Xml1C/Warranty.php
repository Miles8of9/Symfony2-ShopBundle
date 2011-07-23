<?php

namespace n3b\Bundle\Shop\Exchange\Xml1C;

use n3b\Bundle\Shop\Exchange\Interfaces\WarrantyInterface;

class Warranty extends Prototype implements WarrantyInterface
{

    public function getId()
    {
        return (int) $this->proto->brand_warranty_id;
    }

    public function getTitle()
    {
        return (string) $this->proto->brand_warranty_name;
    }

    public function getDuration()
    {
        return (int) $this->proto->brand_warranty_time;
    }

    public function getDescription()
    {
        return (string) $this->proto->brand_warranty_comment;
    }

    public function isOfficial()
    {
        return (string) $this->proto->official_warranty_in_yml == 'true';
    }
}

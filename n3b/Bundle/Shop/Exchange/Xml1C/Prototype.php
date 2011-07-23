<?php

namespace n3b\Bundle\Shop\Exchange\Xml1C;

abstract class Prototype
{
    protected $proto;

    public function __construct(\SimpleXMLElement $proto)
    {
        $this->proto = $proto;
    }
}

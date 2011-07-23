<?php

namespace n3b\Bundle\Shop\Exchange\Xml1C;

use n3b\Bundle\Shop\Exchange\Interfaces\TagInterface;

class Tag extends BaseTagEntity implements TagInterface
{
    protected $typeTitle = 'Тег';

    public function getTitle()
    {
        return (string) $this->proto->brand_name;
    }

    public function getExternal()
    {
        return (int) $this->proto->brand_id;
    }
}

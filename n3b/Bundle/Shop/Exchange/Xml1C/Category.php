<?php

namespace n3b\Bundle\Shop\Exchange\Xml1C;

use n3b\Bundle\Shop\Exchange\Interfaces\TagInterface;

class Category extends BaseTagEntity implements TagInterface
{
    protected $typeTitle = 'Категория';

    public function getTitle()
    {
        return (string) $this->proto->category_name;
    }

    public function getExternal()
    {
        return (int) $this->proto->category_id;
    }

    public function getParentId()
    {
        return (int) $this->proto->category_parent_id;
    }
}

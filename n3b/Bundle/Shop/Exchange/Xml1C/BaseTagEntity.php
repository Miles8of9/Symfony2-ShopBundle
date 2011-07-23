<?php

namespace n3b\Bundle\Shop\Exchange\Xml1C;

class BaseTagEntity extends Prototype
{
    protected $typeTitle;

    public function getType(array $types)
    {
        if(isset($this->type))
            return $this->type;

        foreach($types as $type)
            if($type->getTitle() == $this->typeTitle)
                return $this->type = $type;
    }

    public function getActive()
    {
        return 1;
    }

    public function getParentId()
    {
        return null;
    }
}

<?php

namespace n3b\Bundle\Shop\Exchange\Interfaces;

interface TagInterface
{
    public function getTitle();
    
    public function getExternal();

    public function getParentId();

    public function getActive();

    public function getType(array $types);
}

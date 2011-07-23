<?php

namespace n3b\Bundle\Shop\Exchange\Interfaces;

interface WarrantyInterface
{
    public function getId();

    public function getTitle();

    public function getDuration();

    public function getDescription();

    public function isOfficial();
}

<?php

namespace n3b\Bundle\Shop\Templating;

use Symfony\Component\Templating\Helper\Helper;
use n3b\Bundle\Shop\Service\Catalog as CatalogService;

class Catalog extends Helper
{
    protected $catalog;

    public function __construct(CatalogService $cs)
    {
        $this->catalog = $cs;
    }

    public function getName()
    {
        return 'catalog';
    }

    public function getCategories()
    {
        return $this->catalog->getCategories();
    }

    public function getSelected()
    {
        return $this->catalog->getSelectedCategory();
    }

    public function getBrands()
    {
        return $this->catalog->getBrands();
    }

    public function getTags()
    {
        return $this->catalog->getTags();
    }

    public function getProducts()
    {
        return $this->catalog->getProducts();
    }

    public function getSlugs()
    {
        return $this->catalog->getSlugs();
    }

    public function getSpecials()
    {
        return $this->catalog->getSpecials();
    }

    public function isOutOfStock()
    {
        return $this->catalog->isOutOfStock();
    }
}

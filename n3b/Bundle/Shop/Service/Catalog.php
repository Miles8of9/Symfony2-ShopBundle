<?php

namespace n3b\Bundle\Shop\Service;

use n3b\Bundle\Shop\Model\ProductManager;
use n3b\Bundle\Shop\Model\TagManager;
use n3b\Bundle\Shop\Event;

class Catalog
{
    protected $services;

    public function __construct($services)
    {
        $this->services = $services;
        $this->repo['tag'] = $this->services['em']->getRepository('n3bShopBundle:Tag');
        $this->repo['product'] = $this->services['em']->getRepository('n3bShopBundle:Product');
    }

    public function index()
    {
        $tags = $this->repo['tag']->getTagsByType(1);
        return $this->services['templating']->renderResponse('n3bShopBundle:Catalog:index.html.php', array('tags' => $tags));
    }

    public function showTag($slugStr)
    {
        $slugs = \explode(',', $slugStr);
        $categories = $this->repo['tag']->getTagsByType(array(1));

        $productIds = $this->repo['product']->getIdsByTags($slugs);
        $brands = $this->repo['tag']->getByProductIds($productIds, array(2));
        $products = $this->repo['product']->getByIds($productIds);

        return $this->services['templating']->renderResponse('n3bShopBundle:Catalog:show.html.php', array(
            'categories' => $categories,
            'brands' => $brands,
            'products' => $products,
            'slugs' => $slugs,
            ));
    }
}

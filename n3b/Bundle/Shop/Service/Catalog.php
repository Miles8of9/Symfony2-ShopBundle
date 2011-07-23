<?php

namespace n3b\Bundle\Shop\Service;

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

    public function products($slugStr, $view)
    {
        $slugs = \explode(',', $slugStr);
        $categories = $this->repo['tag']->getTagsByType(array(1));
        $selected = $this->repo['tag']->findOneBy(array('slug' => $slugs[0]));

        $productIds = $this->repo['product']->getIdsByTags($slugs);
        $brands = $this->repo['tag']->getByProductIds($productIds, array(2));
        $products = $this->repo['product']->getByIds($productIds, 1);

        return $this->services['templating']->renderResponse('n3bShopBundle:Catalog:show.html.php', array(
            'categories' => $categories,
            'brands' => $brands,
            'products' => $products,
            'slugs' => $slugs,
            'selected' => $selected,
            ));
    }

    public function product($slug)
    {
        $product = $this->repo['product']->getProductCard($slug);
        
        return $this->services['templating']->renderResponse('n3bShopBundle:Catalog:product_card.html.php', array(
            'product' => $product,
            ));
    }

    public function search()
    {
        
    }

    public function index()
    {
        $categories = $this->repo['tag']->getTagsByType(array(1));

        return $this->services['templating']->renderResponse('n3bShopBundle:Catalog:index.html.php', array(
            'categories' => $categories,
            ));
    }

    public function test()
    {
        /*
        $tags = $this->services['em']->getRepository('n3bShopBundle:Tag')->findAll();
        foreach($tags as $tag)
            $tag->slugify();

        $this->services['em']->flush();
         * 
         */
    }
}

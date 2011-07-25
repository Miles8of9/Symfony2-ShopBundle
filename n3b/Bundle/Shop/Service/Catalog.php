<?php

namespace n3b\Bundle\Shop\Service;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Catalog
{
    protected $services;

    protected $outOfStock = false;

    public function __construct($services)
    {
        $this->services = $services;
        $this->repo['tag'] = $this->services['em']->getRepository('n3bShopBundle:Tag');
        $this->repo['product'] = $this->services['em']->getRepository('n3bShopBundle:Product');
    }

    public function products($slugStr, $view, $outOfStock)
    {
        $this->slugs = \explode(',', $slugStr);
        $this->selected = $this->repo['tag']->findOneBy(array('slug' => $this->slugs[0]));

        $productIds = $this->repo['product']->getIdsByTags($this->slugs, $outOfStock);
        if(!$outOfStock && !$productIds)
            return new RedirectResponse($this->services['router']->generate('n3b_shop_catalog_products_outOfStock', array(
                'slugStr' => $slugStr,
                )));

        $this->brands = $this->repo['tag']->getByProductIds($productIds, array(2));
        $this->tags = $this->repo['tag']->getByProductIds($productIds, array(3));
        $this->products = $this->repo['product']->getByIds($productIds, 1);

        $this->outOfStock = $outOfStock;

        return $this->services['templating']->renderResponse('n3bShopBundle:Catalog:show.html.php');
    }

    public function product($slug)
    {
        $product = $this->repo['product']->getProductCard($slug);
        
        return $this->services['templating']->renderResponse('n3bShopBundle:Catalog:product_card.html.php', array(
            'product' => $product,
            ));
    }

    public function productImages($productId, $imageId)
    {
        $product = $this->repo['product']->find($productId);

        return $this->services['templating']->renderResponse('n3bShopBundle:Catalog:product_images.html.php', array(
            'product' => $product,
            'selectedId' => $imageId,
            ));
    }

    public function search()
    {
        
    }

    public function index()
    {
        $categories = $this->repo['tag']->getTagsByType(array(1));
        if(!$categories)
            throw new NotFoundHttpException();

        return $this->services['templating']->renderResponse('n3bShopBundle:Catalog:index.html.php');
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

    public function getCategories()
    {
        if(!isset($this->categories))
            $this->categories = $this->repo['tag']->getTagsByType(array(1));

        return $this->categories;
    }

    public function getSelectedCategory()
    {
        if(!isset($this->selected))
            return null;

        return $this->selected;
    }

    public function getBrands()
    {
        if(!isset($this->brands))
            return array();

        return $this->brands;
    }

    public function getTags()
    {
        if(!isset($this->tags))
            return array();

        return $this->tags;
    }

    public function getProducts()
    {
        if(!isset($this->products))
            return array();

        return $this->products;
    }

    public function getSpecials()
    {
        if(!isset($this->specials))
            $this->specials = $this->repo['product']->getSpecials();

        return $this->specials;
    }

    public function getSlugs()
    {
        if(!isset($this->slugs))
            return array();

        return $this->slugs;
    }

    public function isOutOfStock()
    {
        return $this->outOfStock;
    }
}

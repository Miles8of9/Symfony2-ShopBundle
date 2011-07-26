<?php

namespace n3b\Bundle\Shop\Service;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use n3b\Bundle\Shop\Entity\Basket as BasketModel;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Basket
{
    protected $services;
    protected $dontShowBasket = false;
    protected $XHR = false;

    public function __construct($services)
    {
        $this->services = $services;
    }

    public function init($cookieBsid, $dontShowBasket, $XHR)
    {
        if(\is_null($cookieBsid) || !($this->basket = $this->services['em']->getRepository('n3bShopBundle:Basket')->getCompleteBasket($cookieBsid, 1)))
            $this->basket = new BasketModel();

        $this->dontShowBasket = $dontShowBasket;
        $this->XHR = $XHR;
    }

    public function getBasket()
    {
        if(!isset($this->basket))
            $this->basket = new BasketModel();

        return $this->basket;
    }

    public function getBasketCookie()
    {
        //TODO какие-то проблемы с expired
        if(!isset($this->basketCookie))
            $this->basketCookie = new Cookie('bsid', $this->getBasket()->getBsid());

        return $this->basketCookie;
    }

    public function addProduct($productId)
    {
        //TODO перенести в реп, INSERT ... ON DUPLICATE KEY UPDATE
        $product = $this->services['em']->getReference('n3bShopBundle:Product', $productId);
        try {
            if(!count($this->getBasket()->getItems()))
                $this->services['em']->persist($this->getBasket());

            $item = $this->getBasket()->addProduct($product);

            //TODO нужно что-то вроде isNew(), в мануалах пока не нашел
            if(!$item->getId())
                $this->services['em']->persist($item);

            $this->services['em']->flush();
        } catch(\Exception $e) {
            throw new NotFoundHttpException('Вы хотите купить несуществующий товар?');
        }

        if($this->XHR)
            return $this->showMini();

        return new RedirectResponse($this->services['router']->generate('n3b_shop_basket'));
    }

    public function removeItem($itemId)
    {
        $item = $this->services['em']->getReference('n3bShopBundle:BasketItem', $itemId);

        $this->getBasket()->getItems()->removeElement($item);
        if(!count($this->getBasket()->getItems())) {
            $this->services['em']->remove($this->getBasket());
            $this->services['em']->flush();
            return new RedirectResponse($this->services['router']->generate('home'));
        }
        $this->services['em']->flush();

        if($this->XHR)
            return new Response('OK');

        return new RedirectResponse($this->services['router']->generate('n3b_shop_basket'));
    }

    public function increaseBasketItemQuantity($itemId)
    {
        try {
            $item = $this->services['em']->getRepository('n3bShopBundle:BasketItem')->find($itemId);
            if(!$this->getBasket()->getItems()->contains($item))
                throw new \Exception();
        } catch(\Exception $e) {
            throw new NotFoundHttpException('В вашей корзине нет этого товара.');
        }

        $item->setQuantity($item->getQuantity() + 1);
        $this->services['em']->flush();

        if($this->XHR)
            return new Response('OK');
        
        return new RedirectResponse($this->services['router']->generate('n3b_shop_basket'));
    }

    public function decreaseBasketItemQuantity($itemId)
    {
        $item = $this->services['em']->getReference('n3bShopBundle:BasketItem', $itemId);
        try {
            $item->getQuantity();
            if(!$this->getBasket()->getItems()->contains($item))
                throw new \Exception();
        } catch(\Exception $e) {
            throw new NotFoundHttpException('В вашей корзине нет этого товара.');
        }

        if($item->getQuantity() > 1) {
            $item->setQuantity($item->getQuantity() - 1);
            $this->services['em']->flush();
        }

        if($this->XHR)
            return new Response('OK');

        return new RedirectResponse($this->services['router']->generate('n3b_shop_basket'));
    }

    public function updateQuantity($itemId, $quantity)
    {
        if(!$this->XHR || $quantity < 1)
            throw new \Exception();
        
        try {
            $item = $this->services['em']->getRepository('n3bShopBundle:BasketItem')->find($itemId);
            if(!$this->getBasket()->getItems()->contains($item))
                throw new \Exception();
        } catch(\Exception $e) {
            throw new NotFoundHttpException('В вашей корзине нет этого товара.');
        }

        $item->setQuantity($quantity);
        $this->services['em']->flush();

        return new Response('OK');
    }

    public function show()
    {
        if($this->XHR)
            return $this->services['templating']->renderResponse('n3bShopBundle:Basket:full.html.php', array(
                'XHR' => true,
                'dontShow' => $this->dontShowBasket,
            ));

        if(!count($this->getBasket()->getItems()))
            return new RedirectResponse($this->services['router']->generate('home'));

        return $this->services['templating']->renderResponse('n3bShopBundle:Basket:show.html.php');
    }

    public function showMini()
    {
        if($this->XHR)
            return $this->services['templating']->renderResponse('n3bShopBundle:Basket:mini.html.php');
    }

    public function clearBasket()
    {
        $this->services['em']->remove($this->getBasket());
        $this->services['em']->flush();
    }
}

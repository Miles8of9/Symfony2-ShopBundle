<?php

namespace n3b\Bundle\Shop\Service;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Cookie;
use n3b\Bundle\Shop\Entity\Basket as BasketModel;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Basket
{
    protected $services;

    public function __construct($services)
    {
        $this->services = $services;
    }

    public function onCoreRequest(GetResponseEvent $event)
    {
        $cookieBsid = $event->getRequest()->cookies->get('bsid');

        if(\is_null($cookieBsid) || !($this->basket = $this->services['em']->getRepository('n3bShopBundle:Basket')->getCompleteBasket($cookieBsid)))
            $this->basket = new BasketModel();

        // для ajax запросов
        if(!$event->getRequest()->isXmlHttpRequest())
            return;

        if($id = $event->getRequest()->get('add_to_basket'))
            $this->addProduct($productId, false);
        elseif($id = $event->getRequest()->get('del_from_basket'))
            $this->removeItem($itemId, false);
        elseif($id = $event->getRequest()->get('decrease_item_in_basket'))
            $this->decreaseBasketItemQuantity($itemId, false);
        elseif($id = $event->getRequest()->get('increase_item_in_basket'))
            $this->decreaseBasketItemQuantity($itemId, false);
    }

    public function onCoreResponse(FilterResponseEvent $event)
    {
        $event->getResponse()->headers->setCookie($this->getBasketCookie());
    }

    public function getBasket()
    {
        return $this->basket;
    }

    protected function getBasketCookie()
    {
        if(!isset($this->basketCookie))
            $this->basketCookie = new Cookie('bsid', $this->getBasket()->getBsid());

        return $this->basketCookie;
    }

    public function addProduct($productId, $show = true)
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
        if($show)
            return $this->show();
    }

    public function removeItem($itemId, $show = true)
    {
        $item = $this->services['em']->getReference('n3bShopBundle:BasketItem', $itemId);

        $this->getBasket()->getItems()->removeElement($item);
        if(!count($this->getBasket()->getItems())) {
            $this->services['em']->remove($this->getBasket());
            $this->services['em']->flush();
            return new RedirectResponse($this->services['router']->generate('home'));
        }
        $this->services['em']->flush();
        if($show)
            return new RedirectResponse($this->services['router']->generate('n3b_shop_basket'));
    }

    public function increaseBasketItemQuantity($itemId, $show = true)
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

        if($show)
            return new RedirectResponse($this->services['router']->generate('n3b_shop_basket'));
    }

    public function decreaseBasketItemQuantity($itemId, $show = true)
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

        if($show)
            return new RedirectResponse($this->services['router']->generate('n3b_shop_basket'));
    }

    public function show()
    {
        if(!count($this->getBasket()->getItems()))
            return new RedirectResponse($this->services['router']->generate('home'));

        return $this->services['templating']->renderResponse('n3bShopBundle:Basket:show.html.php', array(
            'basket' => $this->getBasket(),
        ));
    }

    public function clearBasket()
    {
        $this->getBasket()->clearBasket();
    }
}

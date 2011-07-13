<?php

namespace n3b\Bundle\Shop\Service;

use n3b\Bundle\Shop\Form\CheckoutFullType;
use n3b\Bundle\Shop\Entity\Checkout as CheckoutModel;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Checkout
{
    protected $services;

    public function __construct($services)
    {
        $this->services = $services;
    }

    public function start()
    {
        echo '<pre>';
        \var_dump($token = $this->services['sc']->getToken()->getUser());
        echo '</pre>';
        $form = $this->services['ff']->create(new CheckoutFullType(), null, array());

        if ($this->services['request']->getMethod() == 'POST') {
            $form->bindRequest($this->services['request']);
            $checkout = $form->get('checkout')->getData();

            if ($form->isValid()) {
                foreach($this->services['basket']->getBasket()->getItems() as $item)
                    $checkout->addBasketItem($item);

                $this->services['basket']->clearBasket();

                $this->services['em']->persist($checkout);
                $this->services['em']->flush();

                return new RedirectResponse($this->services['router']->generate('n3b_shop_index'));
            }
        }
        
        return $this->services['templating']->renderResponse(
            'n3bShopBundle:Checkout:start.html.php',
            array(
                'form' => $form->createView(),
                ));
    }

    protected function bindCheckoutData($data)
    {
        
    }
}

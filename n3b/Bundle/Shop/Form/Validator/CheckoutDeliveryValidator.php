<?php

namespace n3b\Bundle\Shop\Form\Validator;

use Symfony\Component\Form\Extension\Core\Validator\DefaultValidator;
use Symfony\Component\Form\FormInterface;

class CheckoutDeliveryValidator extends DefaultValidator
{

    public function validate(FormInterface $form)
    {
        $data = $form->getData();

        if(!$data['deliver'])
            $data['checkout']->unsetDelivery();
        else
            // Symfony2 пока не хочет самостоятельно устанавливать bidirectional связи
            $data['checkout']->getDelivery()->setCheckout($data['checkout']);
    }
}

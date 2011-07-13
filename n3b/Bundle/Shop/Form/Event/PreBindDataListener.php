<?php

namespace n3b\Bundle\Shop\Form\Event;

use Symfony\Component\Form\Event\DataEvent;
use Symfony\Component\Form\FormFactory;
use n3b\Bundle\Shop\Form\NewCustomerType;
use n3b\Bundle\Shop\Entity\Customer;

class PreBindDataListener
{
    public function __construct(FormFactory $ff)
    {
        $this->ff = $ff;
    }
    
    public function onPreBindData(DataEvent $event)
    {
        $data = $event->getData();
        if(isset($data['user_save'])) {
            $event->getForm()->get('checkout')->remove('customer');
            $newCustomerForm = $this->ff->createNamed(new NewCustomerType(), 'customer', new Customer(), array(
                'validation_groups' => array('registration')
                ));
            $event->getForm()->get('checkout')->add($newCustomerForm);
        }
    }
}

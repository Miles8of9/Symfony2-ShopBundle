<?php

namespace n3b\Bundle\Shop\Form\EventSubscriber;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Event\DataEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormFactory;
use n3b\Bundle\Shop\Form\NewCustomerType;
use n3b\Bundle\Shop\Entity\Customer;

class PreBindDataSubscriber implements EventSubscriberInterface
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

    static public function getSubscribedEvents()
    {
        return array(FormEvents::PRE_BIND => 'onPreBindData');
    }
}

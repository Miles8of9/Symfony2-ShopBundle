<?php

namespace n3b\Bundle\Shop\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormEvents;

class CheckoutFullType extends AbstractType
{

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('deliver', 'checkbox', array('label' => 'доставлять будем?', 'required' => false))
            ->add('user_save', 'checkbox', array('label' => 'сохранить пользователя?', 'required' => false))
            ->add('checkout', new CheckoutType());

        $builder->addEventListener(
            FormEvents::PRE_BIND,
            array(
                new Event\PreBindDataListener($builder->getFormFactory()),
                'onPreBindData'
            ));

        $builder->addValidator(new Validator\CheckoutDeliveryValidator());
    }
}

<?php

namespace n3b\Bundle\Shop\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CheckoutType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('customer', new NewCustomerType(), array('validation_groups' => array('pass_through')))
            ->add('delivery', new DeliveryType());
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'n3b\Bundle\Shop\Entity\Checkout',
        );
    }
}

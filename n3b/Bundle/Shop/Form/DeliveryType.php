<?php

namespace n3b\Bundle\Shop\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class DeliveryType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('dateFrom')
                ->add('dateTo')
                ->add('adds', new DeliveryAddsType())
                ->add('type');
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'n3b\Bundle\Shop\Entity\Delivery',
        );
    }
}

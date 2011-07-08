<?php

namespace n3b\Bundle\Shop\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class DeliveryAddsType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('addsFull');
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'n3b\Bundle\Shop\Entity\DeliveryAdds',
        );
    }
}

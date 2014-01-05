<?php

namespace Awa\BussinessBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AAplicationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('price')
            ->add('distributor')
            ->add('categories')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Awa\BussinessBundle\Entity\AAplication'
        ));
    }

    public function getName()
    {
        return 'awa_bussinessbundle_aaplicationtype';
    }
}

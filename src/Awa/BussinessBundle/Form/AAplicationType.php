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
            ->add('urlDescarga')
            ->add('price')
            ->add('distributor')
            ->add('currency')
            ->add('categories')
            ->add('platform')
            ->add('authorized')
            ->add('description')
            ->add('images', 'collection', array('type' => new AplicationImageType, 'allow_add' => true))
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

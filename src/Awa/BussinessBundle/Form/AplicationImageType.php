<?php

namespace Awa\BussinessBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AplicationImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('aaplication')
            ->add('image')
            ->add('mainImage', null, array('required'=>false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Awa\BussinessBundle\Entity\AplicationImage'
        ));
    }

    public function getName()
    {
        return 'awa_bussinessbundle_aplicationimagetype';
    }
}

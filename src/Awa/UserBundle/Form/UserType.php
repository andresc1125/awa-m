<?php

namespace Awa\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('password','repeated',array(
                'type' => 'password',
                'invalid_message' => 'password invalid',
                'options' => array('label' => 'password')))
            ->add('email','email')
            ->add('isActive')
            ->add('roles')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Awa\UserBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'awa_userbundle_usertype';
    }
}

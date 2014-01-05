<?php

namespace Awa\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AwaAppType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('dateCreate')
            ->add('dateModify')
            ->add('numViews')
            ->add('numGo')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Awa\AppBundle\Entity\AwaApp'
        ));
    }

    public function getName()
    {
        return 'awa_appbundle_awaapptype';
    }
}

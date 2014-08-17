<?php

namespace Awa\BussinessBundle\SonataAdmin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class AplicationSonataAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text', array('label' => 'Aplication Title'))
            ->add('urlDescarga', 'url', array('label' => 'App Url'))
            ->add('price', null, array('required' => false)) //if no type is specified, SonataAdminBundle tries to guess it
            ->add('images','entity',array('required' => false,'class' => 'Awa\BussinessBundle\Entity\AplicationImage'))
            ->add('distributor', 'entity', array('class' => 'Awa\BussinessBundle\Entity\Distributor'))
            ->add('currency', 'entity', array('class' => 'Awa\BussinessBundle\Entity\Currency'))
            ->add('categories', 'entity', array('class' => 'Awa\BussinessBundle\Entity\Category'))
            ->add('platform', 'entity', array('class' => 'Awa\BussinessBundle\Entity\Platform'))
            ->add('authorized',null , array('label' => 'Authorized'))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null , array('label' => 'Aplication Title'))
            ->add('urlDescarga', null , array('label' => 'App Url'))
            ->add('price', null, array('required' => false)) //if no type is specified, SonataAdminBundle tries to guess it
            ->add('images',null,array('required' => false,'class' => 'Awa\BussinessBundle\Entity\AplicationImage'))
            ->add('distributor', null, array('class' => 'Awa\BussinessBundle\Entity\Distributor'))
            ->add('currency', null, array('class' => 'Awa\BussinessBundle\Entity\Currency'))
            ->add('categories', null, array('class' => 'Awa\BussinessBundle\Entity\Category'))
            ->add('platform', null, array('class' => 'Awa\BussinessBundle\Entity\Platform'))
            ->add('authorized',null , array('label' => 'Authorized'))
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name', 'text', array('label' => 'Aplication Title'))
            ->add('urlDescarga', 'url', array('label' => 'App Url'))
            ->add('price', null, array('required' => false)) //if no type is specified, SonataAdminBundle tries to guess it
            ->add('images','entity',array('required' => false,'class' => 'Awa\BussinessBundle\Entity\AplicationImage'))
            ->add('distributor', 'entity', array('class' => 'Awa\BussinessBundle\Entity\Distributor'))
            ->add('currency', 'entity', array('class' => 'Awa\BussinessBundle\Entity\Currency'))
            ->add('categories', 'entity', array('class' => 'Awa\BussinessBundle\Entity\Category'))
            ->add('platform', 'entity', array('class' => 'Awa\BussinessBundle\Entity\Platform'))
            ->add('authorized',null , array('label' => 'Authorized'))
        ;
    }
}

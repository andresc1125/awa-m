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
            ->add('authorized',null , array('label' => 'Authorized'))
            ->add('distributor', 'entity', array('class' => 'Awa\BussinessBundle\Entity\Distributor'))
            ->add('price', null, array('required' => false)) //if no type is specified, SonataAdminBundle tries to guess it
            ->add('images')
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('distributor')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('distributor')
            ->add('price')
        ;
    }
}

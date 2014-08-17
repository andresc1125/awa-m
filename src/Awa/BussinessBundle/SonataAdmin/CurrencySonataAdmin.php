<?php

namespace Awa\BussinessBundle\SonataAdmin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CurrencySonataAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text', array('label' => 'Currency Name'))
            ->add('symbol', 'text', array('label' => 'Currency symbol'))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id', null , array('label' => 'Currency Id'))
            ->add('name', null, array('label' => 'Currency Name'))
            ->add('symbol', null, array('label' => 'Currency symbol'))
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null , array('label' => 'Currency Id'))
            ->add('name', 'text', array('label' => 'Currency Name'))
            ->add('symbol', 'text', array('label' => 'Currency symbol'))
        ;
    }
}

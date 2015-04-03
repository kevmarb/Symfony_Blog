<?php
/**
 * Created by PhpStorm.
 * User: Kevin Marburger
 * Date: 03/04/2015
 * Time: 17:42
 */

namespace AppBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;


class UsersAdmin extends Admin {
    /**
     *  Fields to be show on show action
     *
     * {@inheritdoc}
     */

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
        ;
    }

    /**
     *  Fields to be show on show action
     *
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
        ;
    }


    /**
     *  Fields to be show on show action
     *
     * {@inheritdoc}
     */

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
        ;
    }

    /**
     *  Fields to be show on show action
     *
     * {@inheritdoc}
     */

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
        ;
    }

}
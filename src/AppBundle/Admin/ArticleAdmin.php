<?php
/**
 * Created by PhpStorm.
 * User: Kevin Marburger
 * Date: 03/04/2015
 * Time: 12:30
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;



class ArticleAdmin extends Admin{

    /**
     *  Fields to be show on show action
     *
     * {@inheritdoc}
     */

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title')
            ->add('content')
            ->add('category')
            ->add('tag')
            ->add('createdAt',null,[
                'data' => new \DateTime(),
            ])
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
            ->add('title')
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
            ->add('title')
            ->add('content')
            ->add('category')
            ->add('tag')
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
            ->add('title')
            ->add('content')
            ->add('category')
            ->add('tag')
        ;
    }
}
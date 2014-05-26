<?php

namespace WBB\BarBundle\Controller\Admin;

use WBB\CoreBundle\Controller\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TipAdmin extends Admin {

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper){
        $listMapper
            ->addIdentifier('id')
            ->add('user', null, array('editable' => true))
            ->add('description', null, array('editable' => true))
            ->add('status', null, array('editable' => true))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper){
        $filterMapper
            ->add('id')
            ->add('description')
            ->add('user')
            ->add('bar')
            ->add('status')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper){
        $showMapper
            ->with('General')
                ->add('id')
                ->add('description')
                ->add('user')
                ->add('bar')
                ->add('status')
                ->add('createdAt')
                ->add('updatedAt')
            ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper){
        $formMapper
            ->with('General')
                ->add('user', 'sonata_type_model', array('btn_add' => false))
                ->add('bar', 'sonata_type_model')
                ->add('status', 'choice', array(
                    'required' => false,
                    'choices'  => array(
                        0 => 'pending',
                        1 => 'enabled',
                        2 => 'disabled'
                    )
                ))
                ->add('description')
            ->end()
        ;
    }

}
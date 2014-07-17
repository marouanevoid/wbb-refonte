<?php

namespace WBB\BarBundle\Controller\Admin;

use WBB\BarBundle\Entity\Ad;
use WBB\CoreBundle\Controller\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class AdAdmin extends Admin {

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper){
        $listMapper
            ->addIdentifier('id')
            ->add('name', null, array('editable' => true))
            ->add('beginAt', null, array('editable' => true))
            ->add('endAt', null, array('editable' => true))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper){
        $filterMapper
            ->add('id')
            ->add('name')
            ->add('position')
            ->add('tag')
            ->add('link')
            ->add('countries')
            ->add('beginAt', 'stnw_date_filter')
            ->add('endAt', 'stnw_date_filter')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper){
        $showMapper
            ->with('General')
                ->add('id')
                ->add('name')
                ->add('position')
                ->add('tag')
                ->add('link')
                ->add('countries')
                ->add('beginAt')
                ->add('endAt')
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
                ->add('name')
                ->add('position', 'choice', array(
                    'required' => false,
                    'choices'  => Ad::getAdsPositionArray()
                ))
                ->add('tag')
                ->add('link')
                ->add('image', 'sonata_type_model_list', array(
                    'required' => false
                ), array(
                    'link_parameters' => array(
                        'context' => 'default'
                    )
                ))
                ->add('beginAt', 'datePicker') 
                ->add('endAt', 'datePicker')
                ->add('countries', 'sonata_type_model', array('multiple' => true))
            ->end()
        ;
    }

}
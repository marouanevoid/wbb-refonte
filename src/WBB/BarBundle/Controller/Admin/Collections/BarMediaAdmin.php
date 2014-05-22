<?php

/*
 * Fichier créer par : Badr HAKKARI <b.hakkari@void.fr>
 */

namespace WBB\BarBundle\Controller\Admin\Collections;

use WBB\CoreBundle\Controller\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class BarMediaAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('media', 'sonata_type_model_list', array(
                    'required' => false
                ), array(
                    'link_parameters' => array(
                        'context' => 'default'
                    )
                ))
                ->add('video1', 'sonata_type_model_list', array(
                    'required' => false
                ), array(
                    'link_parameters' => array(
                        'context' => 'default'
                    )
                ))
                ->add('video2', 'sonata_type_model_list', array(
                    'required' => false
                ), array(
                    'link_parameters' => array(
                        'context' => 'default'
                    )
                ))
                ->add('alt')
                ->add('position', 'hidden')
            ->end();
    }
}

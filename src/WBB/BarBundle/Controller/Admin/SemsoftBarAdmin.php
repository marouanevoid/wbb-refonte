<?php

/*
 * Fichier créer par : Badr HAKKARI <b.hakkari@void.fr>
 */

namespace WBB\BarBundle\Controller\Admin;

use WBB\BarBundle\Entity\Bar;
use WBB\CoreBundle\Controller\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class SemsoftBarAdmin extends Admin
{

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name')
            ->add('city')
            ->add('suburb')
            ->add('website')
            ->addIdentifier('_action', 'actions', array(
                'field'   => 'name',
                'label'    => 'Actions',
                'actions' => array(
                    'show'   => array('template' => 'WBBBarBundle:Admin/Semsoft:linkShowBar.html.twig'),
                    'delete' => array(),
                )
            ))
        ;
    }
}

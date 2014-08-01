<?php

/*
 * Fichier créer par : Badr HAKKARI <b.hakkari@void.fr>
 */

namespace WBB\BarBundle\Controller\Admin;

use WBB\BarBundle\Entity\Tag;
use WBB\CoreBundle\Controller\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TagAdmin extends Admin
{

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
            ->add('type', 'choice', array(
                'required'  => false,
                'choices'   => Tag::getTypeNames(),
                'label'     => 'Type *',
                'help'      => 'Mandatory'
            ))
            ->add('name', null, array('help'=> 'Mandatory', 'label'=> 'Name'))
            ->add('onTop')
            ->end();
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', null, array('editable' => true))
            ->add('onTop', null, array('editable' => true))
        ;
        if(!$this->hasParentFieldDescription()) {
            $listMapper
                ->add('type', null, array(
                    'template' => 'WBBBarBundle:Admin:Tag\type_field.html.twig'
                ))
                ->add('createdAt')
                ->addIdentifier('_action', 'actions', array(
                    'field'   => 'name',
                    'label'    => 'Actions',
                    'actions' => array(
                        'edit'   => array(),
                        'delete' => array(),
                    )
                ))
            ;
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('name')
            ->add('type', 'doctrine_orm_string', array(), 'choice', array('choices' => Tag::getTypeNames()))
            ->add('onTop')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('General')
            ->add('name')
            ->add('type')
            ->add('onTop')
            ->end()
        ;
    }
}

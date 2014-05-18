<?php

/*
 * Fichier créer par : Badr HAKKARI <b.hakkari@void.fr>
 */

namespace WBB\CoreBundle\Controller\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CityAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $imageOptions = array('required' => false);
        if (($object = $this->getSubject()) && $object->getImage()) {
            $path = $object->getWebPath();
            $imageOptions['help'] = '<img width="250px" src="/' . $path . '" />';
        }
        
        $formMapper
            ->with('General')
                ->add('name')
                ->add('country')
                ->add('seoDescription')
                ->add('file', 'file', $imageOptions)
                ->add('suburbs', 'sonata_type_collection', array('required'=>false))
                ->add('onTopCity')
                ->add('bestofs', null, array('expanded' => false, 'by_reference' => false, 'multiple' => true))
                ->add('trends', null, array('expanded' => false, 'by_reference' => false, 'multiple' => true), array(
                        'sortable'  => 'position'
                    ))
            ->end();
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', null, array('editable' => true))
            ->add('country')
            ->add('seoDescription')
            ->add('onTopCity', null, array('editable' => true))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('name')
            ->add('country')
            ->add('seoDescription')
            ->add('suburbs')
            ->add('onTopCity')
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
                ->add('country')
                ->add('seoDescription')
                ->add('suburbs')
                ->add('onTopCity')
            ->end()
        ;
    }
}

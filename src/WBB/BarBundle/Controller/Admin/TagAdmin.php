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
                ->add('name')
                ->add('energyLevel', 'choice', array(
                    'required' => false,
                    'choices'  => Tag::getEnergyLevels()
                ))
                ->add('isStyle')
                ->add('isOccasion')
                ->add('isAtmosphere')
                ->add('isAlcohol')
                ->add('isCocktail')
                ->add('isMood')
                ->add('onTop')
            ->end();
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', null, array('editable' => true));
        if(!$this->hasParentFieldDescription()) {
            $listMapper
                ->add('energyLevel', null, array(
                    'template' => 'WBBBarBundle:Admin:Tag\status_field.html.twig'
                ))
                ->add('isStyle', null, array('editable' => true))
                ->add('isOccasion', null, array('editable' => true))
                ->add('isAtmosphere', null, array('editable' => true))
                ->add('isAlcohol', null, array('editable' => true))
                ->add('isCocktail', null, array('editable' => true))
                ->add('isMood', null, array('editable' => true));
        }
        $listMapper
            ->add('onTop', null, array('editable' => true))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('name')
            ->add('energyLevel')
            ->add('isStyle')
            ->add('isOccasion')
            ->add('isAtmosphere')
            ->add('isAlcohol')
            ->add('isCocktail')
            ->add('isMood')
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
                ->add('energyLevel')
                ->add('isStyle')
                ->add('isOccasion')
                ->add('isAtmosphere')
                ->add('isAlcohol')
                ->add('isCocktail')
                ->add('isMood')
                ->add('onTop')
            ->end()
        ;
    }
}

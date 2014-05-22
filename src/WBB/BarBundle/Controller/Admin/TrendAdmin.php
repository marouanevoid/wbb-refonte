<?php

/*
 * Fichier créer par : Badr HAKKARI <b.hakkari@void.fr>
 */

namespace WBB\BarBundle\Controller\Admin;

use WBB\BarBundle\Entity\Trend;
use WBB\CoreBundle\Controller\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TrendAdmin extends Admin
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
                    'choices'  => Trend::getEnergyLevels()
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
            ->addIdentifier('name', null, array('editable' => true))
            ->add('energyLevel')
            ->add('onTop', null, array('editable' => true));
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

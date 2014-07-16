<?php

/*
 * Fichier créer par : Badr HAKKARI <b.hakkari@void.fr>
 */

namespace WBB\BarBundle\Controller\Admin;

use WBB\BarBundle\Entity\BarOpening;
use WBB\CoreBundle\Controller\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

class BarOpeningAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('openingDay', 'choice', array(
                    'required' => false,
                    'choices'  => BarOpening::getOpeningDays()
                ))
                ->add('fromHour', 'choice', array(
                    'required' => false,
                    'choices'  => BarOpening::getOpeningHours()
                ))
                ->add('toHour', 'choice', array(
                    'required' => false,
                    'choices'  => BarOpening::getOpeningHours()
                ))
            ->end();
    }
}

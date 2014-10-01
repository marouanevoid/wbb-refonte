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
                'choices' => BarOpening::getOpeningDays(),
                'attr' => array(
                    'style' => 'width: 250px !important;'
                )
            ))
            ->add('fromHour', null, array(
                'required' => false,
                'invalid_message' => 'Please select the hour and minutes in the From hour for openings',
                'attr' => array(
                    'class' => 'wbb-datetime-hour'
                )
            ))
            ->add('toHour', null, array(
                'required' => false,
                'invalid_message' => 'Please select the hour and minutes in the To hour for openings',
                'attr' => array(
                    'class' => 'wbb-datetime-hour'
                )
            ))
        ->end();
    }
}

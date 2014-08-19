<?php

/*
 * Fichier créer par : Badr HAKKARI <b.hakkari@void.fr>
 */

namespace WBB\BarBundle\Controller\Admin\Collections;

use WBB\CoreBundle\Controller\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

class BarMediaAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    protected $maxPerPage   = 5;

    /**
     * {@inheritdoc}
     */
    protected $maxPageLinks = 5;

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('media', 'sonata_type_model_list', array(
                    'btn_list' => false,
                    'required' => false
                ), array(
                    'link_parameters' => array(
                        'context' => 'bar'
                    )
                ))
                ->add('alt', 'textarea', array( 'attr' => array('cols'=>220, 'rows'=>6)))
                ->add('position', 'hidden')
            ->end();
    }
}

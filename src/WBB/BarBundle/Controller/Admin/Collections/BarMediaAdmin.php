<?php

/*
 * Fichier créer par : Badr HAKKARI <b.hakkari@void.fr>
 */

namespace WBB\BarBundle\Controller\Admin\Collections;

use WBB\BarBundle\Entity\Bar;
use WBB\BarBundle\Entity\Collections\BarMedia;
use WBB\CoreBundle\Controller\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use WBB\CoreBundle\Form\Type\ImagePreviewType;

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
                ->add('mediaFile', 'file', array(
                    'required'  => false,
                    'label'     => 'Media',
                    'help'      => ''
                ))
                ->add('media', 'bar_image_preview')
                ->add('youtube', null, array('help'=> 'Youtube ID (ex: OK4fJhbRL1g )', 'attr' => array('style' => "min-width: 150px;")))
                ->add('alt', 'textarea', array( 'attr' => array('cols'=>220, 'rows'=>6)))
                ->add('position', 'hidden')
            ->end();
    }
}

<?php

/*
 * Fichier créer par : Badr HAKKARI <b.hakkari@void.fr>
 */

namespace WBB\BarBundle\Controller\Admin\Collections;

use WBB\BarBundle\Entity\Tag;
use WBB\CoreBundle\Controller\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

class BarTagAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('type', 'choice', array(
                    'choices' => array(
                        Tag::WBB_TAG_TYPE_SPECIAL_FEATURES  => 'Special Features',
                        Tag::WBB_TAG_TYPE_THEME             => 'Style',
                        Tag::WBB_TAG_TYPE_BEST_COCKTAILS    => 'Best Cocktails'
                    ))
                )
                ->add('tag')
                ->add('position', 'hidden')
            ->end();
    }
}

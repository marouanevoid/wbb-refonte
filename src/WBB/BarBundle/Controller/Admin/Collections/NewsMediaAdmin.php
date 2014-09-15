<?php

namespace WBB\BarBundle\Controller\Admin\Collections;

use WBB\CoreBundle\Controller\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

class NewsMediaAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('imageFile', 'file', array(
                    'required' => false
                ))
                ->add('alt', 'textarea', array('attr'=>array('cols'=>220, 'rows'=>6)))
                ->add('position', 'hidden')
            ->end();
    }
}

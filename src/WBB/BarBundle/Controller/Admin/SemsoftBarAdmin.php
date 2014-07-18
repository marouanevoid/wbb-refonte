<?php

/*
 * Fichier créer par : Badr HAKKARI <b.hakkari@void.fr>
 */

namespace WBB\BarBundle\Controller\Admin;

use WBB\CoreBundle\Controller\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class SemsoftBarAdmin extends Admin
{

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper){

        $formMapper
            ->with('General')
                ->add('name', null, array('read_only' => true, 'disabled'  => true))
                ->add('county', null, array('read_only' => true, 'disabled'  => true))
                ->add('postalCode', null, array('read_only' => true, 'disabled'  => true))
                ->add('address', null, array('read_only' => true, 'disabled'  => true))
                ->add('description', null, array('read_only' => true, 'disabled'  => true))
                ->add('latitude', null, array('read_only' => true, 'disabled'  => true))
                ->add('longitude', null, array('read_only' => true, 'disabled'  => true))
                ->add('website', null, array('read_only' => true, 'disabled'  => true))
                ->add('email', null, array('read_only' => true, 'disabled'  => true))
                ->add('phone', null, array('read_only' => true, 'disabled'  => true))
                ->add('price', null, array('read_only' => true, 'disabled'  => true))
                ->add('isCreditCard', null, array('read_only' => true, 'disabled'  => true))
                ->add('seoDescription', null, array('read_only' => true, 'disabled'  => true))
                ->add('isOutDoorSeating', null, array('read_only' => true, 'disabled'  => true))
                ->add('isHappyHour', null, array('read_only' => true, 'disabled'  => true))
                ->add('isWiFi', null, array('read_only' => true, 'disabled'  => true))
                ->add('menu', null, array('read_only' => true, 'disabled'  => true))
                ->add('reservation', null, array('read_only' => true, 'disabled'  => true))
                ->add('parkingType', null, array('read_only' => true, 'disabled'  => true))
                ->add('facebookID', null, array('read_only' => true, 'disabled'  => true))
                ->add('facebookUserPage', null, array('read_only' => true, 'disabled'  => true))
                ->add('facebookLikes', null, array('read_only' => true, 'disabled'  => true))
                ->add('facebookCheckIns', null, array('read_only' => true, 'disabled'  => true))
                ->add('twitterName', null, array('read_only' => true, 'disabled'  => true))
                ->add('twitterUserPage', null, array('read_only' => true, 'disabled'  => true))
                ->add('instagramID', null, array('read_only' => true, 'disabled'  => true))
                ->add('instagramUserPage', null, array('read_only' => true, 'disabled'  => true))
                ->add('googlePlusUserPage', null, array('read_only' => true, 'disabled'  => true))
                ->add('foursquareID', null, array('read_only' => true, 'disabled'  => true))
                ->add('foursquareUserPage', null, array('read_only' => true, 'disabled'  => true))
                ->add('foursquareCheckIns', null, array('read_only' => true, 'disabled'  => true))
                ->add('foursquareLikes', null, array('read_only' => true, 'disabled'  => true))
                ->add('foursquareTips', null, array('read_only' => true, 'disabled'  => true))
                ->add('isPermanentlyClosed', null, array('read_only' => true, 'disabled'  => true))
                ->add('businessFound', null, array('read_only' => true, 'disabled'  => true))
                ->add('country', null, array('read_only' => true, 'disabled'  => true))
                ->add('city', null, array('read_only' => true, 'disabled'  => true))
                ->add('suburb', null, array('read_only' => true, 'disabled'  => true))
                ->add('bar', null, array('read_only' => true, 'disabled'  => true))
                ->add('energyLevel', null, array('read_only' => true, 'disabled'  => true))
                ->add('tags', null, array('read_only' => true, 'disabled'  => true))
                ->add('openings', 'sonata_type_collection', array('required' => false),
                    array(
                        'edit' => 'inline',
                        'inline' => 'table',
                        'read_only' => true,
                        'disabled'  => true
                    )
                )
                ->add('updatedColumns', null, array('read_only' => true, 'disabled'  => true))
                ->add('overwrittenColumns', null, array('read_only' => true, 'disabled'  => true))
            ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('city')
            ->add('suburb')
            ->add('website')
            ->addIdentifier('_action', 'actions', array(
                'field'   => 'name',
                'label'    => 'Actions',
                'actions' => array(
                    'merge'   => array('template' => 'WBBBarBundle:Admin/Semsoft:linkMergeBar.html.twig'),
                    'show'   => array('template' => 'WBBBarBundle:Admin/Semsoft:linkShowBar.html.twig'),
                    'delete' => array(),
                )
            ))
        ;
    }
}

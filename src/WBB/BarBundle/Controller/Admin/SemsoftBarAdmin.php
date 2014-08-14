<?php

/*
 * Fichier créer par : Badr HAKKARI <b.hakkari@void.fr>
 */

namespace WBB\BarBundle\Controller\Admin;

use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use WBB\BarBundle\Entity\Tag;
use WBB\CoreBundle\Controller\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class SemsoftBarAdmin extends Admin
{

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('name')
            ->add('country')
            ->add('city')
            ->add('bar');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper){

        $formMapper
            ->with('General')
                ->add('name', null)
                ->add('country')
                ->add('county', null, array('label'=> 'County'))
                ->add('city', null)
                ->add('postalCode', null, array('label'=>'Postal Code'))
                ->add('suburb', null)
                ->add('address', null)
                ->add('seoDescription', null)
                ->add('description', null)
                ->add('latitude', null)
                ->add('longitude', null)
                ->add('website', null)
                ->add('email', null)
                ->add('phone', null)
                ->add('openings', 'sonata_type_collection', array('required' => false),
                    array(
                        'edit' => 'inline',
                        'inline' => 'table',
                        'read_only' => true,
                        'disabled'  => true
                    )
                )
                ->add('tags', null, array(
                        'label' => 'Tags',
                        'required' => false
                    )
                )
                ->add('energyLevel', 'entity', array(
                        'class'    => 'WBBBarBundle:Tag',
                        'label'     => 'Mood',
                        'required' => false,
                        'property' => 'name',
                        'empty_value' => 'Please choose a mood',
                        'query_builder' => function (EntityRepository $er) {
                                return $er->findByType(Tag::WBB_TAG_TYPE_ENERGY_LEVEL, true);
                            }
                    )
                )
                ->add('outDoorSeating', null, array('label'=>'Outdoor Seating'))
                ->add('happyHour', null, array('label'=>'Happy Hour'))
                ->add('wifi', null, array('label'=>'Wifi'))
                ->add('price', null)
                ->add('creditCard', null)
                ->add('menu', null)
                ->add('reservation', null)
                ->add('parkingType', null, array('label' => 'Parking Type'))
                ->add('facebookID', null, array('label' => 'Facebook ID'))
                ->add('facebookUserPage', null, array('label' => 'Facebook User Page'))
                ->add('twitterName', null, array('label' => 'Twitter Name'))
                ->add('twitterUserPage', null, array('label' => 'Twitter User Page'))
                ->add('instagramID', null, array('label' => 'Instagram ID'))
                ->add('instagramUserPage', null, array('label' => 'Instagram User Page'))
                ->add('googlePlusUserPage', null, array('label' => 'Google+ User Page'))
                ->add('foursquareID', null, array('label' => 'Foursquare ID'))
                ->add('foursquareUserPage', null, array('label' => 'Foursquare User Page'))
                ->add('facebookLikes', null, array('label' => 'Facebook Likes'))
                ->add('facebookCheckIns', null, array('label' => 'Facebook Checkins'))
                ->add('foursquareLikes', null, array('label' => 'Foursquare Likes'))
                ->add('foursquareCheckIns', null, array('label' => 'Foursquare Checkins'))
                ->add('foursquareTips', null, array('label' => 'Foursquare Tips'))
                ->add('permanentlyClosed', null, array('label' => 'Permanently Closed'))
                ->add('businessFound', null, array('label' => 'Business Found'))
                ->add('bar', null, array('read_only' => true, 'disabled'  => true))
                ->add('updatedColumns', null, array('label' => 'Updated Columns'))
                ->add('overwrittenColumns', null, array('label' => 'Overwritten Columns'))
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

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
        $collection->remove('show');
    }

    public function getBatchActions()
    {
        // retrieve the default (currently only the delete action) actions
        $actions = parent::getBatchActions();

        // check user permissions
        if($this->hasRoute('edit') && $this->isGranted('EDIT') && $this->hasRoute('delete') && $this->isGranted('DELETE')){
            $actions['merge'] = array(
                'label'            => 'Merge',
                'ask_confirmation' => true // If true, a confirmation will be asked before performing the action
            );
        }

        return $actions;
    }

    public function preUpdate($object)
    {
        if($object->getTags()){
            foreach ($object->getTags() as $tag) {
                if($tag->getTag() && $tag->getTag()->getName()){
                    $tag->setSemsoftBar($object);
                }else{
                    $object->removeTag($tag);
                }
            }
        }
    }

    public function postUpdate($object)
    {
        if($object->getTags()){
            foreach ($object->getTags() as $tag) {
                if($tag->getTag() && $tag->getTag()->getName()){
                    $tag->setSemsoftBar($object);
                }else{
                    $object->removeTag($tag);
                }
            }
        }
    }
}

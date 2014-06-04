<?php

/*
 * Fichier créer par : Badr HAKKARI <b.hakkari@void.fr>
 */

namespace WBB\BarBundle\Controller\Admin;

use WBB\BarBundle\Entity\Bar;
use WBB\CoreBundle\Controller\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class BarAdmin extends Admin
{

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
            ->add('createdAt')
            ->add('updatedAt')
            ->add('onTop', null, array('editable' => true))
            ->add('status', 'status')
            ->add('user')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('name')
            ->add('city')
            ->add('suburb')
            ->add('onTop')
            ->add('createdAt', 'doctrine_orm_datetime_range', array(), null, array('widget' => 'single_text', 'format' => 'M/d/y', 'required' => false,  'attr' => array('class' => 'datepicker')))
            ->add('status', 'doctrine_orm_string', array(), 'choice',
                    array('choices' => array(
                            Bar::BAR_STATUS_PENDING_VALUE   => 'Pending',
                            Bar::BAR_STATUS_ENABLED_VALUE   => 'Enabled',
                            Bar::BAR_STATUS_DISABLED_VALUE  => 'Disabled'
                    )
                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('General')
                ->add('id')
                ->add('name')
                ->add('latitude')
                ->add('langitude')
                ->add('address')
                ->add('phone')
                ->add('email')
                ->add('website')
                ->add('twitter')
                ->add('facebook')
                ->add('instagram')
                ->add('isCreditCard')
                ->add('isCoatCheck')
                ->add('parking')
                ->add('price')
                ->add('menu')
                ->add('isReservation')
                ->add('reservation')
                ->add('description')
                ->add('onTop')
                ->add('status')
            ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        if(is_object($this->getSubject())){
            $this->getSubject()->setUser($this->getUser());
        }
        
        $formMapper
            ->with('General')
                ->add('user')
                ->add('name')
                ->add('city', 'sonata_type_model', array('required' => false))
                ->add('suburb')
                ->add('onTop')
                ->add('status', 'choice', array(
                    'required' => false,
                    'choices'  => array(
                        Bar::BAR_STATUS_PENDING_VALUE  =>  Bar::BAR_STATUS_PENDING_TEXT,
                        Bar::BAR_STATUS_ENABLED_VALUE  =>  Bar::BAR_STATUS_ENABLED_TEXT,
                        Bar::BAR_STATUS_DISABLED_VALUE =>  Bar::BAR_STATUS_DISABLED_TEXT
                    )
                ))
            ->end();

        if($this->getSecurityContext()->isGranted('ROLE_BAR_ID')){
            $formMapper
                ->with('Bar ID')
                    ->add('latitude', 'hidden')
                    ->add('longitude', 'hidden')
                    ->add('address')
                    ->add('phone')
                    ->add('email')
                    ->add('website')
                    ->add('foursquare')
                    ->add('twitter')
                    ->add('facebook')
                    ->add('instagram')
                ->end();
        }

        $formMapper
            ->with('Details')
                ->add('isCreditCard')
                ->add('isCoatCheck')
                ->add('parking', 'choice', array(
                    'required' => false,
                    'choices'  => array(
                        'Premier Etage' => 'Premier Etage',
                        'RDC'           => 'RDC',
                        'RDJ'           => 'RDJ'
                    )
                ))
                ->add('price', 'choice', array(
                    'required' => false,
                    'choices'  => array(
                        1 => 1,
                        2 => 2,
                        3 => 3,
                        4 => 4
                    )
                ))
                ->add('menu')
                ->add('isReservation')
                ->add('reservation');

        if(!$this->getSecurityContext()->isGranted('ROLE_BAR_OWNER')){
            $formMapper->add('description');
        }

        $formMapper
                ->add('seoDescription', 'textarea', array('required' => false))
            ->end()
            ->with('Medias')
                ->add('medias', 'sonata_type_collection', array('required' => false),
                    array(
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable'  => 'position'
                    ))
            ->end()
            ->with('New Tags')
                ->add('tags', 'sonata_type_collection', array('required' => false),
                    array(
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable'  => 'position'
                    ))
            ->end()
            ->with('Openings')
                ->add('openings', 'sonata_type_collection', array('required' => false),
                    array(
                        'edit' => 'inline',
                        'inline' => 'table'
                    ))
            ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getExportFields()
    {
        return array(
            $this->trans($this->getLabelTranslatorStrategy()->getLabel('username', 'show', 'label'))  => 'username',
            $this->trans($this->getLabelTranslatorStrategy()->getLabel('firstname', 'show', 'label')) => 'firstname',
            $this->trans($this->getLabelTranslatorStrategy()->getLabel('lastname', 'show', 'label'))  => 'lastname',
            $this->trans($this->getLabelTranslatorStrategy()->getLabel('email', 'show', 'label'))     => 'email',
        );
    }

    public function prePersist($object)
    {
        foreach ($object->getMedias() as $media) {
            $media->setBar($object);
        }

        foreach ($object->getTags() as $tag) {
            $tag->setBar($object);
        }

        foreach ($object->getOpenings() as $opening) {
            $opening->setBar($object);
        }
    }

    public function preUpdate($object)
    {
        foreach ($object->getMedias() as $media) {
            $media->setBar($object);
        }

        foreach ($object->getTags() as $tag) {
            $tag->setBar($object);
        }

        foreach ($object->getOpenings() as $opening) {
            $opening->setBar($object);
        }
    }
}

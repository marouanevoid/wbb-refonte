<?php

/*
 * Fichier créer par : Badr HAKKARI <b.hakkari@void.fr>
 */

namespace WBB\BarBundle\Controller\Admin;

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
            ->add('isCreditCard', null, array('editable' => true))
            ->add('isCoatCheck', null, array('editable' => true))
            ->add('price', null, array('editable' => true))
            ->add('isReservation', null, array('editable' => true))
            ->add('onTop', null, array('editable' => true))
            ->add('status', null, array('editable' => true))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('id')
            ->add('name')
            ->add('phone')
            ->add('email')
            ->add('website')
            ->add('twitter')
            ->add('facebook')
            ->add('instagram')
            ->add('isCreditCard')
            ->add('isCoatCheck')
            ->add('price')
            ->add('isReservation')
            ->add('onTop')
            ->add('status')
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
                ->add('adresse')
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
        $this->getSubject()->setUser($this->getUser());

        $formMapper
            ->with('General')
                ->add('user', 'sonata_type_model')
                ->add('name')
                ->add('city', 'sonata_type_model')
                ->add('latitude')
                ->add('langitude')
                ->add('adresse')
                ->add('phone')
                ->add('email')
                ->add('website')
            ->end()
            ->with('Social')
                ->add('twitter')
                ->add('facebook')
                ->add('instagram')
            ->end()
            ->with('Details')
                ->add('isCreditCard')
                ->add('isCoatCheck')
                ->add('parking')
                ->add('price')
                ->add('menu')
                ->add('isReservation')
                ->add('reservation')
                ->add('description')
            ->end()
            ->with('Medias')
                ->add('medias', 'sonata_type_collection', array('required' => false),
                    array(
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable'  => 'position'
                    ))
            ->end()
            ->with('Order')
                ->add('onTop')
                ->add('status')
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
    }

    public function preUpdate($object)
    {
        foreach ($object->getMedias() as $media) {
            $media->setBar($object);
        }
    }
}

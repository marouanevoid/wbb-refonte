<?php

/*
 * Fichier créer par : Badr HAKKARI <b.hakkari@void.fr>
 */

namespace WBB\BarBundle\Controller\Admin;

use Sonata\AdminBundle\Validator\ErrorElement;
use WBB\BarBundle\Entity\Bar;
use WBB\CoreBundle\Controller\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class BestOfAdmin extends Admin
{

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('sponsor', null, array('editable' => true))
            ->add('byTrend', null, array('editable' => true))
            ->add('onTop', null, array('editable' => true))
            ->add('city', null, array('editable' => true))
            ->add('country', null, array('editable' => true))
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
            ->add('sponsor')
            ->add('byTrend')
            ->add('onTop')
            ->add('city')
            ->add('country')
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
            ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $imageOptions = array('required' => false);
        if (($object = $this->getSubject()) && $object->getImage()) {
            $path = $object->getWebPath();
            $imageOptions['help'] = '<img width="250px" src="/' . $path . '" />';
        }

        $sponsorImageOptions = array('required' => false);
        if (($object = $this->getSubject()) && $object->getSponsorImage()) {
            $path = $object->getWebPath(true);
            $sponsorImageOptions['help'] = '<img width="250px" src="/' . $path . '" />';
        }

        $formMapper
            ->with('General')
                ->add('name')
                ->add('city', 'sonata_type_model')
                ->add('country', 'sonata_type_model')
                ->add('description')
                ->add('file', 'file', $imageOptions)
                ->add('sponsor')
                ->add('sponsorImageFile', 'file', $sponsorImageOptions)
                ->add('seoDescription')
                ->add('byTrend')
                ->add('onTop')
                ->add('ordered')
            ->end()
            ->with('Trends')
                ->add('trends', 'sonata_type_collection', array('required' => false),
                    array(
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable'  => 'position'
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

    /**
     * {@inheritdoc}
     */
    public function validate(ErrorElement $errorElement, $object)
    {
        if (is_null($object->getImage()) && !is_object($object->getFile()) ) {
            $errorElement->with('file')->addViolation('file')->end();
        }

        if (is_null($object->getSponsorImage()) && !is_object($object->getSponsorImageFile()) ) {
            $errorElement->with('file')->addViolation('file')->end();
        }

        $errorElement->with('file')->assertImage()->end();
    }

    public function prePersist($object)
    {   $object->preUpload();
        $object->preUpload(true);

        foreach ($object->getTrends() as $trend) {
            $trend->setBestof($object);
        }
    }

    public function preUpdate($object)
    {
        $object->preUpload();
        $object->preUpload(true);

        foreach ($object->getTrends() as $trend) {
            $trend->setBestof($object);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function postUpdate($object)
    {
        $object->upload();
        $object->upload(true);
    }

    /**
     * {@inheritdoc}
     */
    public function postRemove($object)
    {
        $object->removeUpload();
        $object->removeUpload(true);
    }
}

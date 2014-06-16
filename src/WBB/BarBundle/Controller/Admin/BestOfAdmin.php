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
            ->add('byTag', null, array('editable' => true))
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
            ->add('byTag')
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
            $imageOptions['help'] = 'Mandatory<br /><img width="250px" src="/' . $path . '" />';
            $imageOptions['label'] = 'Best of visual *';
        }

        $sponsorImageOptions = array('required' => false);
        if (($object = $this->getSubject()) && $object->getSponsorImage()) {
            $path = $object->getWebPath(true);
            $sponsorImageOptions['help'] = '<img width="250px" src="/' . $path . '" />';
            $sponsorImageOptions['label'] = 'Sponsor visual';
        }

        $formMapper
            ->with('General')
                ->add('name', null, array('label' => 'Name of the best of *', 'help'=>'Mandatory'))
                ->add('country', null, array('required' => false))
                ->add('city', null, array('required' => false))
                ->add('description', 'textarea', array('label'=>'Best of description *', 'help' => 'Mandatory'))
                ->add('file', 'file', $imageOptions)
                ->add('sponsor')
                ->add('sponsorImageFile', 'file', $sponsorImageOptions)
                ->add('seoDescription', 'textarea', array('label' => 'SEO description *', 'help' => 'Mandatory'))
                ->add('byTag')
                ->add('onTop')
                ->add('ordered', null, array('label' => 'Order from bar tab'))
            ->end()
            ->with('Tags')
                ->add('tags', 'sonata_type_collection',
                    array(
                        'required' => false,
                        'label' => 'Add a tag to this best of'
                    ),
                    array(
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable'  => 'position'
                    ))
            ->end()
            ->with('Bars')
                ->add('bars', 'sonata_type_collection',
                    array(
                        'required' => false,
                        'label'    => 'Add a bar to this best of'
                    ),
                    array(
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable'  => 'position'
                    ))
            ->end()
            ->with('You may also like')
                ->add('bestofs', null,
                    array(
                        'required' => false,
                        'label' => 'If you want to add a related Best of, select it or them',
                        'help' => '3 maximum'
                    )
                )
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
        $errorElement->with('file')->assertImage()->end();
        $errorElement->with('sponsorImageFile')->assertImage()->end();
    }

    public function prePersist($object)
    {
        $object->preUpload();
        $object->preUpload(true);

        if($object->getTags()){
            foreach ($object->getTags() as $tag) {
                $tag->setBestof($object);
            }
        }

        if($object->getBars()){
            foreach ($object->getBars() as $bar) {
                $bar->setBestof($object);
            }
        }
    }

    public function preUpdate($object)
    {
        $object->preUpload();
        $object->preUpload(true);

        if($object->getTags()){
            foreach ($object->getTags() as $tag) {
                $tag->setBestof($object);
            }
        }

        if($object->getBars()){
            foreach ($object->getBars() as $bar) {
                $bar->setBestof($object);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function postPersist($object)
    {
        $object->upload();
        $object->upload(true);
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

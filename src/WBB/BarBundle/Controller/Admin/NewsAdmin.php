<?php

namespace WBB\BarBundle\Controller\Admin;

use WBB\CoreBundle\Controller\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class NewsAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('quoteAuthor', null, array('editable' => true))
            ->add('quoteText', null, array('label'=> 'Quote', 'editable' => true))
            ->add('seoDescription', null, array('label'=> 'Short description', 'editable' => true))
            ->add('interview', null, array('editable' => true))
            ->add('onTop', null, array('editable' => true))
            ->add('createdAt', null, array('editable' => true))
            ->add('updatedAt', null, array('editable' => true))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('id')
            ->add('title')
            ->add('quoteAuthor')
            ->add('quoteText', null, array('label'=> 'Quote'))
            ->add('seoDescription', null, array('label'=> 'Short description'))
            ->add('richDescription', null, array('label'=> 'News content'))
            ->add('interview')
            ->add('onTop')
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
                ->add('title')
                ->add('quoteAuthor')
                ->add('quoteText')
                ->add('seoDescription')
                ->add('richDescription')
                ->add('interview')
                ->add('onTop')
                ->add('createdAt')
                ->add('updatedAt')
            ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $object = $this->getSubject();

        $formMapper
            ->with('General')
                ->add('user', null, array('help' => 'Optional', 'required' => false, 'empty_value' => 'Choose a user'))
                ->add('title', null, array('help'=> 'Mandatory', 'label'=> 'Title *'))
                ->add('quoteAuthor')
                ->add('quoteText', null, array('label'=> 'Quote'))
                ->add('seoDescription', null, array('help'=> 'Mandatory', 'label'=> 'Short description *'))
                ->add('richDescription', 'textarea', array('label'=>'News Content *','help'=>'Mandatory', 'required' => false,'attr'=>array('class'=>'wysihtml5')))
                ->add('interview', null, array('label' => 'Interview'))
                ->add('onTop')

                ->add('sponsor', null, array('help'=> 'Mandatory', 'label'=> 'Sponsor Name'))
                ->add('sponsorFile', 'file',
                    $this->getImageOptions($this->getSubject()->getSponsorImageName(), 'sponsor_preview', array(
                        'required'  => false,
                        'help'      => 'Preferred size (width: 640px , height: 480px)',
                        'label'     => 'Sponsor image'
                    ))
                )
                ->add('sponsorSmallFile', 'file',
                    $this->getImageOptions($this->getSubject()->getSponsorSmallImageName(), 'sponsor_preview', array(
                        'required'  => false,
                        'help'      => 'Preferred size (width: 82px , height: 82px)',
                        'label'     => 'Small sponsor image'
                    ))
                )
            ->end()
            ->with('Medias')
                ->add('medias', 'sonata_type_collection',
                    array(
                        'required'      => false,
                        'by_reference'  => false,
                        'help'          => 'Preferred size (width: 900px , height: 600px)',
                        'type_options'  => array('delete' => true)
                    ),
                    array(
                        'edit'      => 'inline',
                        'inline'    => 'table',
                        'sortable'  => 'position'
                    )
                )
            ->end()
            ->with('Related')
                ->add('bars', null, array('required' => false, 'multiple' => true, 'by_reference' => false))
                ->add('cities', null, array('required' => false, 'multiple' => true, 'by_reference' => false))
                ->add('bestOfs', null, array('required' => false, 'multiple' => true, 'by_reference' => false))
            ->end()
        ;
    }

    public function getNewInstance()
    {
        $newInstance = parent::getNewInstance();
        $newInstance->setInterview(true);
        $newInstance->setOnTop(true);

        return $newInstance;
    }

    public function prePersist($object)
    {
        if ($object->getMedias()) {
            foreach ($object->getMedias() as $media) {
                if ($media && $media->getMedia()) {
                    $media->setNews($object);
                } else {
                    $object->removeMedia($media);
                }
            }
        }
    }

    public function preUpdate($object)
    {
        if ($object->getMedias()) {
            foreach ($object->getMedias() as $media) {
                if ($media && $media->getMedia()) {
                    $media->setNews($object);
                } else {
                    $object->removeMedia($media);
                }
            }
        }
    }
}

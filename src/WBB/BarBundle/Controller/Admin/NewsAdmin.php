<?php

namespace WBB\BarBundle\Controller\Admin;

use WBB\CoreBundle\Controller\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class NewsAdmin extends Admin {

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper){
        $listMapper
            ->addIdentifier('title')
            ->add('shareText', null, array('editable' => true))
            ->add('quoteAuthor', null, array('editable' => true))
            ->add('quoteText', null, array('editable' => true))
            ->add('seoDescription', null, array('editable' => true))
            ->add('interview', null, array('editable' => true))
            ->add('onTop', null, array('editable' => true))
            ->add('createdAt', null, array('editable' => true))
            ->add('updatedAt', null, array('editable' => true))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper){
        $filterMapper
            ->add('id')
            ->add('title')
            ->add('shareText')
            ->add('quoteAuthor')
            ->add('quoteText')
            ->add('seoDescription')
            ->add('richDescription')
            ->add('interview')
            ->add('onTop')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper){
        $showMapper
            ->with('General')
                ->add('id')
                ->add('title')
                ->add('shareText')
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
    protected function configureFormFields(FormMapper $formMapper){
        $formMapper
            ->with('General')
                ->add('user', 'sonata_type_model', array('btn_add' => false))
                ->add('title', null, array('help'=> 'Mandatory', 'label'=> 'Title *'))
                ->add('shareText', null, array('help'=> 'Mandatory', 'label'=> 'Share text *'))
                ->add('quoteAuthor')
                ->add('quoteText')
                ->add('seoDescription', null, array('help'=> 'Mandatory', 'label'=> 'SEO Description *'))
                ->add('richDescription', 'textarea', array('label'=>'News Description *','help'=>'Mandatory', 'required' => false,'attr'=>array('class'=>'wysihtml5')))
<<<<<<< HEAD
                ->add('isAnInterview')
                ->add('isOnTop')
=======
                ->add('interview')
                ->add('onTop')
>>>>>>> b51212626d3388f013e0980a5916c7988c0c5085
                ->add('sponsor', null, array('help'=> 'Mandatory', 'label'=> 'Sponsor Name'))
                ->add('sponsorImage', 'sonata_type_model_list', array(
                    'required' => false,
                    'help'      => 'Preferred size (width: 368px , height: 170px)'
                ), array(
                    'link_parameters' => array(
                        'context' => 'sponsor'
                    )
                ))
                ->add('sponsorImageSmall', 'sonata_type_model_list', array(
                    'required'  => false,
                    'help'      => 'Preferred size (width: 95px , height: 105px)'
                ), array(
                    'link_parameters' => array(
                        'context' => 'sponsor_small'
                    )
                ))
            ->end()
            ->with('Medias')
                ->add('medias', 'sonata_type_collection',
                    array(
                        'required'     => false,
                        'by_reference' => false,
                        'type_options' => array('delete' => true)
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
    
    public function getNewInstance(){
        $newInstance = parent::getNewInstance();
        $newInstance->setInterview(true);
        $newInstance->setOnTop(true);

        return $newInstance;
    }

    public function prePersist($object)
    {
        if($object->getMedias()){
            foreach ($object->getMedias() as $media) {
                if($media && $media->getMedia()){
                    $media->setNews($object);
                }else{
                    $object->removeMedia($media);
                }
            }
        }
    }

    public function preUpdate($object)
    {
        if($object->getMedias()){
            foreach ($object->getMedias() as $media) {
                if($media && $media->getMedia()){
                    $media->setNews($object);
                }else{
                    $object->removeMedia($media);
                }
            }
        }
    }

}
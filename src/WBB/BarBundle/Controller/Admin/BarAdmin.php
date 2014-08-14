<?php

/*
 * Fichier créer par : Badr HAKKARI <b.hakkari@void.fr>
 */

namespace WBB\BarBundle\Controller\Admin;

use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;
use WBB\BarBundle\Entity\Bar;
use WBB\BarBundle\Entity\Tag;
use WBB\CoreBundle\Controller\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Doctrine\ORM\EntityRepository;

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
            ->add('website', 'string', array(
                'template' => 'WBBBarBundle:Admin:Bar\list_bar_website_url.html.twig'
            ))
            ->add('createdAt')
            ->add('updatedAt')
            ->add('onTop', null, array('editable' => true))
            ->add('status', 'status')
            ->add('user')
            ->addIdentifier('_action', 'actions', array(
                'field'   => 'name',
                'label'    => 'Actions',
                'actions' => array(
                    'show'   => array('template' => 'WBBBarBundle:Admin/Bar:linkShowBar.html.twig'),
                    'edit'   => array(),
                    'delete' => array(),
                )
            ))
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
            ->add('status', 'doctrine_orm_string', array(), 'choice',
                array('choices' => array(
                    Bar::BAR_STATUS_PENDING_VALUE   => 'Pending',
                    Bar::BAR_STATUS_ENABLED_VALUE   => 'Enabled',
                    Bar::BAR_STATUS_DISABLED_VALUE  => 'Disabled'
                )
            ))
            ->add('createdAfter', 'doctrine_orm_callback',
                array(
                    'label' => 'Created After',
                    'callback' => function(ProxyQuery $queryBuilder, $alias, $field, $value) {
                            if (!$value['value']) {
                                return;
                            }
                            $time = strtotime($value['value']);
                            $inputValue = date('Y-m-d', $time);
                            $queryBuilder->andWhere("$alias.createdAt >= :createdAt");
                            $queryBuilder->setParameter('createdAt', $inputValue);
                            return true;
                        },
                    'field_type' => 'text'
                ), null, array('attr' => array('class' => 'datepicker'))
            )
            ->add('updatedAfter', 'doctrine_orm_callback',
                array(
                    'label' => 'Updated After',
                    'callback' => function(ProxyQuery $queryBuilder, $alias, $field, $value) {
                            if (!$value['value']) {
                                return;
                            }
                            $time = strtotime($value['value']);
                            $inputValue = date('Y-m-d', $time);
                            $queryBuilder->andWhere("$alias.updatedAt >= :updatedAt");
                            $queryBuilder->setParameter('updatedAt', $inputValue);
                            return true;
                        },
                    'field_type' => 'text'
                ), null, array('attr' => array('class' => 'datepicker'))
            )
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
                ->add('creditCard')
                ->add('coatCheck')
                ->add('parking')
                ->add('price')
                ->add('menu')
                ->add('reservation')
                ->add('reservationLink')
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
//        if(is_object($this->getSubject())){
//            $this->getSubject()->setUser($this->getUser());
//        }
        
        $formMapper
            ->with('General')
                ->add('user', null, array('help' => 'Optional', 'required' => false, 'empty_value' => 'Choose a user'))
                ->add('name', null, array('label'=>'Name of the bar', 'help' => 'Mandatory'))
                ->add('city', null, array('help' => 'Mandatory', 'required' => true))
                ->add('suburb', null, array('help' => 'Mandatory', 'required' => true))
                ->add('onTop')
                ->add('status', 'choice', array(
                    'required' => false,
                    'help' => 'Keep the "Pending" status until the bar page is completely finished.',
                    'choices'  => array(
                        Bar::BAR_STATUS_PENDING_VALUE  =>  Bar::BAR_STATUS_PENDING_TEXT,
                        Bar::BAR_STATUS_ENABLED_VALUE  =>  Bar::BAR_STATUS_ENABLED_TEXT,
                        Bar::BAR_STATUS_DISABLED_VALUE =>  Bar::BAR_STATUS_DISABLED_TEXT
                    ),
                    'empty_value' => false,
                    'preferred_choices' => array(Bar::BAR_STATUS_PENDING_VALUE  =>  Bar::BAR_STATUS_PENDING_TEXT)
                ))
            ->end()
            ->with('Bar Details');
                if($this->getSecurityContext()->isGranted('ROLE_BAR_ID')){
                    $formMapper
                        ->add('latitude', 'hidden')
                        ->add('longitude', 'hidden')
                        ->add('address', null, array('help' => 'Mandatory'))
                        ->add('phone', null, array('help' => 'Mandatory'))
                        ->add('email')
                        ->add('website', null, array('help' => 'Example : http://www.url.com'))
                        ->add('foursquare', null, array('help' => 'Example : 4bfd2db02b83b71365a7a998'))
                        ->add('twitter', null, array('help' => 'Example : buddhabargroup'))
                        ->add('facebook', null, array('help' => 'Example : buddhabarofficial'))
                        ->add('instagram', null, array('help' => 'Example : buddhabarparis'));
                }

        $formMapper
            ->add('creditCard')
            ->add('coatCheck')
            ->add('parking', 'choice', array(
                'required' => false,
                'choices'  => array(
                    'Street level'              => 'Street level',
                    'Underground'               => 'Underground',
                    'Unattended parking lot'    => 'Unattended parking lot',
                    'Valet'                     => 'Valet'
                )
            ))
            ->add('price', 'choice', array(
                'required' => false,
                'choices'  => array(
                    1 => '$',
                    2 => '$$',
                    3 => '$$$',
                    4 => '$$$$'
                )
            ))
            ->add('menu', null, array('help' => 'Example : http://www.url.com'))
            ->add('reservation')
            ->add('reservationLink', null, array('help' => 'Example : http://www.url.com'));

        if(!$this->getSecurityContext()->isGranted('ROLE_BAR_OWNER')){
            $formMapper
                ->add('description', 'textarea', array('required' => false,'help' => 'Mandatory', 'attr' => array('class'=>'wysihtml5')))
            ;
        }

        $formMapper
                ->add('seoDescription', 'textarea', array(
                        'required' => false,
                        'label' => 'SEO Description *',
                        'help' => 'Mandatory (160 characters max)',
                        'attr' => array(
                            'cols'=>220,
                            'rows'=>10
                        )
                    )
                )
            ->end()
            ->with('Medias')
                ->add('medias', 'sonata_type_collection', array('required' => false, 'help' => 'Add a WBB media is mandatory'),
                    array(
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable'  => 'position'
                    ))
            ->end()
            ->with('Tags')
                ->add('energyLevel', 'entity', array(
                        'class'    => 'WBBBarBundle:Tag',
                        'help'     => 'Mandatory',
                        'label'     => 'Mood',
                        'required' => true,
                        'property' => 'name',
                        'empty_value' => 'Please choose a mood',
                        'query_builder' => function (EntityRepository $er) {
                                return $er->findByType(Tag::WBB_TAG_TYPE_ENERGY_LEVEL, true);
                            }
                    )
                )
                ->add('toGoWith', null,
                    array(
                        'required' => false,
                        'multiple' => true,
                        'by_reference' => false,
                        'query_builder' => function (EntityRepository $er) {
                                return $er->findByType(Tag::WBB_TAG_TYPE_WITH_WHO, true);
                            }
                    )
                )
                ->add('tags', 'sonata_type_collection', array(
                    'required' => false,
                    'help' => 'Associate a tag minimum to the bar is mandatory'),
                    array(
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable'  => 'position'
                    )
                )
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

    public function getBatchActions()
    {
        // retrieve the default (currently only the delete action) actions
        $actions = parent::getBatchActions();

        // check user permissions
        if($this->hasRoute('edit') && $this->isGranted('EDIT') && $this->hasRoute('delete') && $this->isGranted('DELETE')){
            $actions['export'] = array(
                'label'            => 'Export',
                'ask_confirmation' => false
            );
        }

        return $actions;
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
        if($object->getMedias()){
            foreach ($object->getMedias() as $media) {
                if($media && $media->getMedia()){
                    $media->setBar($object);
                }else{
                    $object->removeMedia($media);
                }
            }
        }

        if($object->getTags()){
            foreach ($object->getTags() as $tag) {
                if($tag->getTag() && $tag->getTag()->getName()){
                    $tag->setBar($object);
                }else{
                    $object->removeTag($tag);
                }
            }
        }

        if($object->getOpenings()){
            foreach ($object->getOpenings() as $opening) {
                if($opening && $opening->getOpeningDay()){
                    $opening->setBar($object);
                }else{
                    $object->removeOpening($opening);
                }
            }
        }
    }

    public function preUpdate($object)
    {
        if($object->getMedias()){
            foreach ($object->getMedias() as $media) {
                if($media && $media->getMedia()){
                    $media->setBar($object);
                }else{
                    $object->removeMedia($media);
                }
            }
        }

        if($object->getTags()){
            foreach ($object->getTags() as $tag) {
                if($tag->getTag() && $tag->getTag()->getName()){
                    $tag->setBar($object);
                }else{
                    $object->removeTag($tag);
                }
            }
        }

        if($object->getOpenings()){
            foreach ($object->getOpenings() as $opening) {
                if($opening && $opening->getOpeningDay()){
                    $opening->setBar($object);
                }else{
                    $object->removeOpening($opening);
                }
            }
        }
    }
}

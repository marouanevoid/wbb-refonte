<?php

/*
 * Fichier créer par : Badr HAKKARI <b.hakkari@void.fr>
 */

namespace WBB\BarBundle\Controller\Admin;

use Sonata\AdminBundle\Validator\ErrorElement;
use WBB\BarBundle\Entity\Tag;
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
            ->add('country')
            ->add('city')
            ->add('sponsor', null, array('editable' => true))
            ->add('nbBars', 'string', array(
                'label' => 'Bars',
                'template' => 'WBBCoreBundle:Admin:list\list_nb_bars.html.twig'
            ))
            ->add('byTag', null, array('editable' => true))
            ->add('ordered', null, array('editable' => true))
            ->add('createdAt')
            ->add('updatedAt')
            ->add('onTop', null, array('editable' => true))
            ->addIdentifier('_action', 'actions', array(
                'field'   => 'name',
                'label'    => 'Actions',
                'actions' => array(
//                    'show'   => array('template' => 'WBBBarBundle:Admin/Bar:linkShowBar.html.twig'),
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
            ->add('country')
            ->add('city')
            ->add('sponsor')
            ->add('seoDescription')
            ->add('byTag')
            ->add('ordered')
            ->add('onTop')
            ->add('tags')
            ->add('bars')
            ->add('createdAfter', 'doctrine_orm_callback',
                array(
                    'label' => 'Created After',
                    'callback' => function($queryBuilder, $alias, $field, $value) {
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
                    'callback' => function($queryBuilder, $alias, $field, $value) {
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
                ->add('name', null, array('label' => 'Name of the best of', 'help'=>'Mandatory'))
                ->add('country', null, array('required' => ($this->getSecurityContext()->isGranted('ROLE_BAR_EXPERT'))?true:false))
                ->add('city', null, array('required' => ($this->getSecurityContext()->isGranted('ROLE_BAR_EXPERT'))?true:false))
                ->add('description', 'textarea', array('required' => false, 'label'=>'Best of description *', 'help' => 'Mandatory', 'attr' => array('class'=>'wysihtml5')))
                ->add('seoDescription', 'textarea', array('label' => 'SEO description *', 'help' => 'Mandatory', 'required'=> false))
                ->add('image', 'sonata_type_model_list',
                    array(
                        'required'  => false,
                        'btn_list'  => false,
                        'help'      => 'Mandatory',
                        'label'     => 'Best of visual *'
                    ), array(
                        'link_parameters' => array(
                            'context' => 'simple_image'
                        )
                    ))
//                ->add('sponsor')
//                ->add('sponsorImage', 'sonata_type_model_list',
//                    array(
//                        'required'  => false,
//                        'btn_list'  => false,
//                        'label'     => 'Sponsor visual'
//                    ), array(
//                        'link_parameters' => array(
//                            'context' => 'simple_image'
//                        )
//                    ))
                ->add('byTag', null, array('help'=> 'Create a best of with tag'))
                ->add('onTop')
                ->add('ordered', null, array('label' => 'Order from bar tab'))
            ->end();

        if($object->getByTag()){
            $formMapper
                ->with('Tags')
                    ->add('energyLevel', 'entity', array(
                            'class'    => 'WBBBarBundle:Tag',
                            'required' => false,
                            'empty_value' => 'Please choose a mood',
                            'property' => 'name',
                            'query_builder' => function ($er) {
                                    return $er->findByType(Tag::WBB_TAG_TYPE_ENERGY_LEVEL, true);
                                }
                        )
                    )
                    ->add('toGoWith', null,
                        array(
                            'required' => false,
                            'multiple' => true,
                            'by_reference' => false,
                            'query_builder' => function ($er) {
                                    return $er->findByType(Tag::WBB_TAG_TYPE_WITH_WHO, true);
                                }
                        )
                    )
                    ->add('tags', 'sonata_type_collection',
                        array(
                            'required'  => false,
                            'label'     => 'Add a tag to this best of *',
                            'help'      => 'Mandatory'
                        ),
                        array(
                            'edit'      => 'inline',
                            'inline'    => 'table',
                            'sortable'  => 'position'
                        ))
                ->end();
        }else{
            $formMapper
                ->with('Bars')
                ->add('bars', 'sonata_type_collection',
                    array(
                        'required'  => false,
                        'label'     => 'Add a bar to this best of*',
                        'help'      => 'Mandatory'
                    ),
                    array(
                        'edit'      => 'inline',
                        'inline'    => 'table',
                        'sortable'  => 'position'
                    ))
                ->end();
        }

        $formMapper
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

    public function createQuery($context = 'list')
    {
        $qb = parent::createQuery($context);
        $alias = $qb->getRootAlias();
        if($this->getSecurityContext()->isGranted('ROLE_BAR_EXPERT')){
            $qb->andWhere($qb->expr()->isNotNull("$alias.city"));
        }

        return $qb;
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
        if($object->getTags()){
            foreach ($object->getTags() as $tag) {
                if($tag->getTag() and $tag->getTag()->getName()){
                    $tag->setBestof($object);
                }else{
                    $object->removeTag($tag);
                }
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
        if($object->getTags()){
            foreach ($object->getTags() as $tag) {
                if($tag->getTag() and $tag->getTag()->getName()){
                    $tag->setBestof($object);
                }else{
                    $object->removeTag($tag);
                }
            }
        }

        if($object->getBars()){
            foreach ($object->getBars() as $bar) {
                $bar->setBestof($object);
            }
        }
    }
}

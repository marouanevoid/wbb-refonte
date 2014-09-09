<?php

/*
 * Fichier créer par : Badr HAKKARI <b.hakkari@void.fr>
 */

namespace WBB\CoreBundle\Controller\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;

class CityAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $imageOptions = array('required' => false, 'label' => 'Main visual *');
        if (($object = $this->getSubject()) && $object->getImage()) {
            $path = $object->getWebPath();
            $imageOptions['help'] = 'Associate a visual is mandatory for top cities<br /><img width="250px" src="/' . $path . '" />';
        }else{
            $imageOptions['help'] = 'Associate a visual is mandatory for top cities';
        }

        $formMapper
            ->with('General')
                ->add('name', null, array('label' => 'Name of the City', 'help' => 'Mandatory'))
                ->add('country', null, array('help' => 'Mandatory'))
                ->add('seoDescription', null, array('help' => 'Mandatory (160 characters max)'))
                ->add('onTopCity')
                ->add('suburbs', 'sonata_type_collection',
                    array(
                        'required'  => false,
                        'help'      => 'Associate a neighborhood minimum to the city is mandatory'
                    ), array(
                        'edit' => 'inline',
                        'inline' => 'table'
                    )
                )
                ->add('latitude', 'hidden')
                ->add('longitude', 'hidden')
            ->end()
            ->with('Media')
                ->add('file', 'file', $imageOptions)
//                ->add('image', 'sonata_type_model_list',
//                    array(
//                        'required'  => false,
//                        'btn_list'  => false,
//                        'help'      => 'Associate a visual is mandatory for top cities',
//                        'label'     => 'Main visual *'
//                    ), array(
//                        'link_parameters' => array(
//                            'context' => 'city'
//                        )
//                    ))
            ->end()
            ->with('Related Best Of')
                ->add('bestofs', 'sonata_type_collection', array('required' => false),
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
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', null, array('editable' => true))
            ->add('country')
            ->add('seoDescription', null, array('label' => 'SEO Description'))
            ->add('nbAreas', 'string', array(
                'label' => 'Neighborhoods',
                'template' => 'WBBCoreBundle:Admin:list\list_nb_areas.html.twig'
            ))
            ->add('nbBars', 'string', array(
                'label' => 'Bars',
                'template' => 'WBBCoreBundle:Admin:list\list_nb_bars.html.twig'
            ))
            ->add('nbNews', 'string', array(
                'label' => 'News',
                'template' => 'WBBCoreBundle:Admin:list\list_nb_news.html.twig'
            ))
            ->add('createdAt')
            ->add('updatedAt')
            ->add('onTopCity', null, array('editable' => true))
            ->addIdentifier('_action', 'actions', array(
                'field'   => 'name',
                'label'    => 'Actions',
                'actions' => array(
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
            ->add('seoDescription')
            ->add('suburbs')
            ->add('onTopCity')
            ->add('createdAfter', 'doctrine_orm_callback',
                array(
                    'label' => 'Created After',
                    'callback' => function (ProxyQuery $queryBuilder, $alias, $field, $value) {
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
                    'callback' => function (ProxyQuery $queryBuilder, $alias, $field, $value) {
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
            ->add('name')
            ->add('country')
            ->add('seoDescription')
            ->add('suburbs')
            ->add('onTopCity')
            ->end()
        ;
    }

    public function prePersist($object)
    {
        $object->preUpload();

        if ($object->getSuburbs()) {
            foreach ($object->getSuburbs() as $suburb) {
                if ($suburb && $suburb->getName()) {
                    $suburb->setCity($object);
                } else {
                    $object->removeSuburb($suburb);
                }
            }
        }
    }

    public function preUpdate($object)
    {
        $object->preUpload();

        if ($object->getSuburbs()) {
            foreach ($object->getSuburbs() as $suburb) {
                if ($suburb && $suburb->getName()) {
                    $suburb->setCity($object);
                } else {
                    $object->removeSuburb($suburb);
                }
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function postUpdate($object)
    {
        $object->upload();
    }

    /**
     * {@inheritdoc}
     */
    public function postPersist($object)
    {
        $object->upload();
        if($object->getBars()->count() <= 0) {
            $this->getRequest()->getSession()->getFlashBag()->add("warning", "You have created a new city on World's Best Bars, now you can add new bars in this City");
        }
    }
}

<?php

/*
 * Fichier créer par : Badr HAKKARI <b.hakkari@void.fr>
 */

namespace WBB\CoreBundle\Controller\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CityAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $imageOptions = array('required' => false);
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
                        'help'      => 'Associate an area minimum to the city is mandatory'
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
            ->end()
            ->with('Related Best Of')
                ->add('bestofs', 'sonata_type_collection', array('required' => false),
                    array(
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable'  => 'position'
                    ))
            ->end()
            ->with('Tags')
                ->add('tags', 'sonata_type_collection', array('required' => false),
                    array(
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable'  => 'position'
                    ))
            ->end();
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', null, array('editable' => true))
            ->add('country')
            ->add('seoDescription')
            ->add('nbAreas', 'string', array(
                'label' => 'Related Areas',
                'template' => 'WBBCoreBundle:Admin:City\list_nb_areas.html.twig'
            ))
            ->add('nbBars', 'string', array(
                'label' => 'Related Bars',
                'template' => 'WBBCoreBundle:Admin:City\list_nb_bars.html.twig'
            ))
            ->add('nbNews', 'string', array(
                'label' => 'Related News',
                'template' => 'WBBCoreBundle:Admin:City\list_nb_news.html.twig'
            ))
            ->add('createdAt')
            ->add('updatedAt')
            ->add('onTopCity', null, array('editable' => true))
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
            ->add('seoDescription')
            ->add('suburbs')
            ->add('tags')
            ->add('onTopCity')
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
                ->add('name')
                ->add('country')
                ->add('seoDescription')
                ->add('suburbs')
                ->add('tags')
                ->add('onTopCity')
            ->end()
        ;
    }

    public function prePersist($object)
    {
        $object->preUpload();

        foreach ($object->getSuburbs() as $suburb) {
            $suburb->setCity($object);
        }
    }

    public function preUpdate($object)
    {
        $object->preUpload();

        foreach ($object->getSuburbs() as $suburb) {
            $suburb->setCity($object);
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
    }

    /**
     * {@inheritdoc}
     */
    public function postRemove($object)
    {
        $object->removeUpload();
    }
}

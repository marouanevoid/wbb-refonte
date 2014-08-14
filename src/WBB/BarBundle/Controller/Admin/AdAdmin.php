<?php

namespace WBB\BarBundle\Controller\Admin;

use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;
use WBB\BarBundle\Entity\Ad;
use WBB\CoreBundle\Controller\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class AdAdmin extends Admin {

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper){
        $listMapper
            ->addIdentifier('name')
            ->addIdentifier('position')
            ->add('beginAt', null, array('editable' => true))
            ->add('endAt', null, array('editable' => true))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper){
        $filterMapper
            ->add('id')
            ->add('name')
            ->add('position')
            ->add('tag')
            ->add('link')
            ->add('countries')
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
    protected function configureShowFields(ShowMapper $showMapper){
        $showMapper
            ->with('General')
                ->add('id')
                ->add('name')
                ->add('position')
                ->add('tag')
                ->add('link')
                ->add('countries')
                ->add('beginAt')
                ->add('endAt')
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
                ->add('name', null, array('required' => true))
                ->add('position', 'choice', array(
                    'required' => true,
                    'choices'  => Ad::getAdsPositionArray()
                ))
                ->add('tag')
                ->add('link', null, array('required' => false))
                ->add('image', 'sonata_type_model_list', array(
                        'required' => false
                    ), array(
                        'link_parameters' => array(
                            'context' => 'banner'
                        )
                    )
                )
                ->add('beginAt', 'datePicker')
                ->add('endAt', 'datePicker')
                ->add('countries', null, array('multiple' => true, 'required' => false, 'by_reference' => false ))
            ->end()
        ;
    }

}
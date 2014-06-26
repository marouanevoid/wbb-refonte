<?php

namespace WBB\BarBundle\Controller\Admin;

use WBB\BarBundle\Entity\Tip;
use WBB\CoreBundle\Controller\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use WBB\UserBundle\Entity\User;

class TipAdmin extends Admin {

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper){
        $listMapper
            ->addIdentifier('id')
            ->add('user', null, array('editable' => true))
            ->add('bar', null, array('editable' => true))
            ->add('description', null, array('editable' => true))
            ->add('status', null, array(
                'template' => 'WBBBarBundle:Admin:Tip\status_field.html.twig',
                'editable' => true
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper){
        $filterMapper
            ->add('id')
            ->add('description')
            ->add('user')
            ->add('bar')
            ->add('status')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper){
        $showMapper
            ->with('General')
                ->add('id')
                ->add('description')
                ->add('user')
                ->add('bar')
                ->add('status')
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
                ->add('bar', 'sonata_type_model', array('label'=> 'Link to Bar', 'btn_add' => false))
                ->add('status', 'choice', array(
                    'required' => false,
                    'choices'  => array(
                        0 => 'Pending',
                        1 => 'Enabled',
                        2 => 'Disabled'
                    ),
                    'empty_value' => false,
                    'preferred_choices' => array(0 => 'Pending')
                ))
                ->add('description')
            ->end()
        ;
    }

    public function createQuery($context = 'list')
    {
        $qb = parent::createQuery($context);
        $alias = $qb->getRootAliases();

        if ($this->getContainer()->get('request')->query->get('wbbexpert')) {
            $alias = $qb->getRootAliases();
            // here the user that have the role ROLE_EXPERT
        }

        return $qb;
    }

    public function getBatchActions()
    {
        // retrieve the default (currently only the delete action) actions
        $actions = parent::getBatchActions();

        // check user permissions
        if($this->hasRoute('edit') && $this->isGranted('EDIT') && $this->hasRoute('delete') && $this->isGranted('DELETE')){
            $actions['enabled']=[
                'label'            => 'Enabled',
                'ask_confirmation' => false // If true, a confirmation will be asked before performing the action
            ];

            $actions['pending']=[
                'label'            => 'Pending',
                'ask_confirmation' => false // If true, a confirmation will be asked before performing the action
            ];

            $actions['disabled']=[
                'label'            => 'Disabled',
                'ask_confirmation' => false // If true, a confirmation will be asked before performing the action
            ];
        }

        return $actions;
    }

    /**
     * Default Datagrid values
     *
     * @var array
     */
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'createdAt'
    );

}
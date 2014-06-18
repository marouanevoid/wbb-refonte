<?php

/*
 * Fichier créer par : Badr HAKKARI <b.hakkari@void.fr>
 */

namespace WBB\UserBundle\Controller\Admin;

use WBB\CoreBundle\Controller\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use FOS\UserBundle\Model\UserManagerInterface;

class UserAdmin extends Admin
{

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('username')
            ->add('email')
            ->add('enabled', null, array('editable' => true))
            ->add('locked', null, array('editable' => true))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('username')
            ->add('enabled')
            ->add('locked')
            ->add('email')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('General')
                ->add('username')
                ->add('email')
            ->end()
        ;
    }

    protected $formOptions = array(
        'validation_groups' => 'Profile'
    );

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('title', 'choice', array(
                    'expanded' => false,
                    'multiple' => false,
                    'required' => true,
                    'choices'  => array(
                        'Mrs'   =>  'Madam',
                        'Miss'  =>  'Miss',
                        'Mr'    =>  'Mister'
                    )
                ))
                ->add('username')
                ->add('email')
                ->add('firstname')
                ->add('lastname')
                ->add('website')
                ->add('latitude', 'hidden')
                ->add('longitude', 'hidden')
                ->add('description', 'textarea', array('attr' => array('class' => 'wysihtml5')))
                ->add('plainPassword', 'text', array('required' => false))
            ->end()
            ->with('Preferences')
                ->add('prefWhen', null, array('read_only' => true, 'disabled'  => true))
                ->add('prefHome', null, array('read_only' => true, 'disabled'  => true))
                ->add('prefCity1', null, array('read_only' => true, 'disabled'  => true))
                ->add('prefCity2', null, array('read_only' => true, 'disabled'  => true))
                ->add('prefCity3', null, array('read_only' => true, 'disabled'  => true))
                ->add('prefStartCity', null, array('read_only' => true, 'disabled'  => true))
                ->add('stayInformed')
            ->end()
        ;

        if(!$this->getSubject()->hasRole('ROLE_SUPER_ADMIN')) {
            $formMapper
                ->with('Management')
                    ->add('roles', 'choice', array(
                        'expanded' => true,
                        'multiple' => true,
                        'required' => false,
                        'choices'  => array(
                            'ROLE_SUPER_ADMIN'      =>  'Super Admin',
                            'ROLE_MODERATOR'        =>  'Moderator',
                            'ROLE_PUBLISHER'        =>  'Publisher',
                            'ROLE_EDITORIAL_EXPERT' =>  'Editorial Expert',
                            'ROLE_BAR_EXPERT'       =>  'Bar Expert',
                            'ROLE_BAR_OWNER'        =>  'Bar Owner',
                            'ROLE_USER'             =>  'User'
                        )
                    ))
                    ->add('locked', null, array('required' => false))
                    ->add('enabled', null, array('required' => false))
                ->end()
            ;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($user)
    {
        $this->getUserManager()->updateCanonicalFields($user);
        $this->getUserManager()->updatePassword($user);
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
     * @param UserManagerInterface $userManager
     */
    public function setUserManager(UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @return UserManagerInterface
     */
    public function getUserManager()
    {
        return $this->userManager;
    }
}

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
        $generatePasswordBtn = '<input type="button" id="pwd-generator" class="pwd-generator btn" value="Generate Password" />';

        $formMapper
            ->with('General')
                ->add('title', 'choice', array(
                    'help'      => 'Mandatory',
                    'expanded'  => false,
                    'multiple'  => false,
                    'required'  => true,
                    'label'     => 'Gender',
                    'choices'  => array(
                        'F'   =>  'F',
                        'M'   =>  'M'
                    )
                ))
                ->add('username', null, array('help' => 'Mandatory'))
                ->add('email', null, array('help' => 'Mandatory'))
                ->add('firstname', null, array('help' => 'Mandatory', 'label' => 'Firstname', 'required' => false))
                ->add('lastname', null, array('help' => 'Mandatory', 'label' => 'Lastname', 'required' => false))
                ->add('birthdate', null, array('years' => range(1914, date('Y')), 'help' => 'Mandatory', 'label' => 'Birthdate'))
                ->add('website')
                ->add('country', null, array('help' => 'Mandatory', 'label' => 'Country'))
                ->add('latitude', 'hidden')
                ->add('longitude', 'hidden')
                ->add('description', 'textarea', array('required'=>false, 'attr' => array('class' => 'wysihtml5')))
                ->add('plainPassword', 'text', array(
                        'required' => false,
                        'help' => $generatePasswordBtn.'Mandatory',
                        'label' => 'Password *',
                        'attr' => array(
                            'class' => 'span5 pwd-field'
                        )
                    )
                )
            ->end()
            ->with('Preferences')
                ->add('prefCity1', null, array('read_only' => true, 'disabled'  => true))
                ->add('prefCity2', null, array('read_only' => true, 'disabled'  => true))
                ->add('prefCity3', null, array('read_only' => true, 'disabled'  => true))
                ->add('prefBar1', null, array('read_only' => true, 'disabled'  => true))
                ->add('prefBar2', null, array('read_only' => true, 'disabled'  => true))
                ->add('prefBar3', null, array('read_only' => true, 'disabled'  => true))
                ->add('prefDrinkBrand1', null, array('read_only' => true, 'disabled'  => true))
                ->add('prefDrinkBrand2', null, array('read_only' => true, 'disabled'  => true))
                ->add('prefDrinkBrand3', null, array('read_only' => true, 'disabled'  => true))
                ->add('prefCocktails1', null, array('read_only' => true, 'disabled'  => true))
                ->add('prefCocktails2', null, array('read_only' => true, 'disabled'  => true))
                ->add('prefCocktails3', null, array('read_only' => true, 'disabled'  => true))
                ->add('prefStartCity', null, array('read_only' => true, 'disabled'  => true))
                ->add('stayInformed')
                ->add('stayBrandInformed')
            ->end()
        ;

        if(!$this->getSubject()->hasRole('ROLE_SUPER_ADMIN')) {
            $formMapper
                ->with('Management')
                    ->add('roles', 'choice', array(
                        'help' => 'Mandatory',
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
        if($user->getPlainPassword()){
            //Get the plain password before encryption and the rest of email data
            $data = array(
                'password'  => $user->getPlainPassword(),
                'email'     => $user->getEmail(),
                'gender'    => $user->getTitle(),
                'fullName'  => $user->getFullName()
            );
            //Send Email containing the New Password
            $this->getContainer()->get('wbb_user.generate_password.mailer')->sendGeneratedPassword($data);
        }

        $this->getUserManager()->updateCanonicalFields($user);
        $this->getUserManager()->updatePassword($user);
    }

    /**
     * {@inheritdoc}
     */
    public function getExportFields()
    {
        return array(
            $this->trans($this->getLabelTranslatorStrategy()->getLabel('firstname', 'show', 'label'))           => 'firstname',
            $this->trans($this->getLabelTranslatorStrategy()->getLabel('lastname', 'show', 'label'))            => 'lastname',
            $this->trans($this->getLabelTranslatorStrategy()->getLabel('lastname', 'show', 'label'))            => 'birthdate',
            $this->trans($this->getLabelTranslatorStrategy()->getLabel('lastname', 'show', 'label'))            => 'country.name',
            $this->trans($this->getLabelTranslatorStrategy()->getLabel('prefCity1', 'show', 'label'))           => 'prefCity1',
            $this->trans($this->getLabelTranslatorStrategy()->getLabel('prefCity2', 'show', 'label'))           => 'prefCity2',
            $this->trans($this->getLabelTranslatorStrategy()->getLabel('prefCity3', 'show', 'label'))           => 'prefCity3',
            $this->trans($this->getLabelTranslatorStrategy()->getLabel('prefBar1', 'show', 'label'))            => 'prefBar1',
            $this->trans($this->getLabelTranslatorStrategy()->getLabel('prefBar2', 'show', 'label'))            => 'prefBar2',
            $this->trans($this->getLabelTranslatorStrategy()->getLabel('prefBar3', 'show', 'label'))            => 'prefBar3',
            $this->trans($this->getLabelTranslatorStrategy()->getLabel('prefDrinkBrand1', 'show', 'label'))     => 'prefDrinkBrand1',
            $this->trans($this->getLabelTranslatorStrategy()->getLabel('prefDrinkBrand2', 'show', 'label'))     => 'prefDrinkBrand2',
            $this->trans($this->getLabelTranslatorStrategy()->getLabel('prefDrinkBrand3', 'show', 'label'))     => 'prefDrinkBrand3',
            $this->trans($this->getLabelTranslatorStrategy()->getLabel('prefCocktails1', 'show', 'label'))      => 'prefCocktails1',
            $this->trans($this->getLabelTranslatorStrategy()->getLabel('prefCocktails2', 'show', 'label'))      => 'prefCocktails2',
            $this->trans($this->getLabelTranslatorStrategy()->getLabel('prefCocktails3', 'show', 'label'))      => 'prefCocktails3',
            $this->trans($this->getLabelTranslatorStrategy()->getLabel('stayInformed', 'show', 'label'))        => 'stayInformed',
            $this->trans($this->getLabelTranslatorStrategy()->getLabel('stayBrandInformed', 'show', 'label'))   => 'stayBrandInformed',
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

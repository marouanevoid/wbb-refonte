<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBB\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class ProfileFormType extends BaseType
{
    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $constraint = new UserPassword();

        $this->buildUserForm($builder, $options);

//        $builder->add('current_password', 'password', array(
//            'label' => 'form.current_password',
//            'translation_domain' => 'FOSUserBundle',
//            'mapped' => false,
//            'constraints' => $constraint,
//        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'intention'  => 'profile',
        ));
    }

    public function getName()
    {
        return 'wbb_user_profile';
    }

    /**
     * Builds the embedded form representing the user.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    protected function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'choice', array(
                'expanded' => false,
                'multiple' => false,
                'required' => false,
                'empty_value' => 'Please choose your gender',
                'choices'  => array(
                    'F'   =>  'F',
                    'M'   =>  'M'
                )
            ))
            ->add('firstname')
            ->add('lastname')
            ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
//            ->add('plainPassword', 'repeated', array(
//                'type' => 'password',
//                'first_options'   => array('attr' => array('placeholder' => 'form.password')),
//                'second_options'  => array('attr' => array('placeholder' => 'form.password_confirmation')),
//                'invalid_message' => 'fos_user.password.mismatch',
//            ))
            ->add('birthdate')
            ->add('country')
            ->add('prefCity1')
            ->add('prefCity2')
            ->add('prefCity3')
            ->add('prefBar1')
            ->add('prefBar2')
            ->add('prefBar3')
            ->add('prefDrinkBrand1')
            ->add('prefDrinkBrand2')
            ->add('prefDrinkBrand3')
            ->add('prefCocktails1')
            ->add('prefCocktails2')
            ->add('prefCocktails3')
        ;
    }
}

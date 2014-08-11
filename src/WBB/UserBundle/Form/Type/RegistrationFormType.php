<?php

namespace WBB\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use WBB\BarBundle\Entity\Tag;

/**
 * Registration Form Type
 */
class RegistrationFormType extends BaseType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('username', null, array(
                    'required' => false,
                    'error_bubbling' => true
                ))
                ->add('title', 'choice', array(
                    'expanded' => false,
                    'multiple' => false,
                    'required' => false,
                    'error_bubbling' => true,
                    'empty_value' => 'Please choose your gender',
                    'choices' => array(
                        'F' => 'F',
                        'M' => 'M'
                    )
                ))
                ->add('firstname', null, array(
                    'required' => false,
                    'error_bubbling' => true
                ))
                ->add('lastname', null, array(
                    'required' => false,
                    'error_bubbling' => true
                ))
                ->add('email', 'text', array(
                    'label' => 'form.email',
                    'translation_domain' => 'FOSUserBundle',
                    'required' => false,
                    'error_bubbling' => true
                ))
                ->add('plainPassword', 'repeated', array(
                    'type' => 'password',
                    'first_options' => array('attr' => array('placeholder' => 'form.password'),'error_bubbling' => true),
                    'second_options' => array('attr' => array('placeholder' => 'form.password_confirmation'),'error_bubbling' => true),
                    'invalid_message' => 'fos_user.password.mismatch',
                    'required' => false,
                    'error_bubbling' => true
                ))
                ->add('birthdate', 'date', array(
                    'years' => range(1914, date('Y')),
                    'required' => false,
                    'error_bubbling' => true
                ))
                ->add('country', null, array(
                    'error_bubbling' => true
                ))
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
                ->add('stayInformed')
                ->add('stayBrandInformed')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver
                ->setDefaults(array(
                    'translation_domain' => 'WBBUserBundle',
                    'label' => false,
                    'validation_groups' => array('registration_full', 'Default')
                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'wbb_user_registration';
    }

}

<?php

namespace WBB\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

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
            ->add('username')
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
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'first_options'   => array('attr' => array('placeholder' => 'form.password')),
                'second_options'  => array('attr' => array('placeholder' => 'form.password_confirmation')),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->add('birthdate', 'date', array(
                'years' => range(1900, date('Y'))
            ))
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

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver
            ->setDefaults(array('translation_domain' => 'FOSUserBundle', 'label' => false))
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

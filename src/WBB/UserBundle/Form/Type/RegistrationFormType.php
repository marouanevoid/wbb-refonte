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
            ->add('gender', 'gender', array('label' => 'form.gender', 'attr' => array('class'=> 'radio')))
            ->add('firstname', null, array('attr' => array('placeholder' => 'form.firstname')))
            ->add('lastname', null,  array('attr' => array('placeholder' => 'form.lastname')))
            ->add('username', null,  array('attr' => array('placeholder' => 'form.username')))
            ->add('email', 'repeated', array(
                'first_options'   => array('attr' => array('class' =>'email', 'placeholder' => 'form.email')),
                'second_options'  => array('attr' => array('class' =>'email', 'placeholder' => 'form.email_confirmation')),
                'invalid_message' => 'fos_user.email.mismatch',
            ))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'first_options'   => array('attr' => array('placeholder' => 'form.password')),
                'second_options'  => array('attr' => array('placeholder' => 'form.password_confirmation')),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(
            array(
                'translation_domain' => 'FOSUserBundle',
                'label'              => false
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'wbb_user_registration';
    }

}

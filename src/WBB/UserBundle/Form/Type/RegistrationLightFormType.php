<?php

namespace WBB\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

/**
 * Registration Form Type
 */
class RegistrationLightFormType extends BaseType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, array('error_bubbling' => true))
            ->add('email', 'email', array(
                'error_bubbling' => true,
                'label' => 'form.email', 
                'translation_domain' => 'FOSUserBundle'
                ))
            ->add('plainPassword', 'repeated', array(
                'error_bubbling' => true,
                'type' => 'password',
                'first_options'   => array('attr' => array('placeholder' => 'form.password')),
                'second_options'  => array('attr' => array('placeholder' => 'form.password_confirmation')),
                'invalid_message' => 'fos_user.password.mismatch'
            ))
            ->add('birthdate', 'date', array(
                'years' => range(1900, date('Y'))
            ))
            ->add('country')
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
                'label'              => false,
                'error_bubbling'=>true
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'wbb_user_registration_light';
    }

}

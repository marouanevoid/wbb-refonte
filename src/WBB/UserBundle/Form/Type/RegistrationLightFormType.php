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
                ->add('username', null, array('error_bubbling' => true, 'required' => false))
                ->add('email', 'text', array(
                    'error_bubbling' => true,
                    'required' => false,
                    'label' => 'form.email',
                    'translation_domain' => 'FOSUserBundle'
                ))
                ->add('plainPassword', 'repeated', array(
                    'error_bubbling' => true,
                    'required' => false,
                    'type' => 'password',
                    'first_options' => array('attr' => array('placeholder' => 'form.password')),
                    'second_options' => array('attr' => array('placeholder' => 'form.password_confirmation')),
                    'invalid_message' => 'fos_user.password.mismatch'
                ))
                ->add('birthdate', 'date', array(
                    'empty_value' => array('year' => 'YYYY', 'month' => 'MM', 'day' => 'DD'),
                    'years' => range(1914, date('Y')),
                    'required' => false
                ))
                ->add('country', null, array(
                    'error_bubbling' => true,
                    'empty_value' => 'Country',
                    'required' => false,
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('c')
                            ->orderBy('c.name', 'ASC');
                    }
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
                    'translation_domain' => 'WBBUserBundle',
                    'label' => false,
                    'error_bubbling' => true
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

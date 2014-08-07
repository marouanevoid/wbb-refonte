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
                    'first_options' => array('attr' => array('placeholder' => 'form.password')),
                    'second_options' => array('attr' => array('placeholder' => 'form.password_confirmation')),
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
                ->add('prefCity1', null, array('empty_value' => 'Choose a city'))
                ->add('prefCity2', null, array('empty_value' => 'Choose a city'))
                ->add('prefCity3', null, array('empty_value' => 'Choose a city'))
                ->add('prefBar1', null, array('empty_value' => 'Choose a bar'))
                ->add('prefBar2', null, array('empty_value' => 'Choose a bar'))
                ->add('prefBar3', null, array('empty_value' => 'Choose a bar'))
                ->add('prefDrinkBrand1', 'entity', array(
                    'class' => 'WBBBarBundle:Tag',
                    'required' => false,
                    'property' => 'name',
                    'empty_value' => 'Choose a brand',
                    'query_builder' => function ($er) {
                return $er->findByType(Tag::WBB_TAG_TYPE_DRINK_BRANDS, true);
            }
                        )
                )
                ->add('prefDrinkBrand2', 'entity', array(
                    'class' => 'WBBBarBundle:Tag',
                    'required' => false,
                    'property' => 'name',
                    'empty_value' => 'Choose a brand',
                    'query_builder' => function ($er) {
                return $er->findByType(Tag::WBB_TAG_TYPE_DRINK_BRANDS, true);
            }
                        )
                )
                ->add('prefDrinkBrand3', 'entity', array(
                    'class' => 'WBBBarBundle:Tag',
                    'required' => false,
                    'property' => 'name',
                    'empty_value' => 'Choose a brand',
                    'query_builder' => function ($er) {
                return $er->findByType(Tag::WBB_TAG_TYPE_DRINK_BRANDS, true);
            }
                        )
                )
                ->add('prefCocktails1', 'entity', array(
                    'class' => 'WBBBarBundle:Tag',
                    'required' => false,
                    'property' => 'name',
                    'empty_value' => 'Choose a cocktail',
                    'query_builder' => function ($er) {
                return $er->findByType(Tag::WBB_TAG_TYPE_BEST_COCKTAILS, true);
            }
                        )
                )
                ->add('prefCocktails2', 'entity', array(
                    'class' => 'WBBBarBundle:Tag',
                    'required' => false,
                    'property' => 'name',
                    'empty_value' => 'Choose a cocktail',
                    'query_builder' => function ($er) {
                return $er->findByType(Tag::WBB_TAG_TYPE_BEST_COCKTAILS, true);
            }
                        )
                )
                ->add('prefCocktails3', 'entity', array(
                    'class' => 'WBBBarBundle:Tag',
                    'required' => false,
                    'property' => 'name',
                    'empty_value' => 'Choose a cocktail',
                    'query_builder' => function ($er) {
                return $er->findByType(Tag::WBB_TAG_TYPE_BEST_COCKTAILS, true);
            }
                        )
                )
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver
                ->setDefaults(array('translation_domain' => 'WBBUserBundle', 'label' => false))
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

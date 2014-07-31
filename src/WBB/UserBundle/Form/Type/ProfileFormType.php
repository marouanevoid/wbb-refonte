<?php

namespace WBB\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;
use WBB\BarBundle\Entity\Tag;

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
        $this->buildUserForm($builder, $options);
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
            ->add('birthdate')
            ->add('country')
            ->add('prefCity1', null, array('empty_value' => 'Choose a city'))
            ->add('prefCity2', null, array('empty_value' => 'Choose a city'))
            ->add('prefCity3', null, array('empty_value' => 'Choose a city'))
            ->add('prefBar1', null, array('empty_value' => 'Choose a bar'))
            ->add('prefBar2', null, array('empty_value' => 'Choose a bar'))
            ->add('prefBar3', null, array('empty_value' => 'Choose a bar'))
            ->add('prefDrinkBrand1', 'entity', array(
                    'class'    => 'WBBBarBundle:Tag',
                    'required' => false,
                    'property' => 'name',
                    'empty_value' => 'Choose a brand',
                    'query_builder' => function ($er) {
                            return $er->findByType(Tag::WBB_TAG_TYPE_DRINK_BRANDS, true);
                        }
                )
            )
            ->add('prefDrinkBrand2', 'entity', array(
                    'class'    => 'WBBBarBundle:Tag',
                    'required' => false,
                    'property' => 'name',
                    'empty_value' => 'Choose a brand',
                    'query_builder' => function ($er) {
                            return $er->findByType(Tag::WBB_TAG_TYPE_DRINK_BRANDS, true);
                        }
                )
            )
            ->add('prefDrinkBrand3', 'entity', array(
                    'class'    => 'WBBBarBundle:Tag',
                    'required' => false,
                    'property' => 'name',
                    'empty_value' => 'Choose a brand',
                    'query_builder' => function ($er) {
                            return $er->findByType(Tag::WBB_TAG_TYPE_DRINK_BRANDS, true);
                        }
                )
            )
            ->add('prefCocktails1', 'entity', array(
                    'class'    => 'WBBBarBundle:Tag',
                    'required' => false,
                    'property' => 'name',
                    'empty_value' => 'Choose a cocktail',
                    'query_builder' => function ($er) {
                            return $er->findByType(Tag::WBB_TAG_TYPE_BEST_COCKTAILS, true);
                        }
                )
            )
            ->add('prefCocktails2', 'entity', array(
                    'class'    => 'WBBBarBundle:Tag',
                    'required' => false,
                    'property' => 'name',
                    'empty_value' => 'Choose a cocktail',
                    'query_builder' => function ($er) {
                            return $er->findByType(Tag::WBB_TAG_TYPE_BEST_COCKTAILS, true);
                        }
                )
            )
            ->add('prefCocktails3', 'entity', array(
                    'class'    => 'WBBBarBundle:Tag',
                    'required' => false,
                    'property' => 'name',
                    'empty_value' => 'Choose a cocktail',
                    'query_builder' => function ($er) {
                            return $er->findByType(Tag::WBB_TAG_TYPE_BEST_COCKTAILS, true);
                        }
                )
            )
            ->add('stayInformed')
            ->add('stayBrandInformed')
            ->add('avatar', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'avatar',
                'required' => false
            ))
        ;
    }
}

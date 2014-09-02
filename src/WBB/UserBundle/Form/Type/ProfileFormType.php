<?php

namespace WBB\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
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
        $this->buildUserForm($builder, $options);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'intention'  => 'profile',
            'cascade_validation' => true
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
                'empty_value' => ' ',
                'choices'  => array(
                    'F'   =>  'Female',
                    'M'   =>  'Male'
                )
            ))
            ->add('username', null, array('required' => false))
            ->add('firstname', null, array('required' => false))
            ->add('lastname', null, array('required' => false))
            ->add('email', 'text', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle', 'required' => false))
            ->add('birthdate', 'date', array(
                'years' => range(1900, date('Y'))
            ))
            ->add('country', null, array('empty_value' => ' ', 'required' => false))
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
            ->add('avatar', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'avatar',
                'required' => false
            ))
        ;
    }
}

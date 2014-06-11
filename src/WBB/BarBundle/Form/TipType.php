<?php

namespace WBB\BarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use WBB\CoreBundle\Form\DataTransformer\EntityToIDTransformer;

class TipType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $options['em'];

        $builder
            ->add('description', 'textarea', array(
                'required' => true,
                'attr' => array(
                    'class' => 's-margin-top',
                    'placeholder' => 'Type a tip ...',
                    'maxlength' => "250"
                )
            ))
            ->add($builder->create('bar', 'hidden')->addModelTransformer(new EntityToIDTransformer($em, 'WBBBarBundle', 'Bar')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'data_class' => 'WBB\BarBundle\Entity\Tip',
                'csrf_protection' => false
            ))
            ->setRequired(array(
                'em',
            ))
            ->setAllowedTypes(array(
                'em' => 'Doctrine\Common\Persistence\ObjectManager',
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wbb_barbundle_tip';
    }
}

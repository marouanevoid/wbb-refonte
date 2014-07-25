<?php

namespace WBB\BarBundle\Form\Email;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

/**
 * ShareNewsFormType
 */
class ShareNewsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('attr' => array('placeholder' => 'Your name')))
            ->add('friendName', 'text', array('attr' => array('placeholder' => 'Friend\'s name')))
            ->add('email', 'email', array(
                    'constraints' => array(new Email(array('checkMX' => true))),
                    'attr' => array('placeholder' => 'Your email')
                )
            )
            ->add('friendEmail', 'email', array(
                    'constraints' => array(new Email(array('checkMX' => true))),
                    'attr' => array('placeholder' => 'Friend\'s email')
                )
            )
            ->add('content', 'textarea',
                array(
                    'attr'        => array(),
                    'required'    => false,
                    'constraints' => array()
                )
            )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'label'       => false,
            'translation_domain' => 'WBBBarBundle',
            'constraints' => array(
                new NotBlank()
            )
        ));
    }

    public function getName()
    {
        return 'wbb_barbundle_share_news_type';
    }
}

<?php

namespace WBB\BarBundle\Form\Email;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

/**
 * ShareFormType
 */
class ShareFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $id = $options['id'];

        $builder
            ->add('id', 'hidden', array('data' => $id))
            ->add('name', 'text', array('attr' => array('placeholder' => 'Your name')))
            ->add('email', 'email', array(
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
        $resolver
            ->setDefaults(array(
            'label'       => false,
            'translation_domain' => 'WBBBarBundle',
            'constraints' => array(
                    new NotBlank()
                )
            ))
            ->setRequired(array(
                'id',
            ))
        ;
    }

    public function getName()
    {
        return 'wbb_barbundle_share_type';
    }
}

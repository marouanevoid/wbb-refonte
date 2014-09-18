<?php

namespace WBB\BarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\File;

class SemsoftType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', 'file');
        /*
            array(
                'constraints' => array(
                    new File(array(
                            'mimeTypes' => array("text/csv")
                        )
                    )))
         */
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'csrf_protection' => false
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wbb_barbundle_semsoft_csv';
    }
}

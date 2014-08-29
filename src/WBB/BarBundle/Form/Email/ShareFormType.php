
namespace WBB\BarBundle\Form\Email;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Collection;

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
            ->add('firstName', 'text', array('required' => false,'attr' => array('placeholder' => 'Friend\'s first name')))
            ->add('lastName', 'text', array('required' => false,'attr' => array('placeholder' => 'Friend\'s last name')))
            ->add('emailTo', 'text', array(
                    'required'    => false,
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
        $constraintsCollection = new Collection(array(
            'firstName' => array(
                new NotBlank(array('message' => 'not.blank'))
            ),
            'lastName' => array(
                new NotBlank(array('message' => 'not.blank'))
            ),
            'emailTo' => array(
                new NotBlank(array('message' => 'not.blank')),
                new Email(array('message' => 'Please enter a valid email address'))
            ),
            'content' => array(
                new NotBlank(array('message' => 'not.blank'))
            ),'id' => array(
                new NotBlank(array('message' => 'not.blank'))
            )
        ));

        $resolver
            ->setDefaults(array(
                'label'       => false,
                'translation_domain' => 'WBBBarBundle',
                'constraints' => $constraintsCollection
                )
            )
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

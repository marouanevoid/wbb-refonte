<?php

/*
 * Fichier créer par : Badr HAKKARI <b.hakkari@void.fr>
 */

namespace WBB\BarBundle\Controller\Admin;

use WBB\BarBundle\Entity\Bar;
use WBB\CoreBundle\Controller\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class BarAdmin extends Admin
{

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('city')
            ->add('suburb')
            ->add('website')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('onTop', null, array('editable' => true))
            ->add('status', 'status')
            ->add('user')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('name')
            ->add('city')
            ->add('suburb')
            ->add('onTop')
            ->add('status', 'doctrine_orm_string', array(), 'choice',
                array('choices' => array(
                    Bar::BAR_STATUS_PENDING_VALUE   => 'Pending',
                    Bar::BAR_STATUS_ENABLED_VALUE   => 'Enabled',
                    Bar::BAR_STATUS_DISABLED_VALUE  => 'Disabled'
                )
            ))
            ->add('createdAt', 'doctrine_orm_datetime_range', array(), null, array('widget' => 'single_text', 'format' => 'M/d/y', 'required' => false,  'attr' => array('class' => 'datepicker')))
            ->add('updatedAt', 'doctrine_orm_datetime_range', array(), null, array('widget' => 'single_text', 'format' => 'M/d/y', 'required' => false,  'attr' => array('class' => 'datepicker')))

        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('General')
                ->add('id')
                ->add('name')
                ->add('latitude')
                ->add('langitude')
                ->add('address')
                ->add('phone')
                ->add('email')
                ->add('website')
                ->add('twitter')
                ->add('facebook')
                ->add('instagram')
                ->add('isCreditCard')
                ->add('isCoatCheck')
                ->add('parking')
                ->add('price')
                ->add('menu')
                ->add('isReservation')
                ->add('reservation')
                ->add('description')
                ->add('onTop')
                ->add('status')
            ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        if(is_object($this->getSubject())){
            $this->getSubject()->setUser($this->getUser());
        }
        
        $formMapper
            ->with('General')
                ->add('user', null, array('help' => 'Select the bar owner of your choice (Optional)'))
                ->add('name', null, array('help' => 'Name of the bar (Mandatory)'))
                ->add('city', 'sonata_type_model', array('help' => 'City (Mandatory)','required' => true))
                ->add('suburb', 'sonata_type_model', array('help' => 'Area (Mandatory)', 'required' => true))
                ->add('onTop')
                ->add('status', 'choice', array(
                    'required' => false,
                    'help' => 'Status (Keep the "Pending" status until the bar page is completely finished).',
                    'choices'  => array(
                        Bar::BAR_STATUS_PENDING_VALUE  =>  Bar::BAR_STATUS_PENDING_TEXT,
                        Bar::BAR_STATUS_ENABLED_VALUE  =>  Bar::BAR_STATUS_ENABLED_TEXT,
                        Bar::BAR_STATUS_DISABLED_VALUE =>  Bar::BAR_STATUS_DISABLED_TEXT
                    )
                ))
            ->end()
            ->with('Bar Details');
                if($this->getSecurityContext()->isGranted('ROLE_BAR_ID')){
                    $formMapper
                        ->add('latitude', 'hidden')
                        ->add('longitude', 'hidden')
                        ->add('address', null, array('help' => 'Address (Mandatory)'))
                        ->add('phone', null, array('help' => 'Phone number (Mandatory)'))
                        ->add('email')
                        ->add('website')
                        ->add('foursquare', null, array('help' => 'Foursquare ID (Example : 4bfd2db02b83b71365a7a998)'))
                        ->add('twitter', null, array('help' => 'Twitter pseudo (Example : buddhabargroup)'))
                        ->add('facebook', null, array('help' => 'Facebook pseudo (Exemple : buddhabarofficial)'))
                        ->add('instagram', null, array('help' => 'Instagram pseudo (Example : buddhabarparis)'));
                }

        $formMapper
            ->add('isCreditCard')
            ->add('isCoatCheck')
            ->add('parking', 'choice', array(
                'required' => false,
                'choices'  => array(
                    'Premier Etage' => 'Premier Etage',
                    'RDC'           => 'RDC',
                    'RDJ'           => 'RDJ'
                )
            ))
            ->add('price', 'choice', array(
                'required' => false,
                'choices'  => array(
                    1 => 1,
                    2 => 2,
                    3 => 3,
                    4 => 4
                )
            ))
            ->add('menu', null, array('help' => 'Menu link (Example : http://www.url.com)'))
            ->add('isReservation')
            ->add('reservation', null, array('help' => 'Reservation link (Example : http://www.url.com)'));

        if(!$this->getSecurityContext()->isGranted('ROLE_BAR_OWNER')){
            $formMapper
                ->add('description', 'textarea', array('required' => false,'help' => 'Bar Description (Mandatory)', 'attr' => array('class'=>'wysihtml5')))
//                ->add('readMore', 'textarea', array('required' => false, 'attr' => array('help' => 'Bar Description (Mandatory)', 'class'=>'wysihtml5')))
            ;
        }

        $formMapper
                ->add('seoDescription', 'textarea', array(
                        'required' => false,
                        'help' => 'SEO Description * (Mandatory) (160 caracters max)',
                        'attr' => array(
                            'cols'=>220,
                            'rows'=>10
                        )
                    )
                )
            ->end()
            ->with('Medias')
                ->add('medias', 'sonata_type_collection', array('required' => false, 'help' => 'Medias (Add a WBB media is mandatory)'),
                    array(
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable'  => 'position'
                    ))
            ->end()
            ->with('Tags')
                ->add('tags', 'sonata_type_collection', array(
                    'required' => false,
                    'help' => 'Tags (Associate a tag minimum to the bar is mandatory)'),
                    array(
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable'  => 'position'
                    ))
            ->end()
            ->with('Openings')
                ->add('openings', 'sonata_type_collection', array('required' => false),
                    array(
                        'edit' => 'inline',
                        'inline' => 'table'
                    ))
            ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getExportFields()
    {
        return array(
            $this->trans($this->getLabelTranslatorStrategy()->getLabel('username', 'show', 'label'))  => 'username',
            $this->trans($this->getLabelTranslatorStrategy()->getLabel('firstname', 'show', 'label')) => 'firstname',
            $this->trans($this->getLabelTranslatorStrategy()->getLabel('lastname', 'show', 'label'))  => 'lastname',
            $this->trans($this->getLabelTranslatorStrategy()->getLabel('email', 'show', 'label'))     => 'email',
        );
    }

    public function prePersist($object)
    {
        foreach ($object->getMedias() as $media) {
            $media->setBar($object);
        }

        foreach ($object->getTags() as $tag) {
            $tag->setBar($object);
        }

        foreach ($object->getOpenings() as $opening) {
            $opening->setBar($object);
        }
    }

    public function preUpdate($object)
    {
        foreach ($object->getMedias() as $media) {
            $media->setBar($object);
        }

        foreach ($object->getTags() as $tag) {
            $tag->setBar($object);
        }

        foreach ($object->getOpenings() as $opening) {
            $opening->setBar($object);
        }
    }
}

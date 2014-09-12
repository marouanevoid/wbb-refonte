<?php

/*
 * Fichier créer par : Badr HAKKARI <b.hakkari@void.fr>
 */

namespace WBB\CoreBundle\Controller\Admin;

use Sonata\AdminBundle\Admin\Admin as BaseAdmin;

class Admin extends BaseAdmin
{
    /**
     * {@inheritdoc}
     */
    protected $maxPerPage = 15;

    /**
     * {@inheritdoc}
     */
    protected $maxPageLinks = 15;

    protected $formOptions = array(
        'cascade_validation' => true
    );

    /**
     * {@inheritdoc}
     */
    public function getExportFormats()
    {
        return array('xls');
    }

    /**
     * get Container
     *
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->getConfigurationPool()->getContainer();
    }

    /**
     * get Security Context
     *
     * @return SecurityContext
     */
    public function getSecurityContext()
    {
        return $this->getContainer()->get('security.context');
    }

    /**
     * Get a user from the Security Context
     *
     * @return mixed
     */
    protected function getUser()
    {
        return $this->getSecurityContext()->getToken()->getUser();
    }

    /**
     * Default Datagrid values
     *
     * @var array
     */
    protected $datagridValues = array(
        '_page' => 1,            // display the first page (default = 1)
        '_sort_order' => 'DESC', // reverse order (default = 'ASC')
        '_sort_by' => 'id'  // name of the ordered field
    );

    protected function getImageOptions($imageName, $filter, $options = array())
    {
        $imagineService = $this->getContainer()->get('liip_imagine.cache.manager');
        $imageOptions = $options;
        if ($imageName) {
            $path = $imagineService->getBrowserPath($imageName, $filter);
            $imageOptions['help'] = $imageOptions['help'].'<br /><img width="100px" src="' . $path . '" />';
//            die($imageOptions['help']);
        }

        return $imageOptions;
    }
}

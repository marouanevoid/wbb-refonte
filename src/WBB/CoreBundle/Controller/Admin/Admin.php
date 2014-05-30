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
}

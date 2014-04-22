<?php

/*
 * Fichier créer par : Badr HAKKARI <b.hakkari@void.fr>
 */

namespace WBB\CoreBundle\Admin;

use Sonata\AdminBundle\Admin\Admin as BaseAdmin;

class Admin extends BaseAdmin
{
    private $container;

    /**
     * {@inheritdoc}
     */
    protected $maxPerPage = 25;

    /**
     * {@inheritdoc}
     */
    protected $maxPageLinks = 25;

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
     * Get a user from the Security Context
     *
     * @return mixed
     */
    protected function getUser()
    {
        return $this->getContainer()->get('security.context')->getToken()->getUser();
    }
}

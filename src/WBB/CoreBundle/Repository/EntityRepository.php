<?php

namespace WBB\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository as BaseEntityRepository;
use Doctrine\Common\Util\Inflector;

/**
 * EntityRepository
 */
abstract class EntityRepository extends BaseEntityRepository
{
    /**
     * getAlias
     *
     * @return string
     */
    protected function getAlias()
    {
        $name = basename(str_replace('\\', '/', $this->getClassName()));

        return Inflector::tableize($name);
    }
}

<?php

namespace WBB\CoreBundle\Naming;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\NamerInterface;

/**
 * OrignameNamer
 *
 * @author Ivan Borzenkov <ivan.borzenkov@gmail.com>
 */
class MyOrignameNamer implements NamerInterface
{
    /**
     * {@inheritDoc}
     */
    public function name($object, PropertyMapping $mapping)
    {
        $file = $mapping->getFile($object);

        /** @var $file UploadedFile */

        return uniqid().'_'.$file->getClientOriginalName();
    }
}

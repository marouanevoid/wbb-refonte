<?php

namespace WBB\CoreBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;

class EntityToIDTransformer implements DataTransformerInterface
{

    private $om;
    private $bundleName;
    private $entityName;

    public function __construct(ObjectManager $om, $bundleName, $entityName)
    {
        $this->om = $om;
        $this->bundleName = $bundleName;
        $this->entityName = $entityName;
    }

    public function reverseTransform($id)
    {
        if (!$id) {
            return null;
        }

        $entity = $this->om->getRepository($this->bundleName.':'.$this->entityName)->find($id);

        if (null === $entity) {
            throw new TransformationFailedException('No '.$this->entityName.' with id '.$id.' does not exist!');
        }

        return $entity;
    }

    public function transform($entity)
    {
        if (null === $entity) {
            return 0;
        }

        return $entity->getId();
    }

}

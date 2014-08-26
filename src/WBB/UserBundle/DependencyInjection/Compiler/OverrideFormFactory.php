<?php

namespace WBB\UserBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class OverrideFormFactory implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('fos_user.registration.form.factory');
        $definition->setClass('WBB\UserBundle\Form\Factory\FormFactory');
    }
}

<?php

namespace Beyerz\CheckBookIOBundle;

use Beyerz\CheckBookIOBundle\DependencyInjection\Compiler\OAuthConnectTwigExtensionPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CheckBookIOBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new OAuthConnectTwigExtensionPass());
    }
}

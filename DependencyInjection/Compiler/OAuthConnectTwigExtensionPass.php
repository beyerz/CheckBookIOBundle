<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 25/12/2016
 * Time: 16:18
 */

namespace Beyerz\CheckBookIOBundle\DependencyInjection\Compiler;


use Beyerz\CheckBookIOBundle\Twig\Extensions\OauthConnectExtension;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class OAuthConnectTwigExtensionPass implements CompilerPassInterface
{

    /**
     * We can only add the router now as it is not definitely available when the bundle loads
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if($container->hasDefinition('beyerz.checkbookio.twig.oauth_connect')) {
            $twigExtension = $container->findDefinition('beyerz.checkbookio.twig.oauth_connect');
            $twigExtension->addArgument(new Reference($container->getAlias('router')));
        }
    }
}
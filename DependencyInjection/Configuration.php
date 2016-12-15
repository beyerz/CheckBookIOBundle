<?php

namespace Beyerz\CheckBookIOBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    const NODE_ROOT = 'check_book_io';
    const NODE_PUBLIC_KEY = 'publishable_key';
    const NODE_PRIVATE_KEY = 'secret_key';
    const NODE_SANDBOX_MODE = 'sandbox';

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root(self::NODE_ROOT);

        $rootNode
            ->children()
                ->scalarNode(self::NODE_PUBLIC_KEY)->end()
                ->scalarNode(self::NODE_PRIVATE_KEY)->end()
                ->booleanNode(self::NODE_SANDBOX_MODE)->defaultTrue()->end()
            ->end();

        return $treeBuilder;
    }
}

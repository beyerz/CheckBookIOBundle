<?php

namespace Beyerz\CheckBookIOBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use GuzzleHttp\Client;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class CheckBookIOExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
        $this->addParameters($config, $container);
        $this->processClientConfiguration($config, $container);
    }

    private function addParameters(array $config, ContainerBuilder $container){
        $container->setParameter('beyerz.checkbook.private_key',$config[Configuration::NODE_PRIVATE_KEY]);
        $container->setParameter('beyerz.checkbook.public_key',$config[Configuration::NODE_PUBLIC_KEY]);
    }

    /**
     * @param array $config
     * @param ContainerBuilder $container
     */
    private function processClientConfiguration(array $config, ContainerBuilder $container)
    {
        // Create the service definition
        $client = new Definition(Client::class);
        // Yay for lazy loading!!!
        $client->setLazy(true);
        // Don't expose this to the public container
        $client->setPublic(false);
        // Add Guzzle Config
        $client->addArgument($this->buildGuzzleConfig($config['sandbox']));
        // How we get the service
        $clientServiceName = 'checkbook.client';
        // add the client definition to the container
        $container->setDefinition($clientServiceName, $client);
    }

    /**
     * @param $sandbox boolean
     * @return array
     */
    public function buildGuzzleConfig($sandbox)
    {
        $config = [
            'base_uri' => $sandbox?'https://sandbox.checkbook.io':'https://checkbook.io',
            'debug' => $sandbox,
            'headers' => [
                'Accept' => "application/json",
                'Content-Type' => "application/json",
            ]
        ];

        return $config;
    }
}

<?php

namespace Beyerz\CheckBookIOBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use GuzzleHttp\Client;
use Beyerz\CheckBookIOBundle\Twig\Extensions\OauthConnectExtension;

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
        if(isset($config[Configuration::NODE_OAUTH])) {
            $this->processOauthHandler($config, $container);
            $this->processOauthConnectTwigExtension($config, $container);
        }
    }

    private function addParameters(array $config, ContainerBuilder $container){
        $container->setParameter('beyerz.checkbook.private_key',$config[Configuration::NODE_PRIVATE_KEY]);
        $container->setParameter('beyerz.checkbook.public_key',$config[Configuration::NODE_PUBLIC_KEY]);
        $container->setParameter('beyerz.checkbook.merchant_name',$config[Configuration::NODE_MERCHANT_NAME]);
        $container->setParameter('beyerz.checkbook.sandbox',$config[Configuration::NODE_SANDBOX_MODE]);
        if(isset($config[Configuration::NODE_OAUTH])) {
            $container->setParameter('beyerz.checkbook.oauth.client_id', $config[Configuration::NODE_OAUTH][Configuration::NODE_OAUTH_CLIENT_ID]);
        }
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
        $client->addArgument($this->buildGuzzleConfig($config[Configuration::NODE_SANDBOX_MODE], $config[Configuration::NODE_DEBUG_MODE]));
        // How we get the service
        $clientServiceName = 'checkbook.client';
        // add the client definition to the container
        $container->setDefinition($clientServiceName, $client);
    }

    private function processOauthHandler(array $config, ContainerBuilder $container){
        $listener = new Definition($config[Configuration::NODE_OAUTH][Configuration::NODE_OAUTH_EVENT_HANDLER]);
        $listener->setLazy(true);
        $serviceName = 'checkbook.event_listener.oauth_connect';
        $listener->addTag('kernel.event_subscriber');
        $container->setDefinition($serviceName,$listener);
    }

    private function processOauthConnectTwigExtension(array $config, ContainerBuilder $container){
        $twigExtension = new Definition(OauthConnectExtension::class);
        $twigExtension->setPublic(false);
        $twigExtension->addTag('twig.extension');
        $container->setDefinition('beyerz.checkbookio.twig.oauth_connect',$twigExtension);

//        twig.oauth_connect:
//    class: Beyerz\CheckBookIOBundle\Twig\Extensions\OauthConnectExtension
//    arguments:
//      - "%beyerz.checkbook.oauth.client_id%"
//      - "%beyerz.checkbook.oauth.redirect_uri%"
//      - "%beyerz.checkbook.sandbox%"
//    public: false
//    tags:
//        - { name: twig.extension }
    }

    /**
     * @param $sandbox boolean
     * @param $debug boolean
     * @return array
     */
    public function buildGuzzleConfig($sandbox, $debug)
    {
        $config = [
            'base_uri' => $sandbox?'https://sandbox.checkbook.io':'https://checkbook.io',
            'debug' => $debug,
            'headers' => [
                'Accept' => "application/json",
                'Content-Type' => "application/json",
            ]
        ];

        return $config;
    }
}

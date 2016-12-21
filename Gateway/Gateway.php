<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 30/11/2016
 * Time: 18:47
 */

namespace Beyerz\CheckBookIOBundle\Gateway;


use GuzzleHttp\Client;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Gateway
{
    use ContainerAwareTrait;

    /**
     * @var Client
     */
    protected $client;

    /**
     * Gateway constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}